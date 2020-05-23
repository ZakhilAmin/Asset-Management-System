@extends('layouts.admin-master')

@section('title')
	 Handovers
@endsection

@section('page_title')
	List of Handovers
@endsection

@section('links')
	<link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.min.css') }}"/>
	<script type="text/javascript" src="{{ asset('/DataTables/datatables.min.js') }}"></script>
@endsection

@section('btn')
@if(Auth::user()->emp_type !=3)
<a class="btn btn-primary top-right-align" href="{{ route('handovers.create') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endif
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table id="handover_table" class="table table-striped text-center">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Employee</td>
            <td>Request Ref No</td>
            <td>Handover Date</td>
            <td>Requesting Person</td>
            <td>Approved By</td>
            <td>Handovered By</td>
            <td>Particulars</td>
@if(Auth::user()->emp_type !=3)
            <td></td>
            <td>Actions</td>
            <td></td>
@endif
          </tr>
      </thead>
      <tbody>
          @foreach($handovers as $handover)
          <tr>
              <td>{{$handover->id}}</td>
              
              @foreach($employees as $employee)
              @if($handover->employee_id == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach

              <td>{{$handover->request_ref}}</td>

              <td>{{$handover->handover_date}}</td>

              @foreach($employees as $employee)
              @if($handover->request_emp == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach

              @foreach($employees as $employee)
              @if($handover->approved_emp == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach

              @foreach($employees as $employee)
              @if($handover->handovered_emp == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach

              <td><a href="{{ route('handover.detail.view',$handover->id)}}">View Particulars</a></td>
@if(Auth::user()->emp_type != 3)
              <td class="text text-right">
                <a href="{{ route('handovers.show',$handover->id)}}" class="btn btn-info">
                    <li class="fa fa-eye"></li></a>
                </td>
              
              <td>
                <a href="{{ route('handovers.edit',$handover->id)}}" class="btn btn-primary">
              <li class="fa fa-edit"></li></a>
              </td>
              <td class="text text-left">
                  <form action="{{ route('handovers.destroy', $handover->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"><li class="fa fa-trash"></li></button>
                  </form>
              </td>
@endif
          </tr>
          @endforeach
      </tbody>
    </table>
    
    <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$handovers->links()}}
    </div>
  <div>

      <script type="text/javascript">
        $(document).ready( function () {
          $('#handover_table').DataTable({
                  "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ 8,9,10 ] }
                  ]
              });
        });
      </script>
@endsection