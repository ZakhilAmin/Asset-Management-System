@extends('layouts.admin-master')

@section('title')
	 Donar
@endsection

@section('page_title')
	Edit Donar
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Donar</h4>
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
            <form method="post" action="{{ route('donar.update', $donar->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="name">Donar Name:</label>
                    <input type="text" class="form-control" name="name" value="{{$donar->name}}" required/>
                </div>
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('donar.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
