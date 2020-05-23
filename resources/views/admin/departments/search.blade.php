@extends('layouts.admin-master')

@section('title')
	 Department
@endsection

@section('page_title')
	Search Result for Department
@endsection

{{-- @section('btn')
<a class="btn btn-primary top-right-align" href="{{ url()->previous() }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection --}}

@section('content')
   
  <div class="uper p-relative">
        {{-- @include('includes.info-box') For Alerts  --}}

    <table class="table table-striped text-center">
      <tr>
        <td colspan="2" class="bg-primary">View Department {{$departments->department}} Related Search Result</td>
      </tr>
      <tr>
        <td colspan="2"><a href="{{route('departments.index_search', $departments->id)}}">View Recored</a></td>
        </tr>
      <tr>
        <td>General Report of Assets</td><td><a target="_blank" href="{{route('general.index.search', $departments->id)}}">View Report</a></td>
        </tr>
      <tr>
      <td>Handovered Assets</td><td><a target="_blank" href="{{route('employees.index.print.search', $departments->id)}}">View Report</a></td>
      </tr>
      <tr>
        <td>Stocked Assets</td><td><a target="_blank" href="{{route('stock.index.search', $departments->id)}}">View Report</a></td>
      </tr>
      <tr>
        <td>Returned Assets</td><td><a target="_blank" href="{{route('returns.index.search', $departments->id)}}">View Report</a></td>
      </tr>
    </table>
  <div>
@endsection