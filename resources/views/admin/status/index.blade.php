@extends('layouts.admin-master')

@section('title')
	 Status
@endsection

@section('page_title')
	List of Status
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('status.create') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Status Name</td>
            <td colspan="2">Actions</td>
          </tr>
      </thead>
      <tbody>
          @foreach($status as $state)
          <tr>
              <td>{{$state->id}}</td>
              <td>{{$state->status}}</td>
              <td class="text text-right"><a href="{{ route('status.edit',$state->id)}}" class="btn btn-primary">
              <li class="fa fa-edit"></li></a></td>
              <td class="text text-left">
                  <form action="{{ route('status.destroy', $state->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"><li class="fa fa-trash"></li></button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$status->links()}}
      </div>
  <div>
@endsection