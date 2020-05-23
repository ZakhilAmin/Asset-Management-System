@extends('layouts.admin-master')

@section('title')
	 Status
@endsection

@section('page_title')
	Create Status
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('status.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')

  <div class="panel panel-primary uper p-relative">
    <div class="panel-heading">
      <h4>Add New Status</h4>
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
        <form method="post" action="{{ route('status.store') }}">
            <div class="form-group">
                @csrf
                <label for="status">Status Name:</label>
                <input type="text" class="form-control" name="status" value="{{ old('status') }}" required/>
            </div>
            <span>
            <button type="submit" class="btn btn-success">&nbsp;Save</button>
            <button type="reset" class="btn btn-danger">Reset</button>
            </span>
            <span>

            </span>
        </form>
    </div>
  </div>
@endsection