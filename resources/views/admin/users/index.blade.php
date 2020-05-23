@extends('layouts.admin-master')

@section('title')
	 User
@endsection

@section('page_title')
	List of User Accounts
@endsection

@section('btn')
@if(Auth::user()->emp_type == 1)
<a class="btn btn-primary top-right-align" href="{{ route('register') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endif
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Employee Type</td>
            <td>Email</td>
            <td colspan="2">Actions</td>
          </tr>
      </thead>
      <tbody>
          @foreach($users as $user)
          <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->emp_type==1 ? "Admin" : ($user->emp_type==2 ? "Super User" : "Simple User")}}</td>
              <td>{{$user->email}}</td>
              </td>
              <td class="text text-right">
                  <a href="{{ route('users.show', $user->id)}}" class="btn btn-info">
                      <li class="fa fa-eye"></li></a>
              </td>
@if(Auth::user()->emp_type == 1)
              <td class="text text-left">
                  <form action="{{ route('users.destroy', $user->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"><li class="fa fa-trash"></li></button>
                  </form>
              </td>
@endif
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$users->links()}}
      </div>
  <div>
@endsection