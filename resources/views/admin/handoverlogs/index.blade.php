@extends('layouts.admin-master')

@section('title')
	 Handover Logs
@endsection

@section('page_title')
	List of Handover Logs
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Employee</td>
            <td>Request Ref. No</td>
            <td>Handover Date</td>
            <td>Handovered By</td>
            <td>Operation</td>
            {{--  <td style="background-color: paleturquoise; color:blue">@sortablelink('created_at')</td>  --}}
            <td colspan="2">Actions</td>
          </tr>
      </thead>
      <tbody>
          @foreach($handovers as $handover)
          <tr>
              <td>{{$handover->id}}</td>
              
              @foreach($employees as $employee)
              @if($handover->employee_id == $employee->id)
              <td>{{$employee->full_name}} | <small>{{$employee->job_title}}</small></td>
              @endif
              @endforeach

              <td>{{$handover->request_ref}}</td>

              <td>{{$handover->handover_date}}</td>

              @foreach($employees as $employee)
              @if($handover->handovered_emp == $employee->id)
              <td>{{$employee->full_name}} | <small>{{$employee->job_title}}</small></td>
              @endif
              @endforeach

              <td>{{$handover->operation}}</td>

              {{--  <td>{{$handover->created_at}}</td>  --}}

              <td class="text text-right">
                <a href="{{ route('handoverlogs.show',$handover->id)}}" class="btn btn-info">
                    <li class="fa fa-eye"></li></a>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$handovers->links()}}
      </div>
  <div>
@endsection