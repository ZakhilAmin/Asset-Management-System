@extends('layouts.admin-master')

@section('title')
	 Projects
@endsection

@section('page_title')
	Edit Project
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Project</h4>
        </div>
        <div class="panel-body">
            <form method="post" action="{{ route('projects.update', $project->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                      @csrf
                      <label for="name">Project Name:</label>
                      <input type="text" class="form-control" name="name" value="{{$project->name}}" required/>
                  </div>
      
                  <div class="form-group">
                    <label for="start_date">Project Start Date:</label>
                    <input type="date" class="form-control" name="start_date" value="{{$project->start_date}}"/>
                  </div>
      
                  <div class="form-group">
                    <label for="end_date">Project End Date:</label>
                    <input type="date" class="form-control" name="end_date" value="{{$project->end_date}}"/>
                  </div>
      
                  <div class="form-group">
                    <label for="status_id">Project Status:</label>
                    <select class="form-control" name="status_id" >
                      <option selected disabled>Select the Status</option>
                      @foreach($status as $state)
                        @if($project->status_id == $state->id)
                            <option value="{{$state->id}}" selected>{{$state->status}}</option>
                        @else
                            <option value="{{$state->id}}">{{$state->status}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('projects.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
