@extends('layouts.admin-master')

@section('title')
	 Department
@endsection

@section('page_title')
	Edit Department
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Department</h4>
        </div>
        <div class="panel-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
            </div><br />
          @endif
            <form method="post" action="{{ route('handover_details.update', $detail->id) }}">
                <div class="col-lg-10 col-md-10 col-xs-12">
                    <div class="form-group">
                      <label for="product_id">Product:</label>
                        <select class="form-control" name="product_id">
                          <option selected disabled>Select the product</option>
                          @foreach($products as $product)
                          @if($detail->product_id == $product->id)
                          <option value="{{$product->id}}" selected>{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                          @else
                          <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                          @endif
                          @endforeach
                        </select>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                          <label for="tag_no">Tag No:</label>
                          <input type="text" class="form-control" name="tag_no" value="{{$detail->tag_no}}" required/>
                      </div>
                  </div>

                  <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                          <label for="quantity">Quantity:</label>
                          <input type="text" class="form-control" name="quantity" value="{{$detail->quantity}}" required readonly/>
                      </div>
                  </div>
                <input type="hidden" value="{{$detail->handover_id}}">

                  <div class="col-lg-12 col-md-12 col-xs-12">
                      <div class="form-group">
                          <label for="remarks">Remarks:</label>
                          <input type="text" class="form-control" name="remarks" value="{{$detail->remarks}}" />
                      </div>
                  </div>

                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('handover.detail.view', $detail->handover_id) }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
