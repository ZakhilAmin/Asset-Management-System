@extends('layouts.admin-master')

@section('title')
	 Handover Details
@endsection

@section('page_title')
	List of Handover Particulars
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('handovers.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
  
  <div class="uper p-relative">
        @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center">
      <thead class="bg-primary">
          <tr>
              <td>S.No</td>
            <td>Handover ID</td>
            <td>Product</td>
            <td>Tag No/Asset Code</td>
            <td>Quantity</td>
            <td>Remarks</td>
            {{-- <td colspan="1">Actions</td> --}}
          </tr>
      </thead>
      <tbody>
        <span style="display: none;">{{$sno = 0}}</span>
          @foreach($details as $detail)
          <tr>
              <td>{{++$sno}}</td>
              <td>{{$detail->handover_id}}</td>
                 
              @foreach($products as $product)
                  @if($detail->product_id == $product->id)
                  <td>{{$product->product}} | {{$product->manufacturer}} | {{$product->model}} | {{$product->brand}}</td>
                  @endif
                  @endforeach
              
              <td>{{$detail->tag_no}}</td>
              <td>{{$detail->quantity}}</td>
              <td>{{$detail->remarks}}</td>
              {{-- <td class="text text-right"><a href="{{ route('handover_details.edit',$detail->id)}}" class="btn btn-primary">
              <li class="fa fa-edit"></li></a></td> --}}
              {{-- <td class="text text-left">
                  <form action="{{ route('handover_details.destroy', $detail->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')" type="submit"><li class="fa fa-trash"></li></button>
                  </form>
              </td> --}}
          </tr>
          @endforeach
      </tbody>
    </table>
  <div>
@endsection