<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Product;
use App\Clas;
use App\Status;
use App\Unit;
use App\Project;
use App\Department;
use App\Donar;
use App\Location;
use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function __construct() 
    {
      $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock = Stock::orderBy('status_id', 'asc')->sortable()->paginate(10);
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $projects = Project::all();
        $departments = Department::all();

        return view('admin.stock.index', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'projects' => $projects,
            'departments' => $departments
            ]);
    }

    public function index_search($id)
    {
        $stock = Stock::where('id', '=', $id)->sortable()->paginate(10);
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $projects = Project::all();
        $departments = Department::all();

        return view('admin.stock.index', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'projects' => $projects,
            'departments' => $departments
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
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $donars = Donar::all();
        $locations = Location::all();
        $projects = Project::all();
        $departments = Department::all();
        return view('admin.stock.create', [
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'donars' => $donars,
            'locations' => $locations,
            'projects' => $projects,
            'departments' => $departments
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
        // $stock_item = DB::table('stock')->where([
        //     ['product_id', '=', $request->input('product_id')],
        //     ['class_id', '=', $request->input('class_id')],
        //     ['unit_id', '=', $request->input('unit_id')],
        //     ['status_id', '=', $request->input('status_id')]
        // ])->get();
        // echo $stock_item;
        // $rquantity = $request->input('quantity');

        // if($stock_item->isNotEmpty()){
        //     // Do Updation
        //     $validatedData = $request->validate([
        //         'serial_no' => 'required',
        //         'product_id' => 'required',
        //         'tag_no' => 'required',
        //         'expected_life' => '',
        //         'contract_date' => '',
        //         'receive_date' => '',
        //         'class_id' => 'required',
        //         'm7' => '',
        //         'm16' => '',
        //         'unit_id' => 'required',
        //         'cost' => 'required',
        //         'quantity' => 'required',
        //         'status_id' => 'required',
        //         'donar' => '',
        //         'location' => '',
        //         'description' => ''
        //     ]);

        //     $dbquantity = $stock_item->first()->quantity;
        //     $newquantity = $dbquantity + $rquantity;

        //     // $dbcost = $stock_item->first()->cost;
        //     // $rcost = $request->input('cost');
        //     // $newcost = $dbcost + $rcost;
        //     DB::table('stock')
        //     ->where([
        //         ['product_id', '=', $request->input('product_id')],
        //         ['class_id', '=', $request->input('class_id')],
        //         ['unit_id', '=', $request->input('unit_id')],
        //         ['status_id', '=', $request->input('status_id')]
        //     ])
        //     ->update(['quantity' => $newquantity]);

        //     //insert record to stock_log
        //     $log = DB::table('stock')->where([
        //         ['product_id', '=', $request->input('product_id')],
        //         ['class_id', '=', $request->input('class_id')],
        //         ['unit_id', '=', $request->input('unit_id')],
        //         ['status_id', '=', $request->input('status_id')]
        //     ])->get()->first();

        //     $this->saveStockLog($log, $rquantity, 'Update Insertion');

        //     return redirect()->back()->with('success', 'Record Updated Successfully!');
        // }elseif($stock_item->isEmpty()){
            // Do new Insertion
            $validatedData = $request->validate([
                'serial_no' => 'required|unique:stock,serial_no,except,id',
                'product_id' => 'required',
                'tag_no' => 'required|unique:stock,tag_no,except,id',
                'expected_life' => '',
                'cost' => 'required',
                'contract_date' => '',
                'receive_date' => '',
                'class_id' => 'required',
                'm7' => '',
                'm16' => '',
                'unit_id' => 'required',
                'quantity' => 'required',
                'status_id' => 'required',
                'donar_id' => 'required',
                'location_id' => 'required',
                'project_id' => 'required',
                'department_id' => 'required',
                'description' => ''
            ]); 

            $stock = Stock::create($validatedData);

            //insert record to stock_log
            $maxId = DB::table('stock')->max('id');

            $log = DB::table('stock')->where([
                ['id', '=', $maxId]
            ])->get()->first();

            $this->saveStockLog($log, 'Insertion');

            return redirect('/admin/stock')->with('success', 'Record Saved Successfully!');
        // }else{
        //     return redirect()->back()->with('fail', 'Record not saved!, Try Again!');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = Stock::findOrFail($id);
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $donars = Donar::all();
        $locations = Location::all();
        $projects = Project::all();
        $departments = Department::all();
        return view('admin.stock.show', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'donars' => $donars,
            'locations' => $locations,
            'projects' => $projects,
            'departments' => $departments
            ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $donars = Donar::all();
        $locations = Location::all();
        $projects = Project::all();
        $departments = Department::all();
        return view('admin.stock.edit', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'donars' => $donars,
            'locations' => $locations,
            'projects' => $projects,
            'departments' => $departments
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'serial_no' => 'required|unique:stock,serial_no,except,id',
            'product_id' => 'required',
            'tag_no' => 'required|unique:stock,tag_no,except,id',
                'expected_life' => '',
                'cost' => 'required',
                'contract_date' => '',
                'receive_date' => '',
                'class_id' => 'required',
                'm7' => '',
                'm16' => '',
                'unit_id' => 'required',
                'quantity' => 'required',
                'status_id' => 'required',
                'donar_id' => 'required',
                'location_id' => 'required',
                'project_id' => 'required',
                'department_id' => 'required',
                'description' => ''
            ]);
            Stock::whereId($id)->update($validatedData);
            // DB::table('stock')
            //     ->where('id', $id)
            //     ->update(['cost' => $request->input('cost'),
            //                 'contract_date' => $request->input('contract_date'),
        //                 'receive_date' => $request->input('receive_date'),
        //                 'm7' => $request->input('m7'),
        //                 'm16' => $request->input('m16')
        //     ]);

        //insert record to stock_log
        $log = DB::table('stock')->where([
            ['id', '=', $id]
        ])->get()->first();

        $this->saveStockLog($log, 'Updation');
        
        return redirect('/admin/stock')->with('success', 'Record Updated Successfully!');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        if($stock != null){
            //insert record to stock_log
            $this->saveStockLog($stock, 'Deletion');

            if($stock->forceDelete()){
                return redirect('/admin/stock')->with('success', 'Record Deleted Successfully!');
            }
        }
        return redirect('/admin/stock')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {

        $stock = Stock::findOrFail($id);

        return view('admin.stock.search', 
            [
                'stock' => $stock
            ]);
    }

    // Check Data Validation
    // private function checkValidation(){
    //     $validatedData = $request->validate([
    //         'product_id' => 'required',
    //         'cost' => '',
    //         'contract_date' => '',
    //         'receive_date' => '',
    //         'class_id' => 'required',
    //         'm7' => '',
    //         'm16' => '',
    //         'unit_id' => 'required',
    //         'quantity' => 'required',
    //         'status_id' => 'required'
    //     ]);
    // }

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
