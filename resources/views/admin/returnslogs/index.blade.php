@extends('layouts.admin-master')

@section('title')
	 Return Logs
@endsection

@section('page_title')
	List of Return Logs
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Product</td>
            <td>Return Date</td>
            <td>Employee</td>
            <td>Class</td>
            <td>Status</td>
            <td>Quantity</td>
            <td>Returned By</td>
            <td>Operation</td>
            {{--  <td style="background-color: paleturquoise; color:blue">@sortablelink('created_at')</td>  --}}
            <td colspan="2">Actions</td>
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

              @foreach($employees as $employee)
              @if($return->employee_id == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach

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
              
              <td>{{$return->quantity}}</td>

              @foreach($employees as $employee)
              @if($return->returned_emp == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach

              <td>{{$return->operation}}</td>

              {{--  <td>{{$return->created_at}}</td>  --}}

              <td class="text text-right">
                <a href="{{ route('returnlogs.show',$return->id)}}" class="btn btn-info">
                    <li class="fa fa-eye"></li></a>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$returns->links()}}
      </div>
  <div>
@endsection