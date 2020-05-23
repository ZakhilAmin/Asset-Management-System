<?php

namespace App\Http\Controllers;

use App\Returns;
use App\Product;
use App\Employee;
use App\Clas;
use App\Status;
use App\Unit;
use Auth;

use Illuminate\Http\Request;

class ReturnsReportController extends Controller
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
        $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();

        return view('admin.returns_report.index', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status
        ]);
    }

    // public function index_total_returns_print() {
    //     $report_title = "Total Returns Report";
    //     $stock = \DB::table('returns')
    //     ->select('product_id', \DB::raw('sum(quantity) as quantity'))
    //     ->groupBy('product_id')
    //     ->orderBy('product_id', 'asc')
    //     ->get();

    //     $items = \DB::table('returns')
    //             ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
    //             ->where('deleted_at', '=', null)
    //             ->get();
                
    //     $itemss = $items->unique('product_id');
    //     $products = Product::all();
    //     $classes = Clas::all();
    //     $status = Status::all();
    //     $units = Unit::all();
    //     $emps = Employee::all();

    //     return view('admin.stock_report.index_print', [
    //         'stock' => $stock,
    //         'products' => $products,
    //         'classes' => $classes,
    //         'status' => $status,
    //         'units' => $units,
    //         'emps' => $emps,
    //         'itemss' => $itemss,
    //         'report_title' => $report_title
    //     ]);
    // }

    public function indexPrint(){
        $report_title = "Returns Report";
        $meta = null;
        $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function byDateReport(Request $request){
        $report_title = "Returns Report";
        $meta = "From: ".$request->input('startDate')." - To: ".$request->input('endDate');
        $returns = \DB::table('returns')
                ->whereBetween('return_date', array($request->input('startDate'), $request->input('endDate')))
                ->orderBy('return_date', 'asc')
                ->get();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }


    public function search_result_dept($id){
        $departments = \DB::table('department')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['stock.department_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $departments->first()->department." Department Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_category($id){
        $categories = \DB::table('category')->where('id', '=', $id)->get();
        
        $returns = \DB::table('returns')
                    ->select('returns.*')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                    ->join('product', 'product.id', '=', 'returns.product_id')
                    ->where([ ['product.category_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $categories->first()->category." Category Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_class($id){
        $classes = \DB::table('class')->where('id', '=', $id)->get();
        
        $returns = \DB::table('returns')
                    ->select('returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['returns.class_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $classes->first()->class." Class Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        // $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_donar($id){
        $donars = \DB::table('donar')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['stock.donar_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $donars->first()->name." Donar's Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_employee($id){
        $em = \DB::table('employee')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['returns.employee_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $em->first()->full_name." Employee's Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_handover($id){
        $handovers = \DB::table('handover')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['handover.request_ref', '=', $handovers->first()->request_ref], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $handovers->first()->request_ref." Request Ref. Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_location($id){
        $locations = \DB::table('location')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['stock.location_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $locations->first()->name." Location's Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_project($id){
        $projects = \DB::table('project')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['stock.project_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $projects->first()->name." Project's Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_product($id){
        $products = \DB::table('product')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['returns.product_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $products->first()->product." Product's Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        // $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_status($id){
        $status = \DB::table('status')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['returns.status_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $status->first()->status." Status Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        // $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_stock($id){
        $stock = \DB::table('stock')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['stock.id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $stock->first()->serial_no." Serial No. Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
        ]);
    }

    public function search_result_unit($id){
        $units = \DB::table('units')->where('id', '=', $id)->get();
        
        $returns = \DB::table('stock')
                    ->select('returns.*')
                    ->join('returns', 'returns.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.employee_id', '=', 'returns.employee_id')
                     ->where([['stock.deleted_at', '!=', null], ['stock.unit_id', '=', $id], ['handover.deleted_at', '!=', null]])
                    ->get();

        $report_title = $units->first()->unit." Unit's Related Returns Report";
        $meta = null;
        // $returns = Returns::all();
        $products = Product::all();
        $employees = Employee::all();
        $classes = Clas::all();
        $status = Status::all();
        $emps = Employee::all();

        return view('admin.returns_report.index_print', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'classes' => $classes,
            'status' => $status,
            'report_title' => $report_title,
            'meta' => $meta,
            'emps' => $emps
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
     * @param  \App\Returns  $returns
     * @return \Illuminate\Http\Response
     */
    public function show(Returns $returns)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Returns  $returns
     * @return \Illuminate\Http\Response
     */
    public function edit(Returns $returns)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Returns  $returns
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Returns $returns)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Returns  $returns
     * @return \Illuminate\Http\Response
     */
    public function destroy(Returns $returns)
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
