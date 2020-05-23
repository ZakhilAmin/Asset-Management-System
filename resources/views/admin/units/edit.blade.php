@extends('layouts.admin-master')

@section('title')
	 Units
@endsection

@section('page_title')
	Edit Unit
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Unit</h4>
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
            <form method="post" action="{{ route('units.update', $unit->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="unit">Unit Name:</label>
                    <input type="text" class="form-control" name="unit" value="{{$unit->unit}}" required/>
                </div>
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('units.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
