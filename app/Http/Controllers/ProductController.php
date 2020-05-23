<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Product::orderBy('id', 'desc')->sortable()->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', ['products' => $products, 'categories' => $categories]);
    }

    public function index_search($id)
    {
        $products = Product::where('id', '=', $id)->sortable()->paginate(10);
        $categories = Category::all();
        return view('admin.products.index', ['products' => $products, 'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', ['categories' => $categories]);
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
            'product' => 'required|max:255',
            'manufacturer' => '',
            'brand' => '',
            'model' => '',
            'category_id' => 'required'
        ]);
        $product = Product::create($validatedData);
   
        return redirect('/admin/products')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product' => 'required|max:255',
            'manufacturer' => '',
            'brand' => '',
            'model' => '',
            'category_id' => 'required'
        ]);
        Product::whereId($id)->update($validatedData);

        return redirect('/admin/products')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->delete()){
            return redirect('/admin/products')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/products')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {

        $products = Product::findOrFail($id);

        return view('admin.products.search', 
            [
                'products' => $products
            ]);
    }
}
