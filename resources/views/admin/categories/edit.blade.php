@extends('layouts.admin-master')

@section('title')
	 Categories
@endsection

@section('page_title')
	Edit Category
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Category</h4>
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
            <form method="post" action="{{ route('categories.update', $category->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="category">Category Name:</label>
                    <input type="text" class="form-control" name="category" value="{{$category->category}}" required/>
                </div>
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('categories.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
