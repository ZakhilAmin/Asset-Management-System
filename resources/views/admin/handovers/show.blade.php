@extends('layouts.admin-master')

@section('title')
	 Handovers
@endsection

@section('page_title')
	Handover Details
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('handovers.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
        <h4>View <strong>ID#{{$handover->id}}</strong> Details</h4>
        </div>
        <div class="panel-body">
          <div class="col-lg-12 col-md-12 col-xs-12 pull-left">
              <div class="col-lg-9 col-md-9 col-xs-12">
              <h3>Handover ID: {{$handover->id}}</h3>
              {{-- <h3>Product: @foreach($products as $product)
                  @if($handover->product_id == $product->id)
                  {{$product->product}} | {{$product->manufacturer}} | {{$product->brand}} | {{$product->model}}
                  @endif
                  @endforeach
                </h3>  --}}
              <h3>Employee:
              @foreach($employees as $employee)
                @if($handover->employee_id == $employee->id)
                  {{$employee->ref_no}} | {{$employee->full_name}} | <small>{{$employee->job_title}}</small>
                @endif
              @endforeach
              </h3>
              <hr>

              <div class="col-lg-4 col-md-4 col-xs-12">
                  <h4 class="bg-info">Request Ref. No</h4>
                  <h5>{{$handover->request_ref}}</h5>
              </div>
              
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Handover Date</h4>
                <h5>{{$handover->handover_date}}</h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Requesting Person</h4>
                <h5>@foreach($employees as $employee)
                    @if($handover->request_emp == $employee->id)
                        {{$employee->full_name}}
                        <small>{{$employee->job_title}}</small>
                    @endif
                  @endforeach</h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Approved By</h4>
                <h5>@foreach($employees as $employee)
                    @if($handover->approved_emp == $employee->id)
                        {{$employee->full_name}}
                        <small>{{$employee->job_title}}</small>
                    @endif
                  @endforeach</h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Handovered By</h4>
                <h5>@foreach($employees as $employee)
                    @if($handover->handovered_emp == $employee->id)
                        {{$employee->full_name}}
                        <small>{{$employee->job_title}}</small>
                    @endif
                  @endforeach</h5>
            </div>

            @if($handover->file_path != null)
            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Requested Form</h4>
            <h5><a target="_blank" href="{{route('file.view', $handover->file_path)}}">Requeste Form</a></h5>
            </div>
            @endif

            <div class="col-lg-9 col-md-9 col-xs-12">
                <h4 class="bg-info">Particulars</h4>
                <table class="table table-striped text-center">
                    <thead class="bg-info">
                        <tr>
                          <td>Product</td>
                          <td>Tag No</td>
                          <td>Quantity</td>
                          <td>Remarks</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($handovers_details as $particular)
                        <tr>
                            @foreach($products as $product)
                            @if($particular->product_id == $product->id)
                            <td>{{$product->product}} | {{$product->manufacturer}} | {{$product->brand}} | {{$product->model}}</td>
                            @endif
                            @endforeach
              
                            <td>{{$particular->tag_no}}</td>
              
                            <td>{{$particular->quantity}}</td>

                            <td>{{$particular->remarks}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
            
          </div>
          <div class="col-lg-1 col-lg-offset-2 col-md-1 col-md-offset-2 col-xs-12 pull-right">
            {{-- <a href="{{ route('returns.create',$handover->id)}}" class="btn btn-primary">Return Product</a> --}}
          </div>
          <br>
        </div>
    </div>
@endsection
