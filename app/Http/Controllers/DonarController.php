<?php

namespace App\Http\Controllers;

use App\Donar;
use Illuminate\Http\Request;

class DonarController extends Controller
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
        $donars = Donar::orderBy('id', 'desc')->sortable()->paginate(10);

         return view('admin.donars.index', ['donars' => $donars]);
    }

    public function index_search($id)
    {
        $donars = Donar::where('id', '=', $id)->sortable()->paginate(10);

         return view('admin.donars.index', ['donars' => $donars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.donars.create');
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
            'name' => 'required|max:255'
        ]);
        $donar = Donar::create($validatedData);
   
        return redirect('/admin/donar')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donar  $donar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donar  $donar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $donar = Donar::findOrFail($id);

        return view('admin.donars.edit', ['donar' => $donar]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donar  $donar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255'
        ]);
        Donar::whereId($id)->update($validatedData);

        return redirect('/admin/donar')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donar  $donar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donar = Donar::findOrFail($id);
        if($donar->delete()){
            return redirect('/admin/donar')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/donar')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {
        $donars = Donar::findOrFail($id);

        return view('admin.donars.search', 
            [
                'donars' => $donars
            ]);
    }
}
