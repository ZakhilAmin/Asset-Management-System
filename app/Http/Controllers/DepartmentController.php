<?php

namespace App\Http\Controllers;

use App\Department;
use DB;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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
        $departments = Department::orderBy('id', 'desc')->sortable()->paginate(10);
         return view('admin.departments.index', ['departments' => $departments]);
    }

    public function index_search($id)
    {
        $departments = Department::where('id', '=', $id)->sortable()->paginate(10);
         return view('admin.departments.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.create');
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
            'department' => 'required|max:255'
        ]);
        $department = Department::create($validatedData);
   
        return redirect('/admin/department')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = Department::findOrFail($id);

        return view('admin.departments.edit', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'department' => 'required|max:255'
        ]);
        Department::whereId($id)->update($validatedData);

        return redirect('/admin/department')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        if($department->delete()){
            return redirect('/admin/department')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/department')->with('fail', 'Record Deletion failed!');
        
    }

    public function search($id)
    {

        $departments = Department::findOrFail($id);

        return view('admin.departments.search', 
            [
                'departments' => $departments
            ]);
    }
}
