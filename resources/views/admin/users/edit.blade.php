@extends('layouts.admin-master')

@section('title')
	 Change Password
@endsection

@section('page_title')
	Change Password
@endsection

@section('content')
  
<div class="col-lg-6 pull-center">
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Change User Account Password</h4>
        </div>
        <div class="panel-body">
          <div class="col-lg-12">
            @include('includes.info-box')
          </div>
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Current password') }}</label>

                    <div class="col-md-6">
                        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="old_password">

                        @error('password')
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

                <div class="col-lg-6 col-lg-offset-4 col-md-6 col-xs-12">
                <span class="">
                <button type="submit" class="btn btn-success">Change</button>
                <a type="reset" class="btn btn-danger" href={{ route('users.show', $user->id) }}>Cancel</a>
                </span>
                </div>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection
