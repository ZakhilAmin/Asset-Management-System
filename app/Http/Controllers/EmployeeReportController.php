<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Department;
use App\Product;
use App\Project;
use App\Handover;
use App\HandoverDetails;
use PDF;
use DB;
use PdfReport;
use Illuminate\Http\Request;


class EmployeeReportController extends Controller
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
        $employees = Employee::all();
        // $eid = $id;
        // $employees = \DB::table('employee')
        //     ->select('employee.ref_no', 'employee.full_name','employee.job_title','employee.department_id','employee.project_id', 'handover.request_ref', 'handover.handover_date','handover.handovered_emp', 'handover_details.product_id','handover_details.tag_no','handover_details.quantity','handover_details.remarks', 'stock.cost')
        //     ->leftjoin('handover',function($join, $eid){
        //     $join->on('handover.employee_id', '=', 'employee.id')
        //     ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        //     ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        //     ->where([['handover.deleted_at', '=', null], ['employee.id', '=', $eid]]);
        // })                   
        // ->get();

        $departments = Department::all();
        $projects = Project::all();

        return view('admin.employee_report.index', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects
        ]);
    }

    public function indexPrint($id) {
        $report_title = "Employee Handovers Report";
        // $employees = \DB::table('employee')
        //         ->select('employee.ref_no', 'employee.full_name','employee.job_title','employee.department_id','employee.project_id', 'handover.request_ref', 'handover.handover_date','handover.handovered_emp', 'handover_details.product_id','handover_details.tag_no','handover_details.quantity','handover_details.remarks', 'stock.cost')
        //         ->join('handover',function($join){
        //         $join->on('handover.employee_id', '=', 'employee.id')
        //         ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        //         ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        //         ->where([['handover.deleted_at', '=', null], ['employee.id', '=', 2]]);
        //     })                   
        //     ->get();
        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['employee.id', '=', $id]])
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title,
            'empid' => $id
        ]);
    }

    public function printAll() {
        $report_title = "All Employees' Handover Report";
        // $employees = \DB::table('employee')
        //         ->select('employee.ref_no', 'employee.full_name','employee.job_title','employee.department_id','employee.project_id', 'handover.request_ref', 'handover.handover_date','handover.handovered_emp', 'handover_details.product_id','handover_details.tag_no','handover_details.quantity','handover_details.remarks', 'stock.cost')
        //         ->join('handover',function($join){
        //         $join->on('handover.employee_id', '=', 'employee.id')
        //         ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        //         ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        //         ->where([['handover.deleted_at', '=', null]]);
        //     })                   
        //     ->get();
        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null]])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_dept($id) {

        $departments = \DB::table('department')->where('id', '=', $id)->get();
        
        $report_title = $departments->first()->department." Department Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['employee.department_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_donar($id) {

        $donars = \DB::table('donar')->where('id', '=', $id)->get();
        
        $report_title = $donars->first()->name." Donar Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['stock.donar_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_handover($id) {

        $handovers = \DB::table('handover')->where('id', '=', $id)->get();
        
        $report_title = $handovers->first()->request_ref." Request Ref. Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['handover.request_ref', '=', $handovers->first()->request_ref] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_category($id) {

        $categories = \DB::table('category')->where('id', '=', $id)->get();
        
        $report_title = $categories->first()->category." Category Product Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->join('product', 'product.id', '=', 'stock.product_id')
        ->where([['handover.deleted_at', '=', null], ['product.category_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_class($id) {

        $classes = \DB::table('class')->where('id', '=', $id)->get();
        
        $report_title = $classes->first()->class." Class Related Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['stock.class_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_location($id) {

        $locations = \DB::table('location')->where('id', '=', $id)->get();
        
        $report_title = $locations->first()->name." Location Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['employee.location_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_product($id) {

        $products = \DB::table('product')->where('id', '=', $id)->get();
        
        $report_title = $products->first()->product." Product's Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['stock.product_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        // $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_project($id) {

        $projects = \DB::table('project')->where('id', '=', $id)->get();
        
        $report_title = $projects->first()->name." Project Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['employee.project_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        // $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_status($id) {

        $status = \DB::table('status')->where('id', '=', $id)->get();
        
        $report_title = $status->first()->status." Status Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['stock.status_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_unit($id) {

        $units = \DB::table('units')->where('id', '=', $id)->get();
        
        $report_title = $units->first()->unit." Unit Products Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['stock.unit_id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_employee($id) {

        $emp = \DB::table('employee')->where('id', '=', $id)->get();
        
        $report_title = $emp->first()->full_name." Employee's Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['employee.id', '=', $id] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    public function search_result_stock($id) {

        $stock = \DB::table('stock')->where('id', '=', $id)->get();
        
        $report_title = $stock->first()->serial_no." Serial No. Employees' Handover Report";

        $employees = \DB::table('employee')
        ->select('employee.*', 'handover.*', 'handover_details.*', 'stock.*', 'handover_details.quantity as qty')
        ->join('handover', 'handover.employee_id', '=', 'employee.id')
        ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
        ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
        ->where([['handover.deleted_at', '=', null], ['stock.serial_no', '=', $stock->first()->serial_no] ])
        ->orderBy('employee.id', 'asc')
        ->get();

        $departments = Department::all();
        $projects = Project::all();
        $products = Product::all();
        $emps = Employee::all();

        return view('admin.employee_report.index_print', [
            'employees' => $employees,
            'departments' => $departments,
            'projects' => $projects,
            'products' => $products,
            'emps' => $emps,
            'report_title' => $report_title
        ]);
    }

    // public function exportPdf($id)
    // { 
    //     $report_title = "Employee Handovers Report";

    //     $employees = \DB::table('employee')
    //     ->join('handover', 'handover.employee_id', '=', 'employee.id')
    //     ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
    //     ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
    //     ->where([['handover.deleted_at', '=', null], ['employee.id', '=', $id]])
    //     ->get();
        
    //     $departments = Department::all();
    //     $projects = Project::all();
    //     $products = Product::all();
    //     $emps = Employee::all();
    //     // Send data to the view using loadView function of PDF facade
        
    //     $pdf = PDF::loadView('admin.employee_report.index_pdf', [
    //         'employees' => $employees,
    //         'departments' => $departments,
    //         'projects' => $projects,
    //         'products' => $products,
    //         'emps' => $emps,
    //         'report_title' => $report_title,
    //         'empid' => $id
    //     ], [], [
    //         'format' => 'A4-L'
    //       ]);
    //     // $pdf->setPaper('A4','landscape');
    //     // If you want to store the generated pdf to the server then you can use the store function
    //     // $pdf->save(storage_path().'_filename.pdf');
    //     // Finally, you can download the file using download function
    //     // return $pdf->download('Employee-Handover_Report.pdf');
    //     return $pdf->stream('emp_report.pdf');
    // }

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
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function displayReport(Request $request)
    {
            // $fromDate = $request->input('from_date');
            // $toDate = $request->input('to_date');
            // $sortBy = $request->input('sort_by');

            $title = "All Employees Report"; // Report title

            $meta = [ // For displaying filters description on header
                // 'Registered on' => $fromDate . ' To ' . $toDate,
                // 'Sort By' => $sortBy
            ];

            // $queryBuilder = User::select(['name', 'balance', 'registered_at']) // Do some querying..
            //                     ->whereBetween('registered_at', [$fromDate, $toDate])
            //                     ->orderBy($sortBy);

            $queryBuilder = \DB::table('employee')
                         ->select('employee.ref_no', 'employee.full_name','employee.job_title','employee.department_id','employee.project_id', 'handover.request_ref', 'handover.handover_date','handover.handovered_emp', 'handover_details.product_id','handover_details.tag_no','handover_details.quantity','handover_details.remarks', 'stock.cost')
                        // ->leftjoin('handover', 'handover.employee_id', '=', 'employee.id')
                        // ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
                        // ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
                        // ->where([['handover.deleted_at', '=', null],['employee.id', '=', 2]])
                        ->leftjoin('handover',function($join){
                            $join->on('handover.employee_id', '=', 'employee.id')
                            ->join('handover_details', 'handover_details.handover_id', '=', 'handover.id')
                            ->join('stock', 'stock.tag_no', '=', 'handover_details.tag_no')
                            ->where([['handover.deleted_at', '=', null]]);
                        })                   
                        ->get();
                        dd($queryBuilder);
            
            $columns = [ // Set Column to be displayed
                'Ref. No' => 'employee.ref_no',
                'Employee Name' => 'employee.full_name', // if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
                // 'Gender' => function($result) { // You can do if statement or any action do you want inside this closure
                //     return ($result->gender == 0) ? 'Male' : 'Female';
                    
                // },
                'Job' => 'employee.job_title',
                'Department' => function($result) { // You can do if statement or any action do you want inside this closure
                     $departments = Department::all();
                    foreach($departments as $d){
                        if($result->department_id == $d->id)
                        return ($d->department);
                    }
                },
                'Project' => function($result) { // You can do if statement or any action do you want inside this closure
                    $projects = Project::all();
                    foreach($projects as $d){
                        if($result->department_id == $d->id)
                        return ($d->name);
                    }
                },
                'Request Ref.' => 'handover.request_ref',
                'Handover Date' => 'handover.handover_date',
                'Handovered By' => function($result) { // You can do if statement or any action do you want inside this closure
                    $emps = Employee::all();
                    foreach($emps as $emp){
                        if($result->handovered_emp == $emp->id)
                        return ($emp->full_name);
                    }
                },
                'Product' => function($result) { // You can do if statement or any action do you want inside this closure
                    $products = Product::all();
                    foreach($products as $pro){
                        if($result->product_id == $pro->id)
                        return ($pro->product.'-'.$pro->model);
                    }
                },
                'Tag No' => 'handover_details.tag_no',
                'Cost Price' => 'stock.cost',
                'Quantity' => 'handover_details.quantity',
                'Total Cost' => function($result) {
                    return ($result->quantity * $result->cost);
                },
                'Remarks' => 'handover_details.remarks',

            ];
            
            // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
            return PdfReport::of($title, $meta, $queryBuilder, $columns)
                             ->setPaper('a4')
                             ->setOrientation('landscape')
                             ->editColumn('Cost Price', [
                                 'class' => 'center bold',
                                 'displayAs' => function($result) {
                                     return thousandSeparator($result->cost);
                                 }
                             ])
                             ->editColumns(['Ref. No'], [ // Mass edit column
                                 'class' => 'left bold'
                             ])
                             ->showTotal([ 
                                 'Total Cost' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                             ])
                             ->groupBy('Ref. No')
                            //  ->limit(2) // Limit record to be showed
                             ->stream(); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
             }

             public function getEmployeeInfo($id)
             {
                $emp = Employee::findOrFail($id);
                echo json_encode($emp);
                 exit;
            }            
}
