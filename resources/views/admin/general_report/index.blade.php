@extends('layouts.admin-master')

@section('title')
	 General Report
@endsection
 
@section('page_title')
    General Report of Assets
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
      <form action="{{route('general.index.bydate')}}" method="GET">
          <span class="bg-info">By Date Report:</span> 
          From: <input type="date" class="input-sm" name="startDate" required>
          To: <input type="date" class="input-sm" name="endDate" required>&nbsp;&nbsp;
          <button type="submit" class="btn btn-sm btn-success">Search By Date & Print</button>
      </form>
      </div>
      <br><br>
<hr>
      <div class="clo-ld-12 text text-center pull-right">
      <span><a href="{{route('general.index.print')}}" target="_blank" class="btn btn-primary"><li class="fa fa-list-alt"></li> Print</a></span>
    </div>
  
    <br><br>
    <table id="general_table" class="table table-striped text-center table-bordered data-table table-responsive text text-small">
      <thead class="bg-primary">
          <tr>
              <td>S.No</td> 
              <td>Serial Number</td>
              <td>Tag Ref No. Assigned</td>
              <td>Class of Asset</td>
              <td>Name of Asset</td>
              {{-- <td>Description of Asset</td> --}}
              {{-- <td>Expected Life of the Asset</td> --}}
              <td>Status</td>
              {{-- <td>Date of Contract</td> --}}
              {{-- <td>Asset Receiving Date</td> --}}
              {{-- <td>Cost Price</td> --}}
              {{-- <td>Purchased document P.O/M16/ Voucher NO.</td> --}}
              {{-- <td>GRN/ M7 Reference No.</td> --}}
              <td>Project</td>
              <td>Donor / Funded by </td>
              <td>Location of Asset </td>
              <td>Department / Unit / Office</td>
              <td>Name of the Person to Whom Assigned</td> 
              {{-- <td>Remarks</td> --}}
          </tr>
      </thead>
      <tbody>
      <span style="display:none;">{{$sno=0}}</span>
        {{-- <tr ><td colspan="19" class="bg-info text text-left">Handovered Assets</td></tr> --}}
          @foreach($handovered as $handover)
          <tr>
              <td>{{++$sno}}</td>

              <td>{{$handover->serial_no}}</td>

              <td>{{$handover->tag_no}}</td>

              @foreach($classes as $class)
              @if($handover->class_id == $class->id)
              <td>{{$class->class}}</td>
              @endif
              @endforeach
              
              @foreach($products as $product)
              @if($handover->product_id == $product->id)
              <td>{{$product->product}} |{{$product->manufacturer}} |{{$product->model}} |{{$product->brand}}</td>
              @endif
              @endforeach

              @foreach($status as $state)
              @if($handover->status_id == $state->id)
              <td>{{$state->status}}</td>
              @endif
              @endforeach

              @foreach($projects as $project)
              @if($handover->project_id == $project->id)
              <td>{{$project->name}}</td>
              @endif
              @endforeach
              
              @foreach($donars as $donar)
              @if($handover->donar_id == $donar->id)
              <td>{{$donar->name}}</td>
              @endif
              @endforeach

              @foreach($locations as $location)
              @if($handover->location_id == $location->id)
              <td>{{$location->name}}</td>
              @endif
              @endforeach

              @foreach($departments as $department)
              @if($handover->department_id == $department->id)
              <td>{{$department->department}}</td>
              @endif
              @endforeach

              @foreach($employees as $employee)
              @if($handover->employee_id == $employee->id)
              <td>{{$employee->full_name}}</td>
              @endif
              @endforeach
          </tr>
          @endforeach

          {{-- <tr ><td colspan="19" class="bg-info text text-left">Stocked Assets</td></tr>
          @foreach($stocked as $stock)
          <tr>
              <td>{{++$sno}}</td>

              <td>{{$stock->serial_no}}</td>

              <td>{{$stock->tag_no}}</td>

              @foreach($classes as $class)
              @if($stock->class_id == $class->id)
              <td>{{$class->class}}</td>
              @endif
              @endforeach
              
              @foreach($products as $product)
              @if($stock->product_id == $product->id)
              <td>{{$product->product}} |{{$product->manufacturer}} |{{$product->model}} |{{$product->brand}}</td>
              @endif
              @endforeach

              @foreach($status as $state)
              @if($stock->status_id == $state->id)
              <td>{{$state->status}}</td>
              @endif
              @endforeach

              @foreach($projects as $project)
              @if($stock->project_id == $project->id)
              <td>{{$project->name}}</td>
              @endif
              @endforeach
              
              @foreach($donars as $donar)
              @if($stock->donar_id == $donar->id)
              <td>{{$donar->name}}</td>
              @endif
              @endforeach

              @foreach($locations as $locaiton)
              @if($stock->location_id == $location->id)
              <td>{{$location->name}}</td>
              @endif
              @endforeach

              @foreach($departments as $department)
              @if($stock->department_id == $department->id)
              <td>{{$department->department}}</td>
              @endif
              @endforeach

              <td>Stocked Asset</td>
          </tr>
          @endforeach --}}

          {{-- <tr ><td colspan="19" class="bg-info text text-left">Returned Assets</td></tr> --}}
          @foreach($stocked as $stock)
          <tr>
              <td>{{++$sno}}</td>

              <td>{{$stock->serial_no}}</td>

              <td>{{$stock->tag_no}}</td>

              @foreach($classes as $class)
              @if($stock->class_id == $class->id)
              <td>{{$class->class}}</td>
              @endif
              @endforeach
              
              @foreach($products as $product)
              @if($stock->product_id == $product->id)
              <td>{{$product->product}} |{{$product->manufacturer}} |{{$product->model}} |{{$product->brand}}</td>
              @endif
              @endforeach

              @foreach($status as $state)
              @if($stock->status_id == $state->id)
              <td>{{$state->status}}</td>
              @endif
              @endforeach

              @foreach($projects as $project)
              @if($stock->project_id == $project->id)
              <td>{{$project->name}}</td>
              @endif
              @endforeach
              
              @foreach($donars as $donar)
              @if($stock->donar_id == $donar->id)
              <td>{{$donar->name}}</td>
              @endif
              @endforeach

              @foreach($locations as $locaiton)
              @if($stock->location_id == $location->id)
              <td>{{$location->name}}</td>
              @endif
              @endforeach

              @foreach($departments as $department)
              @if($stock->department_id == $department->id)
              <td>{{$department->department}}</td>
              @endif
              @endforeach

              <td>Returned Asset</td>
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
          $('#general_table').DataTable({
                paging: true
          });
        });
      </script>
@endsection