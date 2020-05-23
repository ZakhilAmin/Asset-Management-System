@extends('layouts.admin-master')

@section('title')
	 Department
@endsection

@section('page_title')
	Create Department
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('department.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')

  <div class="panel panel-primary uper p-relative">
    <div class="panel-heading">
      <h4>Add New Departmen</h4>
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
        <form method="post" action="{{ route('department.store') }}">
            <div class="form-group">
                @csrf
                <label for="department">Department Name:</label>
                <input type="text" class="form-control" name="department" value="{{ old('department') }}" required/>
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