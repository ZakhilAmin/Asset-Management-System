<?php

namespace App\Http\Controllers;

use App\ReturnLog;
use App\Product;
use App\Stock;
use App\Employee;
use App\Status;
use App\Clas;
use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReturnsLogController extends Controller
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
        $returns = ReturnLog::orderBy('id', 'desc')->sortable()->paginate(10);//orderBy('updated_at', 'DESC')->get();//HandoverLog::all();
        $products = Product::all();
        $employees = Employee::all();
        $status = Status::all();
        $classes = Clas::all();

        return view('admin.returnslogs.index', [
            'returns' => $returns,
            'products' => $products,
            'employees' => $employees,
            'status' => $status,
            'classes' => $classes
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $return = ReturnLog::findOrFail($id);
        $products = Product::all();
        $employees = Employee::all();
        $stock = Stock::all();
        $status = Status::all();
        $classes = Clas::all();
        $userId = Auth::user()->id;

        return view('admin.returnslogs.show', [
            'return' => $return,
            'products' => $products,
            'employees' => $employees,
            'stock' => $stock,
            'status' => $status,
            'classes' => $classes,
            'userId' => $userId
            ]);
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
}
