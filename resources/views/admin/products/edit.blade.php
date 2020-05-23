@extends('layouts.admin-master')

@section('title')
	 Products
@endsection

@section('page_title')
	Edit Product
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Product</h4>
        </div>
        <div class="panel-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
            <form method="post" action="{{ route('products.update', $product->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')

                  <div class="form-group">
                    <label for="product">Product Name:</label>
                    <input type="text" class="form-control" name="product" value="{{$product->product}}" required/>
                </div>
    
                <div class="form-group">
                  <label for="manufacturer">Manufacturer:</label>
                  <input type="text" class="form-control" name="manufacturer" value="{{$product->manufacturer}}"/>
              </div>
    
              <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" class="form-control" name="brand" value="{{$product->brand}}"/>
              </div>
    
              <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" class="form-control" name="model" value="{{$product->model}}"/>
              </div>
    
                <div class="form-group">
                  <label for="category_id">Category:</label>
                  <select class="form-control" name="category_id" >
                    <option selected disabled>Select the Category</option>
                    @foreach($categories as $category)
                      @if($product->category_id == $category->id)
                      <option value="{{$category->id}}" selected>{{$category->category}}</option>
                      @else
                      <option value="{{$category->id}}">{{$category->category}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                </div>
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('products.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
