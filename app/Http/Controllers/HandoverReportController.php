<?php

namespace App\Http\Controllers;

use App\Handover;
use App\Product;
use App\Stock;
use App\Employee;
use App\Unit;
use App\Status;
use App\Clas;
use Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HandoverReportController extends Controller
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
        $handovers = Handover::all();
        $products = Product::all();
        $units = Unit::all();
        $employees = Employee::all();

            return view('admin.handover_report.index', [
                'handovers' => $handovers,
                'products' => $products,
                'employees' => $employees,
                'units' => $units
            ]);
    }

    public function indexPrint() {
        $handovers = Handover::all();
        $products = Product::all();
        $units = Unit::all();
        $employees = Employee::all();

        return view('admin.handover_report.index_print', [
                'handovers' => $handovers,
                'products' => $products,
                'employees' => $employees,
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
     * @param  \App\Handover  $handover
     * @return \Illuminate\Http\Response
     */
    public function show(Handover $handover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Handover  $handover
     * @return \Illuminate\Http\Response
     */
    public function edit(Handover $handover)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Handover  $handover
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Handover $handover)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Handover  $handover
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handover $handover)
    {
        //
    }
}
