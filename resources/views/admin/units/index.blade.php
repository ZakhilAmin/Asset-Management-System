@extends('layouts.admin-master')

@section('title')
	 Units
@endsection

@section('page_title')
	List of Units
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('units.create') }}">
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
            <td>Unit Name</td>
            <td colspan="2">Actions</td>
          </tr>
      </thead>
      <tbody>
          @foreach($units as $unit)
          <tr>
              <td>{{$unit->id}}</td>
              <td>{{$unit->unit}}</td>
              <td class="text text-right"><a href="{{ route('units.edit',$unit->id)}}" class="btn btn-primary">
              <li class="fa fa-edit"></li></a></td>
              <td class="text text-left">
                  <form action="{{ route('units.destroy', $unit->id)}}" method="post">
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
        {{$units->links()}}
      </div>
  <div>
@endsection