<?php

namespace App\Http\Controllers;

use App\Handover;
use App\Product;
use App\Stock;
use App\Employee;
use App\HandoverDetails;
use App\User;
use App\Status;
use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use File;

class HandoverController extends Controller
{

    public function __construct() 
    {
      $this->middleware('auth');
        $this->middleware('superuser')->except(['index','show', 'index_search']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();

        if(Auth::user()->emp_type == 3){
            $handovers = Handover::where('employee_id', '=', Auth::user()->emp_id)->orderBy('id', 'desc')->sortable()->paginate(10);
            return view('admin.handovers.index', [
                'handovers' => $handovers,
                'employees' => $employees
            ]);
        }
        $handovers = Handover::orderBy('id', 'desc')->sortable()->paginate(10);
        return view('admin.handovers.index', [
            'handovers' => $handovers,
            'employees' => $employees
        ]);
    }

    public function index_search($id)
    {
        $employees = Employee::all();

        if(Auth::user()->emp_type == 3){
            $handovers = Handover::where('employee_id', '=', Auth::user()->emp_id)->sortable()->paginate(10);
            return view('admin.handovers.index', [
                'handovers' => $handovers,
                'employees' => $employees
            ]);
        }
        $handovers = Handover::where('id', '=', $id)->sortable()->paginate(10);
        return view('admin.handovers.index', [
            'handovers' => $handovers,
            'employees' => $employees
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $particulars = null;
         $products = Product::all();
        $employees = Employee::all();
         $product_stock = DB::table('stock')
         ->join('product', 'product.id', '=', 'stock.product_id')
         ->select('stock.serial_no', 'stock.tag_no', 'stock.status_id', 'stock.product_id','product.product', 'product.manufacturer', 'product.brand', 'product.model')
         ->where('deleted_at' , '=', null)
         ->get();
        $uid = Auth::user()->id;
        $empid = User::findOrFail($uid)->emp_id;
        $cur_user = $empid;
        $status = Status::all();

        return view('admin.handovers.create', [
            'products' => $products,
            'employees' => $employees,
            'product_stock' => $product_stock,
            'cur_user' => $cur_user,
            'particulars' => $particulars,
            'status' => $status
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $handover_item = DB::table('handover')->where([
        //     ['product_id', '=', $request->input('product_id')],
        //     ['stock_id', '=', $request->input('stock_id')],
        //     ['employee_id', '=', $request->input('employee_id')],
        //     ['unit_id', '=', $request->input('unit_id')]
        // ])->get();
        // $rquantity = $request->input('quantity');
        
        // if($handover_item->isNotEmpty()){
        //     // Do Updation
        //     $validatedData = $request->validate([
        //         'product_id' => 'required',
        //         'stock_id' => 'required',
        //         'handover_date' => 'required',
        //         'tag_no' => '',
        //         'employee_id' => 'required',
        //         'expected_life' => '',
        //         'unit_id' => 'required',
        //         'quantity' => 'required'
        //     ]);

        //     // Update Stock Table
        //     $stock_item = DB::table('stock')->where([
        //         ['id', '=', $request->input('stock_id')],
        //         ['product_id', '=', $request->input('product_id')]
        //     ])->get();

        //     $stdbquantity = $stock_item->first()->quantity;
        //     if($stdbquantity < $rquantity)
        //     {
        //         return redirect()->back()->with('fail', 'You do not have enough amount of product! ');
        //     }else{
        //         $stnewquantity = $stdbquantity - $rquantity;
        //         DB::table('stock')
        //         ->where([
        //             ['id', '=', $request->input('stock_id')],
        //             ['product_id', '=', $request->input('product_id')]
        //         ])
        //         ->update(['quantity' => $stnewquantity]);
    
        //         $dbquantity = $handover_item->first()->quantity;
        //         $newquantity = $dbquantity + $rquantity;
    
        //         // Update Handover Table
        //         DB::table('handover')
        //         ->where([
        //             ['product_id', '=', $request->input('product_id')],
        //             ['stock_id', '=', $request->input('stock_id')],
        //             ['employee_id', '=', $request->input('employee_id')]
        //         ])
        //         ->update(['quantity' => $newquantity]);

        //         //insert record to handover_log
        //     $log = DB::table('handover')->where([
        //         ['product_id', '=', $request->input('product_id')],
        //         ['stock_id', '=', $request->input('stock_id')],
        //         ['employee_id', '=', $request->input('employee_id')]
        //     ])->get()->first();

        //     $this->saveHandoverLog($log, $rquantity, 'Update Insertion');
                
        //         return redirect()->back()->with('success', 'Record Updated Successfully!');
    
        //         }
        //     }elseif($handover_item->isEmpty()){
            // Do new Insertion and update stock table...
            $validatedData = $request->validate([
                'request_ref' => 'required',
                'handover_date' => 'required',
                'employee_id' => 'required',
                'request_emp' => 'required',
                'approved_emp' => 'required',
                'handovered_emp' => 'required',
                'file_path' => 'required|file|max:2048'
            ]);
            
            $file_path = null;
            if($request->hasFile('file_path')){
            $file_path = "Emp_".$request->input('employee_id')."-".time().'.'.request()->file_path->getClientOriginalExtension();
            }

            DB::table('handover')->insert(
                [
                    'request_ref' => $request->input('request_ref'),
                    'handover_date' => $request->input('handover_date'), 
                    'employee_id' => $request->input('employee_id'), 
                    'request_emp' => $request->input('request_emp'),
                    'approved_emp' => $request->input('approved_emp'), 
                    'handovered_emp' => $request->input('handovered_emp'), 
                    'file_path' => $file_path, 
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );

            if($request->hasFile('file_path')){
            $request->file_path->storeAs('requested_forms',$file_path, 'public');
            }
            $maxId = DB::table('handover')->max('id');

            foreach($request->particulars as $particular) 
            // $particular = $request->particulars;
            // for($i=0; $i<10; $i++)
            {
                if($particular['product_id'] != 0 || $particular['tag_no'] != 0){
                //     continue;
                // }else{
                    // dd($particular['product_id']);
                        DB::table('handover_details')->insert(
                            [
                                'handover_id' => $maxId,
                                'product_id' => $particular['product_id'],
                                'tag_no' => $particular['tag_no'],
                                'quantity' => $particular['quantity'],
                                'remarks' => $particular['remarks'],
                                'created_at' => now(),
                                'updated_at' => now()
                            ]
                        );
                        // HandoverDetails::create([
                        //         'handover_id' => $maxId,
                        //         'product_id' => $particular['product_id'],
                        //         'tag_no' => $particular['tag_no'],
                        //         'quantity' => $particular['quantity'],
                        //         'remarks' => $particular['remarks'],
                        //         'created_at' => now(),
                        //         'updated_at' => now()
                        // ]);

                    $stock_item = DB::table('stock')->where([
                            ['tag_no', '=', $particular['tag_no']]
                        ])->get()->first()->quantity;

                    $newQty = $stock_item - $particular['quantity'];

                    DB::table('stock')
                        ->where([
                            ['tag_no', '=', $particular['tag_no']]
                        ])
                        ->update(['quantity' => $newQty]);
                    
                    $chk_qty = DB::table('stock')->where([
                            ['tag_no', '=', $particular['tag_no']]
                        ])->get()->first()->quantity;

                    if($chk_qty == 0){
                        $item = Stock::where('tag_no', '=', $particular['tag_no']);
                        $item->delete();
                    }
                 }
            }
            
            // $stock_item = DB::table('stock')->where([
            //     ['id', '=', $request->input('stock_id')],
            //     ['product_id', '=', $request->input('product_id')]
            // ])->get();
            // $stdbquantity = $stock_item->first()->quantity;

            // if($stdbquantity < $rquantity) {

            //     return redirect()->back()->with('fail', 'You do not have enough amount of product!');
            // }else{
            // $stnewquantity = $stdbquantity - $rquantity;
            //  // Update Stock Table
            // DB::table('stock')
            // ->where([
            //     ['id', '=', $request->input('stock_id')],
            //     ['product_id', '=', $request->input('product_id')]
            // ])
            // ->update(['quantity' => $stnewquantity]);

            // // Insert new record
            // Handover::create($validatedData);
            
            //insert record to hanodver_log
            

            $log = DB::table('handover')->where([
                ['id', '=', $maxId]
            ])->get()->first();

            $this->saveHandoverLog($log, 'Insertion');

            return redirect('/admin/handovers')->with('success', 'Record Saved Successfully!');
            // return redirect()->back()->with('success', 'Record Saved Successfully!');
            // }
        // }else{
            // return redirect()->back()->with('fail', 'Record not saved!, Try Again!');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Handover  $handover
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $handover = Handover::findOrFail($id);
        $products = Product::all();
        $employees = Employee::all();
        $handovers_details = DB::table('handover_details')->where([
            ['handover_id', '=', $id]
        ])->get();

        return view('admin.handovers.show', [
            'handover' => $handover,
            'products' => $products,
            'employees' => $employees,
            'handovers_details' => $handovers_details
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Handover  $handover
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $handover = Handover::findOrFail($id);
        $employees = Employee::all();
        // $product_stock = DB::table('stock')
        // ->join('product', 'product.id', '=', 'stock.product_id')
        // ->select('stock.id','stock.status_id', 'stock.class_id', 'stock.product_id','product.product', 'product.manufacturer', 'product.brand', 'product.model')
        // ->get();

        return view('admin.handovers.edit', [
            'handover' => $handover,
            'employees' => $employees,
            // 'product_stock' => $product_stock
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Handover  $handover
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
                'request_ref' => 'required',
                'handover_date' => 'required',
                'employee_id' => 'required',
                'request_emp' => 'required',
                'approved_emp' => 'required',
                'handovered_emp' => 'required',
                'file_path' => 'file|max:2048'
            ]);

            $file_path = null;
            if($request->input('newfile') != null){
                if($request->hasFile('file_path')){
                    // $oldfile = asset('storage/app/public/requested_forms/'.$request->input('newfile'));
                    // unlink($oldfile);
                    // Storage::delete(storage_path("app/public/requested_forms/{$request->input('newfile')}"));
                    File::delete(storage_path("app/public/requested_forms/{$request->input('newfile')}"));
                    $file_path = "Emp_".$request->input('employee_id')."-".time().'.'.request()->file_path->getClientOriginalExtension();
                    DB::table('handover')
                    ->where('id', $id)
                    ->update(
                        [
                            'request_ref' => $request->input('request_ref'),
                            'handover_date' => $request->input('handover_date'), 
                            'employee_id' => $request->input('employee_id'), 
                            'request_emp' => $request->input('request_emp'),
                            'approved_emp' => $request->input('approved_emp'), 
                            'handovered_emp' => $request->input('handovered_emp'), 
                            'file_path' => $file_path, 
                        ]
                    );

                    $request->file_path->storeAs('requested_forms',$file_path, 'public');
                }else{
                    DB::table('handover')
                    ->where('id', $id)
                    ->update(
                        [
                            'request_ref' => $request->input('request_ref'),
                            'handover_date' => $request->input('handover_date'), 
                            'employee_id' => $request->input('employee_id'), 
                            'request_emp' => $request->input('request_emp'),
                            'approved_emp' => $request->input('approved_emp'), 
                            'handovered_emp' => $request->input('handovered_emp')
                        ]
                    );
                }
            }else{
                DB::table('handover')
                    ->where('id', $id)
                    ->update(
                        [
                            'request_ref' => $request->input('request_ref'),
                            'handover_date' => $request->input('handover_date'), 
                            'employee_id' => $request->input('employee_id'), 
                            'request_emp' => $request->input('request_emp'),
                            'approved_emp' => $request->input('approved_emp'), 
                            'handovered_emp' => $request->input('handovered_emp')
                        ]
                     );
            }

        // Handover::whereId($id)->update($validatedData);
        // DB::table('handover')
        //     ->where('id', $id)
        //     ->update(['handover_date' => $request->input('handover_date'),
        //                 'tag_no' => $request->input('tag_no'),
        //                 'expected_life' => $request->input('expected_life'),
        //                 'unit_id' => $request->input('unit_id'),
        //     ]);

            //insert record to handover_log
        $log = DB::table('handover')->where([
            ['id', '=', $id]
        ])->get()->first();

        $this->saveHandoverLog($log, 'Updation');
        
        return redirect('/admin/handovers')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Handover  $handover
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $handover = Handover::findOrFail($id);
        if($handover != null){
            //insert record to handover_log
            $this->saveHandoverLog($handover, 'Deletion');
        if($handover->file_path != null){
            // $oldfile = asset('storage/app/public/requested_forms/'.$handover->file_path);
            File::delete(storage_path("app/public/requested_forms/{$handover->file_path}"));
            if($handover->forceDelete()){
                    return redirect('/admin/handovers')->with('success', 'Record Deleted Successfully!');
            }
        }
    }
        return redirect('/admin/handovers')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {

        $handovers = Handover::findOrFail($id);

        return view('admin.handovers.search', 
            [
                'handovers' => $handovers
            ]);
    }

    public function getstockitems($id){
        // Fetch Stock by ProductId
        $stockData['data'] = DB::table('stock')
                                ->join('product', 'stock.product_id', '=', 'product.id')
                                ->join('status', 'stock.status_id', 'status.id')
                                ->select('stock.id', 'stock.serial_no', 'stock.tag_no', 'status.status', 'product.product', 'product.manufacturer','product.model', 'product.brand')
                                ->where([['stock.product_id' , '=', $id],['stock.deleted_at', '=', null]])
                                ->get();
        echo json_encode($stockData);
        exit;
   }

   public function getitemquantity($id){
        $stockQuantity = DB::table('stock')
                            ->join('product', 'stock.product_id', '=', 'product.id')
                            ->select('stock.quantity')
                            ->where([['stock.tag_no' , '=', $id],['stock.deleted_at', '=', null]])
                            ->get()->first();
        echo json_encode($stockQuantity);
        exit;
    }

    public function saveHandoverLog($data, $opr){
        DB::table('handover_log')->insert(
            [
                'handover_id' => $data->id,
                'employee_id' => $data->employee_id, 
                'request_ref' => $data->request_ref,
                'handover_date' => $data->handover_date, 
                'request_emp' => $data->request_emp,
                'approved_emp' => $data->approved_emp, 
                'handovered_emp' => $data->handovered_emp, 
                'file_path' => $data->file_path, 
                'operation' => $opr, 
                'user_id' => Auth::user()->id,
                'created_at' => now(),
                'updated_at' => now() 
            ]
        );

    }

    public function viewFile($file_path){
        return response()->download(storage_path("app/public/requested_forms/{$file_path}"));
    }


}
