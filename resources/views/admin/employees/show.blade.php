@extends('layouts.admin-master')

@section('title')
	 Employees
@endsection

@section('page_title')
	Employee Details
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('employees.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
        <h4>View <strong>{{$employee->full_name}}</strong> Details</h4>
        </div>
        <div class="panel-body">
          <div class="col-lg-12 col-md-12 col-xs-12">
              <div class="col-lg-9 col-md-9 col-xs-12">
              <h3>Employee ID: {{$employee->id}}</h3>
              <h3>Employee Name: {{$employee->full_name}}</h3>
              <h3>Ref No: {{$employee->ref_no}}</h3>
              <h3>Project: 
                  @foreach($projects as $project)
                  @if($employee->project_id == $project->id)
                  {{$project->name}}
                  @endif
                  @endforeach
              </h3>
              <hr>
              </div>
          
          <div class="col-lg-9 col-md-9 col-xs-12 pull-left">
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Gender</h4>
                <h5>{{$employee->gender==0 ? "Male" : ($employee->gender==1 ? "Female" : "Other")}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Job Title</h4>
                <h5>{{$employee->job_title}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Phone</h4>
                <h5>{{$employee->phone}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Email</h4>
                <h5>{{$employee->email}}</h5>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Department</h4>
                @foreach($departments as $department)
                @if($employee->department_id == $department->id)
                <h5>{{$department->department}}</h5>
                @endif
                @endforeach
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Province</h4>
                @foreach($locations as $location)
                @if($employee->location_id == $location->id)
                <h5>{{$location->name}}</h5>
                @endif
                @endforeach
            </div>
          </div>
          <div class="col-lg-1 col-lg-offset-2 col-md-1 col-md-offset-2 col-xs-12 pull-right">
            {{-- <a href="{{ route('logins.show',$employee->id)}}" class="btn btn-primary">View Login Details</a> --}}
          </div>
          <br>
        </div>
    </div>
@endsection
