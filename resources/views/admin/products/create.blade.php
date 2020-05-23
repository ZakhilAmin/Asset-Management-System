@extends('layouts.admin-master')

@section('title')
	 Product
@endsection

@section('page_title')
	Create Product
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('products.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')

  <div class="panel panel-primary uper p-relative">
    <div class="panel-heading">
      <h4>Add New Product</h4>
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
        <form method="post" action="{{ route('products.store') }}">
          @csrf
            <div class="form-group">
                <label for="product">Product Name:</label>
                <input type="text" class="form-control" name="product" value="{{ old('product') }}" required/>
            </div>

            <div class="form-group">
              <label for="manufacturer">Manufacturer:</label>
              <input type="text" class="form-control" name="manufacturer" value="{{ old('manufacturer') }}"/>
          </div>

          <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" class="form-control" name="brand" value="{{ old('brand') }}"/>
          </div>

          <div class="form-group">
            <label for="model">Model:</label>
            <input type="text" class="form-control" name="model" value="{{ old('model') }}"/>
          </div>

            <div class="form-group">
              <label for="category_id">Category:</label>
              <select class="form-control" name="category_id" >
                <option selected disabled>Select the Category</option>
                @foreach($categories as $category)
                  <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
              </select>
            </div>
            
            <span>
            <button type="submit" class="btn btn-success">&nbsp;Save</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            </span>
            <span>

            </span>
        </form>
    </div>
  </div>
@endsection