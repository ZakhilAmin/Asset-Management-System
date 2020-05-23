@extends('layouts.admin-master')

@section('title')
	 Handover Log
@endsection

@section('page_title')
	Handover Log Details
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('handoverlogs.index') }}">
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
              <h3>Handover ID: {{$handover->handover_id}}</h3>
              <h3>Employee:
              @foreach($employees as $employee)
              @if($handover->employee_id == $employee->id)
              {{$employee->full_name}} | {{$employee->job_title}}
              @endif
              @endforeach
              </h3>
              <h3>Operation: {{$handover->operation}}</h3>
              <h3>User ID: {{$userId}}</h3>
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
                    {{$employee->full_name}} | {{$employee->job_title}}
                    @endif
                    @endforeach</h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Approved By</h4>
                <h5>@foreach($employees as $employee)
                    @if($handover->approved_emp == $employee->id)
                    {{$employee->full_name}} | {{$employee->job_title}}
                    @endif
                    @endforeach</h5>
            </div>

            <div class="col-lg-4 col-md-4 col-xs-12">
                <h4 class="bg-info">Handovered By</h4>
                <h5>@foreach($employees as $employee)
                    @if($handover->handovered_emp == $employee->id)
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
