<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Product;
use App\Clas;
use App\Status;
use App\Unit;
use App\Employee;
use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StockReportController extends Controller
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
        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1]])
                ->get();
                
        $ritemss = $ritems->unique('product_id');

        $itemss = $items->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();

        return view('admin.stock_report.index', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'itemss' => $itemss,
            'rstock' => $rstock,
            'ritemss' => $ritemss
            ]);
    }

    public function indexPrint(){
        $report_title = "Stock Report";
        
        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1]])
                ->get();
                
        $ritemss = $ritems->unique('product_id');
                
        $itemss = $items->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_dept($id){
        $departments = \DB::table('department')->where('id', '=', $id)->get();

        $report_title = $departments->first()->department." Department Stock Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['department_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['department_id', '=', $id]])
                ->get();
        
        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['department_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['department_id', '=', $id]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_category($id){
        $categories = \DB::table('category')->where('id', '=', $id)->get();

        $report_title = $categories->first()->category." Category's Stock Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->join('product', 'product.id', '=', 'stock.product_id')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['product.category_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->join('product', 'product.id', '=', 'stock.product_id')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['product.category_id', '=', $id]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->join('product', 'product.id', '=', 'stock.product_id')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['product.category_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->join('product', 'product.id', '=', 'stock.product_id')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['product.category_id', '=', $id]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_class($id){
        $classes = \DB::table('class')->where('id', '=', $id)->get();

        $report_title = $classes->first()->class." Class Stock Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['class_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['class_id', '=', $id]])
                ->get();
        
        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['class_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['class_id', '=', $id]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        // $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_donar($id){
        $donars = \DB::table('donar')->where('id', '=', $id)->get();

        $report_title = $donars->first()->name." Donar's Stock Report";

        $stock = \DB::table('stock')
            ->select('product_id', \DB::raw('sum(quantity) as quantity'))
            ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['donar_id', '=', $id]])
            ->groupBy('product_id')
            ->orderBy('product_id', 'asc')
            ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['donar_id', '=', $id]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['donar_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();
    
        $ritems = \DB::table('stock')
                    ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                    ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['donar_id', '=', $id]])
                    ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritmess' => $ritemss
        ]);
    }

    public function search_result_employee($id){
        $employees = \DB::table('employee')->where('id', '=', $id)->get();

        $report_title = "Stock Assets Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_handover($id){
        $handovers = \DB::table('handover')->where('id', '=', $id)->get();

        $report_title = "Stock Assets Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1]])
                ->get();
        
        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_location($id){
        $locations = \DB::table('location')->where('id', '=', $id)->get();

        $report_title = $locations->first()->name." Location Stock Assets Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['location_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['location_id', '=', $id]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['location_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['location_id', '=', $id]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_product($id){
        $products = \DB::table('product')->where('id', '=', $id)->get();

        $report_title = $products->first()->product." Product Stock Assets Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['product_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['product_id', '=', $id]])
                ->get();
        
        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['product_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['product_id', '=', $id]])
                ->get();

        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        // $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_project($id){
        $projects = \DB::table('project')->where('id', '=', $id)->get();

        $report_title = $projects->first()->name." Project Stock Assets Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['project_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['project_id', '=', $id]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['project_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['project_id', '=', $id]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_unit($id){
        $units = \DB::table('units')->where('id', '=', $id)->get();

        $report_title = $units->first()->unit." Unit Related Stock Assets Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['unit_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['unit_id', '=', $id]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['unit_id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['unit_id', '=', $id]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        // $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    public function search_result_stock($id){
        $st = \DB::table('stock')->where('id', '=', $id)->get();

        $report_title = $st->first()->serial_no." Serial No. Stock Assets Report";

        $stock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', 1], ['id', '=', $id]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['id', '=', $id]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();

        $ritems = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '!=', 1], ['id', '=', $id]])
                ->get();
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title
        ]);
    }

    public function search_result_status($id){
        $status = \DB::table('status')->where('id', '=', $id)->get();

        $report_title = $status->first()->status." Status Stock Assets Report";

        $stock = \DB::table('stock')
            ->select('product_id', \DB::raw('sum(quantity) as quantity'))
            ->where([['deleted_at', '=', null], ['status_id', '=', $id], ['status_id', '=', 1]])
            ->groupBy('product_id')
            ->orderBy('product_id', 'asc')
            ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where([['deleted_at', '=', null], ['status_id', '=', $id], ['status_id', '=', 1]])
                ->get();

        $rstock = \DB::table('stock')
                ->select('product_id', \DB::raw('sum(quantity) as quantity'))
                ->where([['deleted_at', '=', null], ['status_id', '=', $id], ['status_id', '!=', 1]])
                ->groupBy('product_id')
                ->orderBy('product_id', 'asc')
                ->get();
    
        $ritems = \DB::table('stock')
                    ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                    ->where([['deleted_at', '=', null], ['status_id', '=', $id], ['status_id', '!=', 1]])
                    ->get();
        
                
        $itemss = $items->unique('product_id');
        $ritemss = $ritems->unique('product_id');
        $products = Product::all();
        $classes = Clas::all();
        // $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();

        return view('admin.stock_report.index_print', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'emps' => $emps,
            'itemss' => $itemss,
            'report_title' => $report_title,
            'rstock' => $rstock,
            'ritemss' => $ritemss
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }

    public function getEmpInfo($id)
             {
                $emp = Employee::findOrFail($id);
                echo json_encode($emp);
                 exit;
            } 
}
