@extends('layouts.admin-master')

@section('title')
	 Project
@endsection

@section('page_title')
	List of Projects
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('projects.create') }}">
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
            <td>Project Name</td>
            <td>Start Date</td>
            <td>End Date</td>
            <td>Status</td>
            <td colspan="2">Actions</td>
          </tr>
      </thead>
      <tbody>
          @foreach($projects as $project)
          <tr>
              <td>{{$project->id}}</td>
              <td>{{$project->name}}</td>
              <td>{{$project->start_date}}</td>
              <td>{{$project->end_date}}</td>
              @foreach($status as $state)
                @if($project->status_id == $state->id)
                  <td>{{$state->status}}</td>
                @endif
              @endforeach
              <td class="text text-right"><a href="{{ route('projects.edit',$project->id)}}" class="btn btn-primary">
              <li class="fa fa-edit"></li></a></td>
              <td class="text text-left">
                  <form action="{{ route('projects.destroy', $project->id)}}" method="post">
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
    {{$projects->links()}}
    </div>
  <div>
@endsection