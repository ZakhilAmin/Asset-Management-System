@extends('layouts.admin-master')

@section('title')
	 Stock Logs
@endsection

@section('page_title')
	List of Stock Logs
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Product</td>
            <td>Serial No</td>
            <td>Tag No</td>
            <td>Class</td>
            <td>Unit</td>
            <td>Cost</td>
            <td>quantity</td>
            <td>Status</td>
            <td>Operation</td>
            {{--  <td style="background-color: paleturquoise; color:blue">@sortablelink('created_at')</td>  --}}
            <td colspan="2">Actions</td>
          </tr>
      </thead>
      <tbody>
          @foreach($stock as $item)
          <tr>
              <td>{{$item->id}}</td>
              
              @foreach($products as $product)
              @if($item->product_id == $product->id)
              <td>{{$product->product}}</td>
              @endif
              @endforeach

              <td>{{$item->serial_no}}</td>

              <td>{{$item->tag_no}}</td>

              @foreach($classes as $class)
              @if($item->class_id == $class->id)
              <td>{{$class->class}}</td>
              @endif
              @endforeach

              @foreach($units as $unit)
              @if($item->unit_id == $unit->id)
              <td>{{$unit->unit}}</td>
              @endif
              @endforeach
              
              <td>{{$item->cost}}</td>

              <td>{{$item->quantity}}</td>

              @foreach($status as $state)
              @if($item->status_id == $state->id)
              <td>{{$state->status}}</td>
              @endif
              @endforeach

              <td>{{$item->operation}}</td>

              {{--  <td>{{$item->created_at}}</td>  --}}

              <td class="text text-right">
                <a href="{{ route('stocklogs.show',$item->id)}}" class="btn btn-info">
                    <li class="fa fa-eye"></li></a>
              </td>
    
          </tr>
          @endforeach
      </tbody>
    </table>
    <div class="col-gl-12 col-md-12 col-xs-12 text-center">
        {{$stock->links()}}
      </div>
  <div>
@endsection