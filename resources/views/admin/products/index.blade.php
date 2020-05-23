@extends('layouts.admin-master')

@section('title')
	 Product
@endsection

@section('page_title')
	List of Products
@endsection
@section('links')
    <link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.min.css') }}"/>
    <script type="text/javascript" src="{{ asset('/DataTables/datatables.min.js') }}"></script>
@endsection
@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('products.create') }}">
  <li class="fa fa-plus"></li>&nbsp;Add New
</a>
@endsection

@section('content')
  
  <div class="uper p-relative">
      @include('includes.info-box') {{-- For Alerts  --}}

    <table class="table table-striped text-center" id="productTable">
      <thead class="bg-primary">
          <tr>
            <td style="background-color: paleturquoise; color:blue">@sortablelink('id')</td>
            <td>Product Name</td>
            <td>Manufacturer</td>
            <td>Brand</td>
            <td>Model</td>
            <td>Category</td>
            <td colspan="2">Actions</td>
          </tr>
      </thead>
      <tbody>
          @foreach($products as $product)
          <tr>
              <td>{{$product->id}}</td>
              <td>{{$product->product}}</td>
              <td>{{$product->manufacturer}}</td>
              <td>{{$product->brand}}</td>
              <td>{{$product->model}}</td>
              @foreach($categories as $category)
                @if($product->category_id == $category->id)
                  <td>{{$category->category}}</td>
                @endif
              @endforeach
              <td class="text text-right"><a href="{{ route('products.edit',$product->id)}}" class="btn btn-primary">
              <li class="fa fa-edit"></li></a></td>
              <td class="text text-left">
                  <form action="{{ route('products.destroy', $product->id)}}" method="post">
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
        {{$products->links()}}
      </div>
  </div>

      {{--<script type="text/javascript">--}}
          {{--$(document).ready( function () {--}}
              {{--$('#productTable').DataTable({--}}
                  {{--"aoColumnDefs": [--}}
                      {{--{ 'bSortable': false, 'aTargets': [ 8,9,10 ] }--}}
                  {{--]--}}
              {{--});--}}
          {{--});--}}
      {{--</script>--}}

@endsection