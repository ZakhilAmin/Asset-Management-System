@extends('layouts.admin-master')

@section('title')
	 Employees Report
@endsection

@section('page_title')
	Report of Employees
@endsection

@section('links')
	<link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.min.css') }}"/>
	<script type="text/javascript" src="{{ asset('/DataTables/datatables.min.js') }}"></script>
@endsection

{{--  @section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('employees.create') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endsection  --}}

@section('content')

  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}
    
      <div class="clo-ld-12 text text-center pull-right">
      <span></span>
      {{--  <span><a href="" class="btn btn-primary">View All</a></span>  --}}
      {{-- <span><a href="" class="btn btn-primary"><li class="fa fa-file-pdf-o"></li> PDF</a></span> --}}
      <span><a href="{{route('employees.index.print.all')}}" target="_blank" class="btn btn-primary"><li class="fa fa-list-alt"></li> Print</a></span>
      {{-- <span><a href="{{route('employees.index.print')}}" target="_blank" class="btn btn-primary"><li class="fa fa-list-alt"></li> Print</a></span> --}}
      {{--  <a href="{{ route('employees.index.print.pdf') }}">Export PDF</a>  --}}
    </div>
    <br><br>
    <table id="emp_table" class="table table-striped text-center table-bordered data-table">
      <thead class="bg-primary">
          <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Gender</td>
            <td>Job</td>
            <td>Department</td>
            <td>Project</td>
            <td>Phone</td>
            <td>Email</td>
            <td>Handover</td>
          </tr>
      </thead>
      <tbody>
          @foreach($employees as $employee)
          <tr>
              <td>{{$employee->id}}</td>
              <td>{{$employee->full_name}}</td>
              <td>{{ $employee->gender==0 ? "Male" : "Female"}}</td>
              <td>{{$employee->job_title}}</td>
              @foreach($departments as $department)
                @if($employee->department_id == $department->id)
                  <td>{{$department->department}}</td>
                @endif
              @endforeach
              
              @foreach($projects as $project)
              @if($employee->project_id == $project->id)
              <td>{{$project->name}}</td>
              @endif
              @endforeach

              <td>{{$employee->phone}}</td>

              <td>{{$employee->email}}</td>

              <td><a href="{{route('employees.index.print', $employee->id)}}" target="_blank">Handover</a>
                {{-- <a href="{{route('employees.index.pdf', $employee->id)}}" class="text text-danger">Pdf</a> --}}
              </td>

          </tr>
          @endforeach
      </tbody>
    </table>
    {{-- <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$employees->links()}}
    </div> --}}
  </div>
      <script type="text/javascript">
        $(document).ready( function () {
          $('#emp_table').DataTable({
                  paging: true
              });
        });
      </script>
@endsection