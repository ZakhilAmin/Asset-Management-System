<?php

namespace App\Http\Controllers;

use App\Project;
use App\Status;
use Illuminate\Http\Request;

class ProjectController extends Controller
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
        $projects = Project::orderBy('id', 'desc')->sortable()->paginate(10);
        $status = Status::all();
        return view('admin.projects.index', ['projects' => $projects, 'status' => $status]);
    }

    public function index_search($id)
    {
        $projects = Project::where('id', '=', $id)->sortable()->paginate(10);
        $status = Status::all();
        return view('admin.projects.index', ['projects' => $projects, 'status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = Status::all();
        return view('admin.projects.create', ['status' => $status]);
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
            'name' => 'required|max:255',
            'start_date' => '',
            'end_date' => '',
            'status_id' => 'required'
        ]);
        $project = Project::create($validatedData);
   
        return redirect('/admin/projects')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $status = Status::all();

        return view('admin.projects.edit', ['project' => $project, 'status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'start_date' => '',
            'end_date' => '',
            'status_id' => 'required'
        ]);
        Project::whereId($id)->update($validatedData);

        return redirect('/admin/projects')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        if($project->delete()){
            return redirect('/admin/projects')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/projects')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {

        $projects = Project::findOrFail($id);

        return view('admin.projects.search', 
            [
                'projects' => $projects
            ]);
    }
}
