<?php

namespace App\Http\Controllers;

use App\User;
use App\Employee;
use App\Project;
use App\Department;
use App\Status;

use DB;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct() 
    {
      $this->middleware('auth');
        $this->middleware('admin')->except(['index','show','edit', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()){
        if(Auth::user()->emp_type == 2 || Auth::user()->emp_type == 3){
            $users = User::where('id', '=', Auth::user()->id)->sortable()->paginate(10);

            return view('admin.users.index', ['users' => $users]);  
        }
    }
        $users = User::orderBy('id', 'desc')->sortable()->paginate(10);

         return view('admin.users.index', ['users' => $users]);
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $employee = Employee::findOrFail($user->emp_id);
        $projects = Project::all();
        $departments = Department::all();
        $status = Status::all();
        return view('admin.users.show', [
            'user' => $user,
            'employee' => $employee,
            'projects' => $projects,
            'departments' => $departments,
            'status' => $status
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $employee = Employee::findOrFail($user->emp_id);
        return view('admin.users.edit', [
            'user' => $user,
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()){
        $password = $request->input('old_password');
        $hashedPassword = User::findOrFail($id)->password;//Auth::user()->password;  // Taking the value from database

        if(Hash::check($password, $hashedPassword))
        {
        $validatedData = $request->validate([
            'old_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        DB::table('users')
            ->where([
                ['id', '=', $id]
            ])
            ->update(['password' => Hash::make($request->input('password'))]);

            return redirect(route('users.show', $id))->with('success', 'Password changed Successfully!!');
        }else{
            return redirect()->back()->with('fail', 'Your current password in not correct, Try Again!');
        }
    }else{
        return redirect()->back()->with('fail', 'Not working now, Try Again!');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->delete()){
            return redirect('/admin/users')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/users')->with('fail', 'Record Deletion failed!');
    }
}
