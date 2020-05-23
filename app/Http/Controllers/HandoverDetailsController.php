<?php

namespace App\Http\Controllers;

use Auth;
use App\Product;
use App\Handover;
use App\Stock;
use DB;

use App\HandoverDetails;
use Illuminate\Http\Request;

class HandoverDetailsController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth');
        $this->middleware('superuser')->except(['view']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function view($id){
        $products = Product::all();
        $stock = Stock::all();
        $handovers = Handover::all();
        $details = DB::table('handover_details')->where('handover_id', '=', $id)->get();
        return view('admin.handovers_details.index', [
            'handovers' => $handovers,
            'stocl' => $stock,
            'products' => $products,
            'details' => $details
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
     * @param  \App\HandoverDetails  $handoverDetails
     * @return \Illuminate\Http\Response
     */
    public function show(HandoverDetails $handoverDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HandoverDetails  $handoverDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $detail = HandoverDetails::findOrFail($id);
        // $products = Product::all();

        // return view('admin.handovers_details.edit', ['detail' => $detail, 'products'=>$products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HandoverDetails  $handoverDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'product_id' => 'required',
        //     'handover_id' => 'required',
        //     'quantity' => 'required',
        //     'tag_no' => 'required',
        //     'remarks' => ''
        // ]);
        // HandoverDetails::whereId($id)->update($validatedData);

        // return redirect('/admin/handover/handover_details/'.$request->input('handover_id'))->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HandoverDetails  $handoverDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(HandoverDetails $handoverDetails)
    {
        // $department = Department::findOrFail($id);
        // if($department->delete()){
        //     return redirect('/admin/department')->with('success', 'Record Deleted Successfully!');
        // }
        //     return redirect('/admin/department')->with('fail', 'Record Deletion failed!');
    }
}
