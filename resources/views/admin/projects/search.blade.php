@extends('layouts.admin-master')

@section('title')
	 Project
@endsection

@section('page_title')
	Search Result for Project
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
        <td colspan="2" class="bg-primary">View Project {{$projects->project}} Related Search Result</td>
      </tr>
      <tr>
        <td colspan="2"><a href="{{route('projects.index_search', $projects->id)}}">View Recored</a></td>
        </tr>
      <tr>
        <td>General Report of Assets</td><td><a target="_blank" href="{{route('general.index.search.project', $projects->id)}}">View Report</a></td>
        </tr>
      <tr>
      <td>Handovered Assets</td><td><a target="_blank" href="{{route('employees.index.search.project', $projects->id)}}">View Report</a></td>
      </tr>
      <tr>
        <td>Stocked Assets</td><td><a target="_blank" href="{{route('stock.index.search.project', $projects->id)}}">View Report</a></td>
      </tr>
      <tr>
        <td>Returned Assets</td><td><a target="_blank" href="{{route('returns.index.search.project', $projects->id)}}">View Report</a></td>
      </tr>
    </table>
  <div>
@endsection