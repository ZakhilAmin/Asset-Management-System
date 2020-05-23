@extends('layouts.admin-master')

@section('title')
	 Authorization
@endsection

@section('page_title')
	Authorization
@endsection

@section('content')
{{-- <div class="title m-b-md alert alert-danger text text-center">
{{--  <h1>{{Auth::user()->emp_type==1 ? "ADMIN ONLY" : (Auth::user()->emp_type==2 ? "SUPER USER ONLY" : "SIMPLE USER ONLY")}}</h1>  --}}
	{{-- <h1>You're Restricted!</h1> --}}
{{-- </div> --}} 
@if(Auth::user()->emp_type==3)
<div class="title m-b-md alert alert-info text text-center">
	<h2>You can Access only the following:</h2>
	<h3><a href="{{route('handovers.index')}}">What is assigned to you!</a></h3>
	<h3><a href="{{route('users.index')}}">Can see your profile!</a></h3>
	<h3><a href="{{route('users.edit', Auth::user()->id)}}">Can Change Your Password!</a></h3>
</div>
@endif

@if(Auth::user()->emp_type==2)
<div class="title m-b-md alert alert-info text text-center">
		<h2>You can Access only the following:</h2>
		<h3><a href="{{route('handovers.index')}}">Assign an item to any Employee!</a></h3>
		<h3><a href="{{route('returns.index')}}">Return an item from any Employee!</a></h3>
		<h3><a href="{{route('users.index')}}">Can see your profile!</a></h3>
		<h3><a href="{{route('users.edit', Auth::user()->id)}}">Can Change Your Password!</a></h3>
</div>
@endif

@endsection