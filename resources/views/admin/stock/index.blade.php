@extends('layouts.admin-master')

@section('title')
	 Stock
@endsection

@section('page_title')
	List of Stock Items
@endsection
@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('/DataTables/datatables.min.js') }}"></script>
@endsection
@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('stock.create') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center" id="stockTable">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Serial No</td>
            <td>Product</td>
            <td>Tag No</td>
            <td>Class</td>
            <td>Status</td>
            {{--<td>Project</td>--}}
            <td>Department</td>
            <td>Unit</td>
            <td>Cost</td>
            <td>quantity</td>
            <td></td>
            <td>Actions</td>
            <td></td>
          </tr>
      </thead>
      <tbody>
          @foreach($stock as $item)
          <tr>
              <td>{{$item->id}}</td>

              <td>{{$item->serial_no}}</td>
              
              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->product}}</td>
              @endif
              @endforeach

              <td>{{$item->tag_no}}</td>

              @foreach($classes as $class)
              @if($item->class_id == $class->id)
              <td>{{$class->class}}</td>
              @endif
              @endforeach

              @foreach($status as $state)
              @if($item->status_id == $state->id)
              <td>{{$state->status}}</td>
              @endif
              @endforeach

              {{--@foreach($projects as $project)--}}
              {{--@if($item->project_id == $project->id)--}}
              {{--<td>{{$project->name}}</td>--}}
              {{--@endif--}}
              {{--@endforeach--}}

              @foreach($departments as $department)
              @if($item->department_id == $department->id)
              <td>{{$department->department}}</td>
              @endif
              @endforeach

              @foreach($units as $unit)
              @if($item->unit_id == $unit->id)
              <td>{{$unit->unit}}</td>
              @endif
              @endforeach
              
              <td>{{number_format($item->cost)}}</td>

              <td>{{$item->quantity}}</td>

              <td class="text text-right">
                <a href="{{ route('stock.show',$item->id)}}" class="btn btn-info">
                    <li class="fa fa-eye"></li></a>
                </td><td>
                <a href="{{ route('stock.edit',$item->id)}}" class="btn btn-primary">
              <li class="fa fa-edit"></li></a>
              </td>
              <td class="text text-left">
                  <form action="{{ route('stock.destroy', $item->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"><li class="fa fa-trash"></li></button>
                  </form>
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$stock->links()}}
      </div>
  <div>
      <script type="text/javascript">
          $(document).ready( function () {
              $('#stockTable').DataTable({
                  "aoColumnDefs": [
                      { 'bSortable': false, 'aTargets': [ 8,9,10 ] }
                  ]
              });
          });
      </script>
@endsection