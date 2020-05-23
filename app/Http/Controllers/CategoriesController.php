<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
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
        $categories = Category::orderBy('id', 'desc')->sortable()->paginate(10);

         return view('admin.categories.index', ['categories' => $categories]);
    }

    public function index_search($id)
    {
        $categories = Category::where('id', '=', $id)->sortable()->paginate(10);

         return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'category' => 'required|max:255'
        ]);
        $category = Category::create($validatedData);
   
        return redirect('/admin/categories')->with('success', 'Record Saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category' => 'required|max:255'
        ]);
        Category::whereId($id)->update($validatedData);

        return redirect('/admin/categories')->with('success', 'Record Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category->delete()){
            return redirect('/admin/categories')->with('success', 'Record Deleted Successfully!');
        }
            return redirect('/admin/categories')->with('fail', 'Record Deletion failed!');
    }

    public function search($id)
    {

        $categories = Category::findOrFail($id);

        return view('admin.categories.search', 
            [
                'categories' => $categories
            ]);
    }
}
