@extends('layouts.admin-master')

@section('title')
	 Department
@endsection

@section('page_title')
	Edit Department
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Department</h4>
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
            <form method="post" action="{{ route('department.update', $department->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="department">Department Name:</label>
                    <input type="text" class="form-control" name="department" value="{{$department->department}}" required/>
                </div>
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('department.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
