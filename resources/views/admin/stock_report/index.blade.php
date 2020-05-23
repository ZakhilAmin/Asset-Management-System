@extends('layouts.admin-master')

@section('title')
	 Stock Report
@endsection

@section('page_title')
	Report of Stock items
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
    
      <div class="clo-ld-12 text text-center pull-right">
      <span></span>
      {{--  <span><a href="" class="btn btn-primary">View All</a></span>  --}}
      <span><a href="{{route('stock.index.print')}}" target="_blank" class="btn btn-primary"><li class="fa fa-list-alt"></li> Print</a></span>
      {{--  <a href="{{ route('employees.index.print.pdf') }}">Export PDF</a>  --}}
    </div>
    <br><br>
    <table id="stock_table" class="table table-striped text-center table-bordered data-table">
      <thead class="bg-primary">
          <tr>
            <td>S.No</td>
            <td>Product Name</td>
            <td>Product Manufacturer</td>
            <td>Product Model</td>
            <td>Product Brand</td>
            <td>Class</td>
            {{-- <td>Status</td> --}}
            <td>Unit Cost</td>
            <td>Unit</td>
            <td>quantity</td>
            <td>Total Cost</td>
            <td>Remarks</td>
          </tr>
      </thead>
      <tbody>
          <span style="display: none;">{{$sno=0}}</span>
          <span style="display: none;">{{$total_cost=0}}</span>
          <span style="display: none;">{{$unit_cost=0}}</span>
          <span style="display: none;">{{$qty=0}}</span>
          @foreach($stock as $item)
          <tr>
              <span style="display: none;">{{$qty=$item->quantity}}</span>
              <td>{{++$sno}}</td>
              
              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->product}}</td>
              @endif
              @endforeach

              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->manufacturer}}</td>
              @endif
              @endforeach

              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->model}}</td>
              @endif
              @endforeach

              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->brand}}</td>
              @endif
              @endforeach

              @foreach ($itemss as $i)
              @if($item->product_id == $i->product_id)
                  @foreach($classes as $class)
                  @if($i->class_id == $class->id)
                  <td>{{$class->class}}</td>
                  @endif
                  @endforeach

                    {{-- @foreach($status as $state)
                    @if($i->status_id == $state->id)
                    <td>{{$state->status}}</td>
                    @endif
                    @endforeach --}}
                    
                    <td>{{number_format($i->cost)}}</td>

                    @foreach($units as $unit)
                    @if($i->unit_id == $unit->id)
                    <td>{{$unit->unit}}</td>
                    @endif
                    @endforeach
                    <span style="display: none;">
                      {{$total_cost=$qty*$i->cost}}
                    </span>
              @endif
              @endforeach
              
              <td>{{$item->quantity}}</td>

              <td>{{number_format($total_cost)}}</td>
              <td>New Items</td>
            </tr>
            @endforeach

            {{-- Returned Items --}}
            @foreach($rstock as $item)
          <tr>
              <span style="display: none;">{{$qty=$item->quantity}}</span>
              <td>{{++$sno}}</td>
              
              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->product}}</td>
              @endif
              @endforeach

              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->manufacturer}}</td>
              @endif
              @endforeach

              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->model}}</td>
              @endif
              @endforeach

              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->brand}}</td>
              @endif
              @endforeach

              @foreach ($ritemss as $i)
              @if($item->product_id == $i->product_id)
                  @foreach($classes as $class)
                  @if($i->class_id == $class->id)
                  <td>{{$class->class}}</td>
                  @endif
                  @endforeach

                    {{-- @foreach($status as $state)
                    @if($i->status_id == $state->id)
                    <td>{{$state->status}}</td>
                    @endif
                    @endforeach --}}
                    
                    <td>{{number_format($i->cost)}}</td>

                    @foreach($units as $unit)
                    @if($i->unit_id == $unit->id)
                    <td>{{$unit->unit}}</td>
                    @endif
                    @endforeach
                    <span style="display: none;">
                      {{$total_cost=$qty*$i->cost}}
                    </span>
              @endif
              @endforeach
              
              <td>{{$item->quantity}}</td>

              <td>{{number_format($total_cost)}}</td>
              <td>Returned Items</td>
            </tr>
            @endforeach
            {{-- ///////// --}}
      </tbody>
    </table>

  <div>

      <script type="text/javascript">
        $(document).ready( function () {
          $('#stock_table').DataTable({
                  paging: true
              });
        });
      </script>

@endsection