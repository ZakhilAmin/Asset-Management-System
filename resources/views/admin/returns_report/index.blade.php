@extends('layouts.admin-master')

@section('title')
	 Returns Report
@endsection

@section('page_title')
	Report of Returns
@endsection

@section('links')
	<link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.min.css') }}"/>
	<script type="text/javascript" src="{{ asset('/DataTables/datatables.min.js') }}"></script>
@endsection

{{--  @section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('employees.create') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endsection  --}}

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}
      <div class="col-lg-12">
      <form action="{{route('returns.index.bydate')}}" method="GET">
          <span class="bg-info">By Date Report:</span> 
          From: <input type="date" class="input-sm" name="startDate" required>
          To: <input type="date" class="input-sm" name="endDate" required>&nbsp;&nbsp;
          <button type="submit" class="btn btn-sm btn-success">Search By Date & Print</button>
      </form>
      </div>
      <br><br>
<hr>
      <div class="clo-ld-12 text text-center pull-right">
      <span><a href="{{route('returns.index.print')}}" target="_blank" class="btn btn-primary"><li class="fa fa-list-alt"></li> Print</a></span>
    </div>
  
    <br><br>
    <table id="returns_table" class="table table-striped text-center table-bordered data-table">
      <thead class="bg-primary">
          <tr>
              <td>ID</td>
              <td>Product</td>
              <td>Tag No</td>
              <td>Return Date</td>
              <td>From Employee</td>
              <td>quantity</td>
              <td>Class</td>
              <td>Status</td>
              <td>Returned By</td>
          </tr>
      </thead>
      <tbody>
          @foreach($returns as $return)
          <tr>
              <td>{{$return->id}}</td>
              
              @foreach($products as $product)
              @if($return->product_id == $product->id)
              <td>{{$product->product}}|{{$product->model}}</td>
              @endif
              @endforeach

              <td>{{$return->tag_no}}</td>

              <td>{{$return->return_date}}</td>

              @foreach($employees as $employee)
              @if($return->employee_id == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach
              
              <td>{{$return->quantity}}</td>

              @foreach($classes as $class)
              @if($return->class_id == $class->id)
              <td>{{$class->class}}</td>
              @endif
              @endforeach

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
                  paging: true
              });
        });
      </script>
@endsection