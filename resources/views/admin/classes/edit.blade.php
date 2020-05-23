@extends('layouts.admin-master')

@section('title')
	 Class
@endsection

@section('page_title')
	Edit Class
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Class</h4>
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
            <form method="post" action="{{ route('class.update', $class->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="class">Class Name:</label>
                    <input type="text" class="form-control" name="class" value="{{$class->class}}" required/>
                </div>
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('class.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
