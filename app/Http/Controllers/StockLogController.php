<?php

namespace App\Http\Controllers;

use App\StockLog;
use App\Stock;
use App\Product;
use App\Clas;
use App\Status;
use App\Unit;
use App\Donar;
use App\Location;
use App\Project;
use App\Department;

use Auth;
use Illuminate\Http\Request;

class StockLogController extends Controller
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
        $stock = StockLog::orderBy('id', 'desc')->sortable()->paginate(10);//orderBy('updated_at', 'DESC')->get();//::all();
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        return view('admin.stocklogs.index', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units
            ]);
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
     * @param  \App\StockLog  $stockLog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = StockLog::findOrFail($id);
        $products = Product::all();
        $classes = Clas::all();
        $status = Status::all();
        $units = Unit::all();
        $userId = Auth::user()->id;
        $donars = Donar::all();
        $locations = Location::all();
        $projects = Project::all();
        $departments = Department::all();

        return view('admin.stocklogs.show', [
            'stock' => $stock,
            'products' => $products,
            'classes' => $classes,
            'status' => $status,
            'units' => $units,
            'userId' => $userId,
            'donars' => $donars,
            'locations' => $locations,
            'projects' => $projects,
            'departments' => $departments
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StockLog  $stockLog
     * @return \Illuminate\Http\Response
     */
    public function edit(StockLog $stockLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StockLog  $stockLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StockLog $stockLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StockLog  $stockLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(StockLog $stockLog)
    {
        //
    }
}
