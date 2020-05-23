<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Employee;
use App\Handover;
use App\Stock;
use App\Product;
use App\Status;
use App\Clas;
use App\Unit;
use App\Department;
use App\Location;
use App\Donar;
use App\Project;

use App\HandoverDetails;

use Illuminate\Http\Request;

class GeneralReportController extends Controller
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
        // $stocked = DB::table('stock')
        //             ->where('deleted_at', '=', null)
        //             ->get();   
        
        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.cost', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null]])
                    ->get();

        // dd($handovered);
        // $handovers = Handover::all();
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $employees = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'employees' => $employees,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments
            ]);
    } 

    public function indexPrint(Request $request){
        $report_title = "Assets Report";

        $meta = null;
        // $stocked = DB::table('stock')
        //             ->where('deleted_at', '=', null)
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function byDateReport(Request $request){
        $report_title = "Assets Report";

        $meta = "From: ".$request->input('startDate')." - To: ".$request->input('endDate');

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0]])
                    ->whereBetween('returns.return_date', array($request->input('startDate'), $request->input('endDate')))
                    ->get();

        // $stocked = DB::table('stock')
        //             ->where('deleted_at', '=', null)
        //             ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                    ->where([['handover.deleted_at', '=', null]])
                    ->whereBetween('handover_date', array($request->input('startDate'), $request->input('endDate')))
                    ->get();

        // dd($handovered->isEmpty());
        $flag = 0;
        if($handovered->isEmpty()){
            $flag = 1;
        }
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_dept(Request $request, $id){
        $departments = \DB::table('department')->where('id', '=', $id)->get();

        $report_title = $departments->first()->department." Department Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['department_id', '=', $id]])
        //             ->get();
        
        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['department_id', '=', $id]])
                    ->get();

        

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['stock.department_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_category(Request $request, $id){
        $categories = \DB::table('category')->where('id', '=', $id)->get();

        $report_title = $categories->first()->category." Category's Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->select('stock.*')
        //             ->join('product', 'product.id', '=', 'stock.product_id')
        //             ->where([['deleted_at', '=', null], ['product.category_id', '=', $id]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->join('product', 'product.id', '=', 'stock.product_id')
                    ->where([['stock.cost', '=', 0], ['product.category_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                    ->join('product', 'product.id', '=', 'stock.product_id')
                     ->where([['handover.deleted_at', '=', null], ['product.category_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_class(Request $request, $id){
        $classes = \DB::table('class')->where('id', '=', $id)->get();

        $report_title = $classes->first()->class." Class Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['class_id', '=', $id]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['returns.class_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['stock.class_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        // $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_donar(Request $request, $id){
        $donars = \DB::table('donar')->where('id', '=', $id)->get();

        $report_title = $donars->first()->name." Donar's Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['donar_id', '=', $id]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['stock.donar_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['stock.donar_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        // $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_employee(Request $request, $id){
        $employees = \DB::table('employee')->where('id', '=', $id)->get();

        $report_title = $employees->first()->full_name." Employee's Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['returns.employee_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['handover.employee_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_handover(Request $request, $id){
        $handovers = \DB::table('handover')->where('id', '=', $id)->get();

        $report_title = $handovers->first()->request_ref." Requst Ref. Assets Report";

        $meta = null;

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->join('handover', 'returns.employee_id', '=', 'handover.employee_id')
                    ->where([['stock.cost', '=', 0], ['handover.request_ref', '=', $handovers->first()->request_ref]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['handover.request_ref', '=', $handovers->first()->request_ref]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_location(Request $request, $id){
        $locations = \DB::table('location')->where('id', '=', $id)->get();

        $report_title = $locations->first()->name." Location's Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['location_id', '=', $id]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['stock.location_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['stock.location_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        // $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_product(Request $request, $id){
        $products = \DB::table('product')->where('id', '=', $id)->get();

        $report_title = $products->first()->product." Product's Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['product_id', '=', $id]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['returns.product_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['stock.product_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        // $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_project(Request $request, $id){
        $projects = \DB::table('project')->where('id', '=', $id)->get();

        $report_title = $projects->first()->name." Project's Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['project_id', '=', $id]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['stock.project_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['stock.project_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        // $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_status(Request $request, $id){
        $status = \DB::table('status')->where('id', '=', $id)->get();

        $report_title = $status->first()->status." Status Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['status_id', '=', $id]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['returns.status_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['stock.status_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        // $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_stock(Request $request, $id){
        $stock = \DB::table('stock')->where('id', '=', $id)->get();

        $report_title = $stock->first()->serial_no." Serial No. Related Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['serial_no', '=', $stock->first()->serial_no]])
        //             ->get();
        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['stock.serial_no', '=', $stock->first()->serial_no]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['serial_no', '=', $stock->first()->serial_no]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }

    public function search_result_unit(Request $request, $id){
        $units = \DB::table('units')->where('id', '=', $id)->get();

        $report_title = $units->first()->unit." Unit Related Assets Report";

        $meta = null;

        // $stocked = DB::table('stock')
        //             ->where([['deleted_at', '=', null], ['unit_id', '=', $id]])
        //             ->get();

        $stocked = DB::table('returns')
                    ->select('stock.serial_no', 'stock.contract_date', 'stock.receive_date', 'stock.m7', 'stock.m16', 'stock.unit_id', 'stock.project_id', 'stock.department_id', 'stock.donar_id', 'stock.location_id', 'stock.expected_life', 'stock.description', 'returns.*')
                    ->join('stock', 'stock.tag_no', '=', 'returns.tag_no')
                    ->where([['stock.cost', '=', 0], ['stock.unit_id', '=', $id]])
                    ->get();

        $handovered = DB::table('stock')
                    ->select('stock.*', 'handover.employee_id')
                    ->join('handover_details', 'handover_details.tag_no', '=', 'stock.tag_no')
                    ->join('handover', 'handover.id', '=', 'handover_details.handover_id')
                     ->where([['handover.deleted_at', '=', null], ['stock.unit_id', '=', $id]])
                    ->get();

        // dd($handovered);
        $flag = 0;
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        // $units = Unit::all();
        $emps = Employee::all();
        $projects = Project::all();
        $donars = Donar::all();
        $locations = Location::all();
        $departments = Department::all();

            return view('admin.general_report.index_print', [
                'stocked' => $stocked,
                'handovered' => $handovered,
                'products' => $products,
                'classes' => $classes,
                'status' => $status,
                'emps' => $emps,
                'units' => $units,
                'projects' => $projects,
                'donars' => $donars,
                'locations' => $locations,
                'departments' => $departments,
                'report_title' => $report_title,
                'meta' => $meta,
                'flag' => $flag
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $report_title = "Stock Report";
        $stock = \DB::table('stock')
        ->select('product_id', \DB::raw('sum(quantity) as quantity'))
        ->where('deleted_at', '=', null)
        ->groupBy('product_id')
        ->orderBy('product_id', 'asc')
        ->get();

        $items = \DB::table('stock')
                ->select('product_id', 'status_id', 'class_id', 'unit_id', 'cost')
                ->where('deleted_at', '=', null)
                ->get();
                
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
            'report_title' => $report_title
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
