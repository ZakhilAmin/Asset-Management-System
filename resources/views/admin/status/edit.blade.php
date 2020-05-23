@extends('layouts.admin-master')

@section('title')
	 Status
@endsection

@section('page_title')
	Edit Status
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Status</h4>
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
            <form method="post" action="{{ route('status.update', $status->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="status">Status Name:</label>
                    <input type="text" class="form-control" name="status" value="{{$status->status}}" required/>
                </div>
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('status.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
