<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
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
        $units = Unit::orderBy('id', 'desc')->sortable()->paginate(10);

         return view('admin.units.index', ['units' => $units]);
    }

    public function index_search($id)
    {
        $units = Unit::where('id', '=', $id)->sortable()->paginate(10);

         return view('admin.units.index', ['units' => $units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.units.create');
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
            'unit' => 'required|max:255'
        ]);
        $unit = Unit::create($validatedData);
   
        return redirect('/admin/units')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::findOrFail($id);

        return view('admin.units.edit', ['unit' => $unit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'unit' => 'required|max:255'
        ]);
        Unit::whereId($id)->update($validatedData);

        return redirect('/admin/units')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        if($unit->delete()){
            return redirect('/admin/units')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/units')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {
        $units = Unit::findOrFail($id);

        return view('admin.units.search', 
            [
                'units' => $units
            ]);
    }
}
