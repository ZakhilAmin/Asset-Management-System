@extends('layouts.admin-master')

@section('title')
	 Stock
@endsection

@section('page_title')
	Stock Item Details
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('stock.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
        <h4>View <strong>ID#{{$stock->serial_no}}</strong> Details</h4>
        </div>
        <div class="panel-body">
          <div class="col-lg-12 col-md-12 col-xs-12 pull-left">
              <div class="col-lg-9 col-md-9 col-xs-12">
              <h3>Stock ID: {{$stock->id}}</h3>
              <h3>Serial No: {{$stock->serial_no}}</h3>
              <h3>Product: @foreach($products as $product)
                  @if($stock->product_id == $product->id)
                  {{$product->product}} | {{$product->manufacturer}} | {{$product->brand}} | {{$product->model}}
                  @endif
                  @endforeach
              </h3>
              <hr>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Tag No</h4>
                <h5>{{$stock->tag_no}}</h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Cost</h4>
                <h5>{{$stock->cost}}</h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Status</h4>
                <h5>@foreach($status as $state)
                    @if($stock->status_id == $state->id)
                    {{$state->status}}
                    @endif
                    @endforeach
                </h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Class</h4>
                <h5>@foreach($classes as $class)
                    @if($stock->class_id == $class->id)
                    {{$class->class}}
                    @endif
                    @endforeach
                  </h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">Contract Date</h4>
                <h5>{{$stock->contract_date}}</h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">Receive Date</h4>
                <h5>{{$stock->receive_date}}</h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">M7</h4>
                <h5>{{$stock->m7}}</h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">M16</h4>
                <h5>{{$stock->m16}}</h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">Unit</h4>
                <h5>@foreach($units as $unit)
                    @if($stock->unit_id == $unit->id)
                    {{$unit->unit}}
                    @endif
                    @endforeach
                  </h5>
            </div>
            
            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">Quantity</h4>
                <h5>{{$stock->quantity}}</h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                    <h4 class="bg-info">Project</h4>
                    <h5>@foreach($projects as $project)
                        @if($project->project_id == $project->id)
                        {{$project->name}}
                        @endif
                        @endforeach
                      </h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                    <h4 class="bg-info">Department</h4>
                    <h5>@foreach($departments as $department)
                        @if($stock->department_id == $department->id)
                        {{$department->department}}
                        @endif
                        @endforeach
                      </h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <h4 class="bg-info">Expected Life</h4>
                <h5>{{$stock->expected_life}}</h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                    <h4 class="bg-info">Donar/Funded By</h4>
                    <h5>@foreach($donars as $donar)
                        @if($stock->donar_id == $donar->id)
                        {{$donar->name}}
                        @endif
                        @endforeach
                      </h5>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                    <h4 class="bg-info">Location</h4>
                    <h5>@foreach($locations as $location)
                        @if($stock->location_id == $location->id)
                        {{$location->name}}
                        @endif
                        @endforeach
                      </h5>
            </div>

            <div class="col-lg-9 col-md-9 col-xs-12">
                <h4 class="bg-info">Asset Description</h4>
                <h5>{{$stock->description}}</h5>
            </div>

          </div>
          <div class="col-lg-1 col-lg-offset-2 col-md-1 col-md-offset-2 col-xs-12 pull-right">
            {{-- <a href="{{ route('logins.show',$employee->id)}}" class="btn btn-primary">View Login Details</a> --}}
          </div>
          <br>
        </div>
    </div>
@endsection
