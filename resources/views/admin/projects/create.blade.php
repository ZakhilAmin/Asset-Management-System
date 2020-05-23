@extends('layouts.admin-master')

@section('title')
	 Projects
@endsection

@section('page_title')
	Create Project
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('projects.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')

  <div class="panel panel-primary uper p-relative">
    <div class="panel-heading">
      <h4>Add New project</h4>
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
        <form method="post" action="{{ route('projects.store') }}">
            <div class="form-group">
                @csrf
                <label for="name">Project Name:</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required/>
            </div>

            <div class="form-group">
              <label for="start_date">Project Start Date:</label>
              <input type="date" class="form-control" name="start_date" value="{{ old('start_date') }}"/>
            </div>

            <div class="form-group">
              <label for="end_date">Project End Date:</label>
              <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}"/>
            </div>

            <div class="form-group">
              <label for="status_id">Project Status:</label>
              <select class="form-control" name="status_id">
                <option selected disabled>Select the Status</option>
                @foreach($status as $state)
                  <option value="{{$state->id}}">{{$state->status}}</option>
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