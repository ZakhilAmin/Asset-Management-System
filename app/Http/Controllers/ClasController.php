<?php

namespace App\Http\Controllers;

use App\Clas;
use Illuminate\Http\Request;

class ClasController extends Controller
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
        $classes = Clas::orderBy('id', 'desc')->sortable()->paginate(10);

        return view('admin.classes.index', ['classes' => $classes]);
    }

    public function index_search($id)
    {
        $classes = Clas::where('id', '=', $id)->sortable()->paginate(10);

        return view('admin.classes.index', ['classes' => $classes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.classes.create');
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
            'class' => 'required|max:255'
        ]);
        $clas = Clas::create($validatedData);
   
        return redirect('/admin/class')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function show(Clas $clas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clas = Clas::findOrFail($id);

        return view('admin.classes.edit', ['class' => $clas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'class' => 'required|max:255'
        ]);
        Clas::whereId($id)->update($validatedData);

        return redirect('/admin/class')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clas  $clas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clas = Clas::findOrFail($id);
        if($clas->delete()){
            return redirect('/admin/class')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/class')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {

        $classes = Clas::findOrFail($id);

        return view('admin.classes.search', 
            [
                'classes' => $classes
            ]);
    }
}
