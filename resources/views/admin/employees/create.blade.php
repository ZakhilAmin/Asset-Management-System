@extends('layouts.admin-master')

@section('title')
	 Employees
@endsection

@section('page_title')
	Create Employee
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('employees.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')

  <div class="panel panel-primary uper p-relative">
    <div class="panel-heading">
      <h4>Add New Employee</h4>
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
        <form method="post" action="{{ route('employees.store') }}">
          @csrf
          <div class="col-lg-12 col-md-12 col-xs-12">

            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="full_name">Employee Name:</label>
                    <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" required/>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-12">
                <div>
                  <span><br><br><br><br></span>
                </div>
            </div>

            
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                    <label for="ref_no">Employee Ref No:</label>
                    <input type="text" class="form-control" name="ref_no" value="{{ old('ref_no') }}" required/>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="gender">Gender:</label>
                  <select class="form-control" name="gender" required>
                    <option selected disabled>Select the Gender</option>
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                    <option value="2">Other</option>
                  </select>
                </div>
            </div>
          

          <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
                <label for="job_title">Job Title:</label>
                <input type="text" class="form-control" name="job_title" value="{{ old('job_title') }}" required/>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="project_id">Project:</label>
                <select class="form-control" name="project_id" required>
                  <option selected disabled>Select the Related Project</option>
                  @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          
          <div class="col-lg-6 col-md-6 col-xs-12">
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required/>
          </div>
          </div>
          
          <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="department_id">Department:</label>
              <select class="form-control" name="department_id" required>
                <option selected disabled>Select the Department</option>
                @foreach($departments as $department)
                  <option value="{{$department->id}}">{{$department->department}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-xs-12">
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" required/>
              </div>
              </div>

          <div class="col-lg-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label for="location_id">Province:</label>
              <select class="form-control" name="location_id" required >
                <option selected disabled>Select the Province</option>
                @foreach($locations as $location)
                  <option value="{{$location->id}}">{{$location->name}}</option>
                @endforeach
              </select>
            </div>
          </div>

            <div class="col-lg-12 col-md-12 col-xs-12">
            <button type="submit" class="btn btn-success">&nbsp;Save</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            </div>
          </div>
        </form>
    </div>
  </div>
@endsection