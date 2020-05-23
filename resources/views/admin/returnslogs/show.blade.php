@extends('layouts.admin-master')

@section('title')
	 Return Log
@endsection

@section('page_title')
	Return Log Details
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('returnlogs.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
        <h4>View <strong>ID#{{$return->id}}</strong> Details</h4>
        </div>
        <div class="panel-body">
          <div class="col-lg-12 col-md-12 col-xs-12 pull-left">
              <div class="col-lg-9 col-md-9 col-xs-12">
              <h3>Return ID: {{$return->id}}</h3>
              <h3>Product: @foreach($products as $product)
                  @if($return->product_id == $product->id)
                  {{$product->product}} | {{$product->manufacturer}} | {{$product->brand}} | {{$product->model}}
                  @endif
                  @endforeach
                </h3> 
                <h3>Employee:
              @foreach($employees as $employee)
              @if($return->employee_id == $employee->id)
              {{$employee->id}}|{{$employee->full_name}} | 

              @foreach($status as $state)
              @if($employee->status_id == $state->id)
              {{$state->status}}
              @endif
              @endforeach

              @endif
              @endforeach
              </h3>
              <h3>Operation: {{$return->operation}}</h3>
              <h3>User ID: {{$userId}}</h3>
              <hr>
              
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Return Date</h4>
                <h5>{{$return->return_date}}</h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
              <h4 class="bg-info">Tag No</h4>
              <h5>{{$return->tag_no}}</h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
              <h4 class="bg-info">Class</h4>
              <h5>@foreach($classes as $class)
                  @if($return->class_id == $class->id)
                  {{$class->class}}
                  @endif
                  @endforeach
                </h5>
          </div>

          <div class="col-lg-5 col-md-5 col-xs-12">
            <h4 class="bg-info">Status</h4>
            <h5>@foreach($status as $state)
                @if($return->status_id == $state->id)
                {{$state->status}}
                @endif
                @endforeach
              </h5>
           </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">Quantity</h4>
                <h5>{{$return->quantity}}</h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">Returned By</h4>
                <h5>@foreach($employees as $employee)
                    @if($return->returned_emp == $employee->id)
                    {{$employee->full_name}} | {{$employee->job_title}}
                    @endif
                    @endforeach</h5>
            </div>

          </div>
          <div class="col-lg-1 col-lg-offset-2 col-md-1 col-md-offset-2 col-xs-12 pull-right">
            {{-- <a href="{{ route('returns.create',$handover->id)}}" class="btn btn-primary">Return Product</a> --}}
          </div>
          <br>
        </div>
    </div>
@endsection
