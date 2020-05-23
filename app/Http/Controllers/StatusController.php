<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
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
        $status = Status::orderBy('id', 'desc')->sortable()->paginate(10);

         return view('admin.status.index', ['status' => $status]);
    }

    public function index_search($id)
    {
        $status = Status::where('id', '=', $id)->sortable()->paginate(10);

         return view('admin.status.index', ['status' => $status]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.status.create');
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
            'status' => 'required|max:255'
        ]);
        $status = Status::create($validatedData);
   
        return redirect('/admin/status')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = Status::findOrFail($id);

        return view('admin.status.edit', ['status' => $state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'status' => 'required|max:255'
        ]);
        Status::whereId($id)->update($validatedData);

        return redirect('/admin/status')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        if($status->delete()){
            return redirect('/admin/status')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/status')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {

        $status = Status::findOrFail($id);

        return view('admin.status.search', 
            [
                'status' => $status
            ]);
    }
}
