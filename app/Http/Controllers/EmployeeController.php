<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Department;
use App\Project;
use App\Location;

use Illuminate\Http\Request;

class EmployeeController extends Controller
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
        $employees = Employee::orderBy('id', 'desc')->sortable()->paginate(10);
        $departments = Department::all();
        $locations = Location::all();
        return view('admin.employees.index', [
            'employees' => $employees,
            'departments' => $departments,
            'locations' => $locations
        ]);
    }

    public function index_search($id)
    {
        $employees = Employee::where('id', '=', $id)->sortable()->paginate(10);
        $departments = Department::all();
        $locations = Location::all();
        return view('admin.employees.index', [
            'employees' => $employees,
            'departments' => $departments,
            'locations' => $locations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $locations = Location::all();
        $projects = Project::all();
        return view('admin.employees.create', [
            'departments' => $departments, 
            'locations' => $locations, 
            'projects' => $projects
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
        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'ref_no' => 'required|unique:employee,ref_no,except,id',
            'location_id' => 'required',
            'gender' => 'required',
            'job_title' => 'required',
            'project_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'department_id' => 'required'
        ]);
        $employee = Employee::create($validatedData);
   
        return redirect('/admin/employees')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $locations = Location::all();
        $projects = Project::all();
        return view('admin.employees.show', [
            'employee' => $employee,
            'departments' => $departments,
            'locations' => $locations,
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $departments = Department::all();
        $locations = Location::all();
        $projects = Project::all();
        return view('admin.employees.edit', [
            'employee' => $employee, 
            'departments' => $departments, 
            'locations' => $locations,
            'projects' => $projects
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|max:255',
            'ref_no' => 'required',
            'location_id' => 'required',
            'gender' => 'required',
            'job_title' => 'required',
            'project_id' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'department_id' => 'required'
        ]);
        Employee::whereId($id)->update($validatedData);

        return redirect('/admin/employees')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        if($employee->delete()){
            return redirect('/admin/employees')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/employees')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {
        $employees = Employee::findOrFail($id);

        return view('admin.employees.search', 
            [
                'employees' => $employees
            ]);
    }
}
