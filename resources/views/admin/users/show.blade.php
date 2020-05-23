@extends('layouts.admin-master')

@section('title')
	 User
@endsection

@section('page_title')
	User Details
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('users.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
        <h4>View <strong>{{$employee->full_name}}</strong> Details</h4>
        </div>
        <div class="panel-body">
            <div class="col-lg-12">
                @include('includes.info-box')
              </div>
          <div class="col-lg-12 col-md-12 col-xs-12">
              <div class="col-lg-9 col-md-9 col-xs-12">
              <h3>Employee ID: {{$employee->id}}</h3>
              <h3>Employee Name: {{$employee->full_name}}</h3>
              <h3>User Type: {{$user->emp_type==1 ? "Admin" : ($user->emp_type==2 ? "Super User" : "Simple User")}} </h3>
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
            
          </div>
          <div class="col-lg-3 col-xs-12 pull-right">
            <div class="col-lg-3">
              <a href="{{ route('users.edit', $user->id)}}" class="btn btn-primary">Change Password</a>
            </div>
          </div>
        </div>
    </div>
@endsection
