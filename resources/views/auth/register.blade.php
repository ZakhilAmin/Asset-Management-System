{{-- @extends('layouts.app') --}}
@extends('layouts.admin-master')

@section('title')
	 Register
@endsection

@section('page_title')
	Register User Login Details
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('users.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="panel panel-primary">
                <div class="panel-heading">{{ __('Register') }}</div>

                <div class="panel-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="col-lg-12">
                        <div class="form-group row">
                            <label for="emp_id" class="col-md-4 col-form-label text-md-right">Employee ID</label>

                            <div class="col-md-6">
                                <input id="emp_id" type="text" class="form-control @error('emp_id') is-invalid @enderror" name="emp_id" value="{{ old('emp_id') }}" required autocomplete="emp_id" data-toggle="modal" data-target="#flipFlop">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="emp_type" class="col-md-4 col-form-label text-md-right">Employee Type:</label>
                                <div class="col-md-6">
                                <select class="form-control @error('emp_id') is-invalid @enderror" name="emp_type" value="{{ old('emp_type') }}">
                                  <option selected disabled>Select the Employee Type</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Supper User</option>
                                    <option value="3">Simple User</option>
                                </select>
                                @error('emp_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Register') }}
                                </button>
                                <button type="reset" class="btn btn-danger">
                                        {{ __('Reset') }}
                                    </button>
                            </div>
                    
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#flipFlop">
    Click Me
    </button> --}}
    
    <!-- The modal -->
    <div class="modal fade" id="flipFlop" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header bg-primary">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title" id="modalLabel">Information</h4>
    </div>
    <div class="modal-body">
    Please, Enter the valid Employee ID according to this system!
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
    </div>
    </div>
    </div>
@endsection
