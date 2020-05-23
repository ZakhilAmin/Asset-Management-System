<?php

namespace App\Http\Controllers;

use App\Returns;
use App\Product;
use App\Employee;
use App\Clas;
use App\Status;
use App\User;
use App\HandoverDetails;
use App\Handover;
use Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReturnsController extends Controller
{

    public function __construct() 
    {
      $this->middleware('auth');
        $this->middleware('superuser');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $returns = Returns::all(); //sortable()->paginate(10);
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();

        return view('admin.returns.index', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        

        $uid = Auth::user()->id;
        $empid = User::findOrFail($uid)->emp_id;

        return view('admin.returns.create', [
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'empid' => $empid
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
        // $return_item = DB::table('returns')->where([
        //     ['product_id', '=', $request->input('product_id')],
        //     ['employee_id', '=', $request->input('employee_id')],
        //     ['status_id', '=', $request->input('status_id')],
        //     ['class_id', '=', $request->input('class_id')],
        //     ['unit_id', '=', $request->input('unit_id')]
        // ])->get();
        // echo $stock_item;
        // $rquantity = $request->input('quantity');   

        // if($return_item->isNotEmpty()){
        //     // Do Updation
        //     $validatedData = $request->validate([
        //         'product_id' => 'required',
        //         'return_date' => 'required',
        //         'tag_no' => '',
        //         'employee_id' => 'required',
        //         'class_id' => 'required',
        //         'status_id' => 'required',
        //         'unit_id' => 'required',
        //         'quantity' => 'required'
        //     ]);


        //         // Update Handover Table
        //         $handover_item = DB::table('handover')
        //         ->join('stock', 'stock.product_id', '=', 'handover.product_id')
        //         ->select('stock.id', 'handover.quantity')
        //         ->where([
        //             ['handover.product_id', '=', $request->input('product_id')],
        //             ['handover.employee_id', '=', $request->input('employee_id')],
        //             ['handover.unit_id', '=', $request->input('unit_id')]
        //         ])
        //         ->get();

        //         $hddbquantity = $handover_item->first()->quantity;
        //         $hddbstock_id = $handover_item->first()->id;
        //         if($hddbquantity < $rquantity){
        //             return redirect()->back()->with('fail', 'Please Enter correct amount of Quantity! ');
        //         }
        //         else{
        //             // Update Stock Table
        //             $stock_item = DB::table('stock')->where([
        //                 ['product_id', '=', $request->input('product_id')],
        //                 ['class_id', '=', $request->input('class_id')],
        //                 ['status_id', '=', $request->input('status_id')],
        //                 ['unit_id', '=', $request->input('unit_id')]
        //             ])->get();
        
        //             //check stock for status and class attributes
        //             if($stock_item->isEmpty()){
        //                 DB::table('stock')->insert(
        //                     [
        //                         'product_id' => $request->input('product_id'),
        //                         'cost' => 0,
        //                         'contract_date' => $request->input('return_date'),
        //                         'receive_date' => $request->input('return_date'),
        //                         'class_id' => $request->input('class_id'),
        //                         'm7' => 'test',
        //                         'm16' => 'test',
        //                         'unit_id' => $request->input('unit_id'),
        //                         'quantity' =>$rquantity,
        //                         'status_id' => $request->input('status_id')
        //                      ]
        //                 );
        //             }else{
        //                 $stdbquantity = $stock_item->first()->quantity;
        //                 $stnewquantity = $stdbquantity + $rquantity;
        //             DB::table('stock')
        //             ->where([
        //                 ['product_id', '=', $request->input('product_id')],
        //                 ['class_id', '=', $request->input('class_id')],
        //                 ['status_id', '=', $request->input('status_id')],
        //                 ['unit_id', '=', $request->input('unit_id')]
        //                 ])
        //                 ->update(['quantity' => $stnewquantity]);
        //             }
        //                 //Update Handover Table
        //                 $newhddbquantity = $hddbquantity - $rquantity;
        //                 DB::table('handover')
        //                 ->where([
        //                 ['product_id', '=', $request->input('product_id')],
        //                 ['stock_id', '=', $hddbstock_id],
        //                 ['employee_id', '=', $request->input('employee_id')]
        //                 ])
        //                 ->update(['quantity' => $newhddbquantity]);
                        
        //                 //Update Returns Table
        //                 $redbquantity = $return_item->first()->quantity;
        //                 $newredbquantity = $redbquantity + $rquantity;

        //             DB::table('returns')
        //             ->where([
        //                 ['product_id', '=', $request->input('product_id')],
        //                 ['employee_id', '=', $request->input('employee_id')],
        //                 ['status_id', '=', $request->input('status_id')],
        //                 ['class_id', '=', $request->input('class_id')],
        //                 ['unit_id', '=', $request->input('unit_id')]
        //             ])
        //             ->update(['quantity' => $newredbquantity]);

        //             //insert record to stock_log
        //             $log = DB::table('returns')->where([
        //                         ['product_id', '=', $request->input('product_id')],
        //                         ['employee_id', '=', $request->input('employee_id')],
        //                         ['status_id', '=', $request->input('status_id')],
        //                         ['class_id', '=', $request->input('class_id')],
        //                         ['unit_id', '=', $request->input('unit_id')]
        //             ])->get()->first();

        //             $this->saveReturnsLog($log, $rquantity, 'Update Insertion');

        //             return redirect()->back()->with('success', 'Record Updated Successfully!');
        //             }
        //     }elseif($return_item->isEmpty()){
            // Do new Insertion and update stock table...
            $validatedData = $request->validate([
                'product_id' => 'required',
                'return_date' => 'required',
                'tag_no' => 'required',
                'employee_id' => 'required',
                'class_id' => 'required',
                'status_id' => 'required',
                'returned_emp' => 'required',
                'quantity' => 'required'
            ]);

            // $rquantity = $request->input('quantity');
            //increase stock table
            // Update Stock Table
            $handover_item =  DB::table('handover_details')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                    ->join('employee', 'employee.id', '=', 'handover.employee_id')
                    ->select('handover_details.id', 'handover_details.handover_id', 'handover_details.product_id', 'handover_details.tag_no', 'handover_details.quantity')
                    ->where([
                        ['employee.id' , '=', $request->input('employee_id')],
                        ['handover_details.tag_no', '=', $request->input('tag_no')],
                        ['handover_details.product_id', '=', $request->input('product_id')]
                    ])
                    ->get();
            if($handover_item->isNotEmpty()){
                // Insert new record
                if(!($request->input('quantity') > $handover_item->first()->quantity)){
                Returns::create($validatedData);

                //drop from details
                $qty = $handover_item->first()->quantity;
                $newQty = $qty - $request->input('quantity');
                DB::table('handover_details')
                    ->where([
                        ['product_id', '=', $request->input('product_id')],
                        ['tag_no', '=', $request->input('tag_no')],
                        ['handover_id', '=', $handover_item->first()->handover_id]
                        ])
                        ->update(['quantity' => $newQty]);

                $oldQty = DB::table('handover_details')->where([
                        ['product_id', '=', $request->input('product_id')],
                        ['tag_no', '=', $request->input('tag_no')],
                        ['handover_id', '=', $handover_item->first()->handover_id]
                    ])->get()->first();
                if($oldQty->quantity == 0){
                    $d = HandoverDetails::findOrFail($oldQty->id);
                    $d->delete($d);
                }

                //insert into logs
                $maxId = DB::table('returns')->max('id');

                $log = DB::table('returns')->where([
                    ['id', '=', $maxId]
                ])->get()->first();
 
                $this->saveReturnsLog($log, 'Insertion');

                // Delete Handovers
                $this->deleteHandover();

                /////////////////////////////////////// insert into stock ////////////////////
                if($request->input('status_id') != 3){
                $data = DB::table('stock')->where([
                    ['tag_no', '=', $request->input('tag_no')]
                ])->get()->first();

                DB::table('stock')->insert([
                    'serial_no' => $data->serial_no,
                    'product_id' => $data->product_id,
                    'tag_no' => $request->input('tag_no'),
                    'expected_life' => $data->expected_life,
                    'cost' => 0, 
                    'contract_date' => $data->contract_date, 
                    'receive_date' => $data->receive_date, 
                    'class_id' => $request->input('class_id'), 
                    'm7' => $data->m7, 
                    'm16' => $data->m16, 
                    'unit_id' => $data->unit_id, 
                    'quantity' => $request->input('quantity'), 
                    'status_id' => $request->input('status_id'),
                    'project_id' => $data->project_id,
                    'department_id' => $data->department_id,
                    'donar_id' => $data->donar_id,
                    'location_id' => $data->location_id,
                    'description' => $data->description,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // //insert record to stock_log
                $maxId = DB::table('stock')->max('id');

                $l = DB::table('stock')->where([
                    ['id', '=', $maxId]
                ])->get()->first();
    
                $this->saveStockLog($l, 'Returns Insertion');
                }
                /////////////////////////////////////////////////////////////////////////////

                return redirect('/admin/returns')->with('success', 'Record Saved Successfully!');
                }else{
                    return redirect()->back()->with('fail', 'Quatity is not valid!');
                }

            }
            //check stock for status and class attributes
            // if($stock_item->isEmpty()){
            //     DB::table('stock')->insert(
            //         [
            //             'product_id' => $request->input('product_id'),
            //             'cost' => 0,
            //             'contract_date' => $request->input('return_date'),
            //             'receive_date' => $request->input('return_date'),
            //             'class_id' => $request->input('class_id'),
            //             'm7' => 'test',
            //             'm16' => 'test',
            //             'unit_id' => $request->input('unit_id'),
            //             'quantity' =>$rquantity,
            //             'status_id' => $request->input('status_id')
            //          ]
            //     );
            // }else{
            //     $stdbquantity = $stock_item->first()->quantity;
            //     $stnewquantity = $stdbquantity + $rquantity;

            // DB::table('stock')
            // ->where([
            //     ['product_id', '=', $request->input('product_id')],
            //     ['class_id', '=', $request->input('class_id')],
            //     ['status_id', '=', $request->input('status_id')],
            //     ['unit_id', '=', $request->input('unit_id')]
            //     ])
            //     ->update(['quantity' => $stnewquantity]);
            // }
            // //decrease handover table
            // //Update Handover Table
            // $handover_item = DB::table('handover')
            // ->join('stock', 'stock.product_id', '=', 'handover.product_id')
            // ->select('stock.id', 'handover.quantity')
            // ->where([
            //     ['handover.product_id', '=', $request->input('product_id')],
            //     ['handover.employee_id', '=', $request->input('employee_id')],
            //     ['handover.unit_id', '=', $request->input('unit_id')]
            // ])
            // ->get();
            // $hddbquantity = $handover_item->first()->quantity;
            // $hddbstock_id = $handover_item->first()->id;

            // $newhddbquantity = $hddbquantity - $rquantity;
            // DB::table('handover')
            // ->where([
            // ['product_id', '=', $request->input('product_id')],
            // ['stock_id', '=', $hddbstock_id],
            // ['employee_id', '=', $request->input('employee_id')]
            // ])
            // ->update(['quantity' => $newhddbquantity]);

            

            // //insert into logs
            //  $maxId = DB::table('returns')->max('id');

            //  $log = DB::table('returns')->where([
            //      ['id', '=', $maxId]
            //  ])->get()->first();
 
            //  $this->saveReturnsLog($log, $rquantity, 'New Insertion');

           
        // }else{
             return redirect()->back()->with('fail', 'Record not saved!, Try Again!');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Returns  $returns
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $return = Returns::findOrFail($id);
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();

 
        return view('admin.returns.show', [
            'return' => $return,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Returns  $returns
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $return = Returns::findOrFail($id);
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        

        return view('admin.returns.edit', [
            'return' => $return,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Returns  $returns
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
                'return_date' => 'required',
                'tag_no' => 'required',
                'employee_id' => 'required',
                'class_id' => 'required',
                'status_id' => 'required',
                'returned_emp' => 'required',
                'quantity' => 'required'
        ]);
     Handover::whereId($id)->update($validatedData);
    // DB::table('returns')
    //     ->where('id', $id)
    //     ->update(['return_date' => $request->input('return_date'),
    //                 'tag_no' => $request->input('tag_no')
    //     ]);
    
        //insert record to return_log
        $log = DB::table('returns')->where([
            ['id', '=', $id]
        ])->get()->first();

        $this->saveReturnsLog($log, 'Updation');
    
    return redirect('/admin/returns')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Returns  $returns
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $return = Returns::findOrFail($id);
        if($return != null){
            //insert record to handover_log
            $this->saveReturnsLog($return, 'Deletion');
        if($return->delete()){
            return redirect('/admin/returns')->with('success', 'Record Deleted Successfully!');
        }
    }
        return redirect('/admin/returns')->with('fail', 'Record Deletion failed!');
    }

    public function saveReturnsLog($data, $opr){
        DB::table('return_log')->insert(
            [
                'return_id' => $data->id,
                'product_id' => $data->product_id,
                'return_date' => $data->return_date, 
                'tag_no' => $data->tag_no, 
                'employee_id' => $data->employee_id, 
                'class_id' => $data->class_id, 
                'status_id' => $data->status_id, 
                'returned_emp' => $data->returned_emp, 
                'quantity' => $data->returned_emp, 
                'operation' => $opr, 
                'user_id' => Auth::user()->id, 
            ]
        );

    }

    // Delete Handover
    public function deleteHandover(){
        $hd = Handover::all();

        foreach($hd as $h){
            $i = DB::table('handover_details')->where('handover_id', '=', $h->id)->get();
            if($i->isEmpty()){
                $h->delete();
            }
        }
    }

    public function saveStockLog($data, $opr){
        DB::table('stock_log')->insert(
            [
                'stock_id' => $data->id,
                'serial_no' => $data->serial_no,
                'product_id' => $data->product_id,
                'tag_no' => $data->tag_no,
                'expected_life' => $data->expected_life,
                'cost' => $data->cost, 
                'contract_date' => $data->contract_date, 
                'receive_date' => $data->receive_date, 
                'class_id' => $data->class_id, 
                'm7' => $data->m7, 
                'm16' => $data->m16, 
                'unit_id' => $data->unit_id, 
                'quantity' => $data->quantity, 
                'status_id' => $data->status_id,
                'project_id' => $data->project_id,
                'department_id' => $data->department_id,
                'donar_id' => $data->donar_id,
                'location_id' => $data->location_id,
                'description' => $data->description,
                'operation' => $opr, 
                'user_id' => Auth::user()->id, 
            ]
        );
    }
}
