@extends('layouts.admin-master')

@section('title')
	 Returns
@endsection

@section('page_title')
	List of Products Returned by Employees
@endsection

@section('links')
	<link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.min.css') }}"/>
	<script type="text/javascript" src="{{ asset('/DataTables/datatables.min.js') }}"></script>
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('returns.create') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table id="returns_table" class="table table-striped text-center data-table">
      <thead class="bg-primary">
          <tr>
            <td>ID</td>
            <td>Product</td>
            <td>Return Date</td>
            <td>Tag No</td>
            <td>Employee</td>
            <td>quantity</td>
            <td>Status</td>
            <td>Returned By</td>
            <td></td>
            <td >Actions</td>
            <td></td>
          </tr>
      </thead>
      <tbody>
          @foreach($returns as $return)
          <tr>
              <td>{{$return->id}}</td>
              
              @foreach($products as $product)
              @if($return->product_id == $product->id)
              <td>{{$product->product}}</td>
              @endif
              @endforeach

              <td>{{$return->return_date}}</td>

              <td>{{$return->tag_no}}</td>

              @foreach($employees as $employee)
              @if($return->employee_id == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach
              
              <td>{{$return->quantity}}</td>

              @foreach($status as $state)
              @if($return->status_id == $state->id)
              <td>{{$state->status}}</td>
              @endif
              @endforeach

              @foreach($employees as $employee)
              @if($return->returned_emp == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach
              

              <td class="text text-right">
                <a href="{{ route('returns.show',$return->id)}}" class="btn btn-info" style="display:inline;">
                    <li class="fa fa-eye"></li></a>
                </td><td>
                <a href="{{ route('returns.edit',$return->id)}}" class="btn btn-primary" style="display:inline;">
              <li class="fa fa-edit"></li></a>
              </td>
              <td class="text text-left">
                  <form action="{{ route('returns.destroy', $return->id)}}" method="post" >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')" type="submit"><li class="fa fa-trash"></li></button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    {{-- <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$returns->links()}}
      </div> --}}
  <div>

      <script type="text/javascript">
        $(document).ready( function () {
          $('#returns_table').DataTable({
                  "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ 8,9,10 ] }
                  ]
              });
        });
      </script>
@endsection