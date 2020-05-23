@extends('layouts.admin-master')

@section('title')
	 Employees
@endsection

@section('page_title')
	Edit Employee
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Employee</h4>
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
            <form method="post" action="{{ route('employees.update', $employee->id) }}">
                @csrf
                @method('PATCH')
                <div class="col-lg-12 col-md-12 col-xs-12">

                  <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="full_name">Employee Name:</label>
                        <input type="text" class="form-control" name="full_name"  value="{{$employee->full_name}}" required/>
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
                          <input type="text" class="form-control" name="ref_no"  value="{{$employee->ref_no}}" required/>
                      </div>
                      </div>
                  
                  <div class="col-lg-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="gender">Gender:</label>
                    <select class="form-control" name="gender" required>
                      <option selected disabled>Select the Gender</option>
                    <option value="0" {{$employee->gender == 0 ? "selected" : ''}}>Male</option>
                      <option value="1" {{$employee->gender == 1 ? "selected" : ''}}>Female</option>
                      <option value="2" {{$employee->gender == 2 ? "selected" : ''}}>Other</option>
                    </select>
                  </div>
                  </div>
                  
                  <div class="col-lg-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="job_title">Job Title:</label>
                    <input type="text" class="form-control" name="job_title"  value="{{$employee->job_title}}" required/>
                  </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                        <label for="project_id">Project:</label>
                        <select class="form-control" name="project_id" required>
                          <option selected disabled>Select the Related Project</option>
                          @foreach($projects as $project)
                          @if($employee->project_id == $project->id)
                            <option value="{{$project->id}}" selected>{{$project->name}}</option>
                          @else
                          <option value="{{$project->id}}">{{$project->name}}</option>
                          @endif
                          @endforeach
                        </select>
                      </div>
                    </div>
      
                <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="form-group">
                  <label for="phone">Phone:</label> 
                  <input type="text" class="form-control" name="phone"  value="{{$employee->phone}}" required/>
                </div>
                </div>
                
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    <label for="department_id">Department:</label>
                    <select class="form-control" name="department_id" required>
                      <option selected disabled>Select the Department</option>
                      @foreach($departments as $department)
                      @if($employee->department_id == $department->id)
                        <option value="{{$department->id}}" selected>{{$department->department}}</option>
                      @else
                      <option value="{{$department->id}}">{{$department->department}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input type="text" class="form-control" name="email"  value="{{$employee->email}}" required/>
                    </div>
                    </div>

                <div class="col-lg-6 col-md-6 col-xs-12">
                  <div class="form-group">
                    <label for="location_id">Province:</label>
                    <select class="form-control" name="location_id" required>
                      <option selected disabled>Select the Province</option>
                      @foreach($locations as $location)
                      @if($employee->location_id == $location->id)
                        <option value="{{$location->id}}" selected>{{$location->name}}</option>
                      @else
                      <option value="{{$location->id}}">{{$location->name}}</option>
                      @endif
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="col-lg-12 col-md-12 col-xs-12">
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('employees.index') }}>Cancel</a>
                </span>
                </div>
            </div>
            </form>
        </div>
      </div>
@endsection
