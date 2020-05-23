@extends('layouts.admin-master')

@section('title')
	 Employees
@endsection

@section('page_title')
	List of Employees
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('employees.create') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Employee Name</td>
            <td>Ref No</td>
            <td>Job</td>
            <td>Phone</td>
            <td>Department</td>
            <td>Province</td>
            <td></td>
            <td>Actions</td>
            <td></td>
          </tr>
      </thead>
      <tbody>
          @foreach($employees as $employee)
          <tr>
              <td>{{$employee->id}}</td>
              <td>{{$employee->full_name}}</td>
              <td>{{$employee->ref_no}}</td>
              <td>{{$employee->job_title}}</td>
              <td>{{$employee->phone}}</td>
              @foreach($departments as $department)
                @if($employee->department_id == $department->id)
                  <td>{{$department->department}}</td>
                @endif
              @endforeach

              @foreach($locations as $location)
                @if($employee->location_id == $location->id)
                  <td>{{$location->name}}</td>
                @endif
              @endforeach
              
              <td class="text text-right">
                <a href="{{ route('employees.show',$employee->id)}}" class="btn btn-info" >
                    <li class="fa fa-eye"></li></a>
                </td><td>
                <a href="{{ route('employees.edit',$employee->id)}}" class="btn btn-primary">
              <li class="fa fa-edit"></li></a>
              </td>
              <td class="text text-left">
                  <form action="{{ route('employees.destroy', $employee->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"><li class="fa fa-trash"></li></button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$employees->links()}}
    </div>
  <div>
@endsection