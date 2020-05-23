@extends('layouts.admin-master')

@section('title')
	 Returns
@endsection

@section('page_title')
	Add Returned Products
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('returns.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
<div class="panel panel-primary uper p-relative">
  <div class="panel-heading">
    <h4>Add New Returned Product</h4>
  </div>
  <div class="panel-body">
    <form method="post" action="{{ route('returns.store') }}">
        @csrf
          <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="clo-lg-10 col-md-10 col-xs-10 pull-left">
                @include('includes.info-box') {{-- For Alerts  --}}

                <div class="col-lg-10 col-md-10 col-xs-12">
                    <div class="form-group">
                        <label for="employee_id">Employee:</label>
                        <select class="form-control" name="employee_id" >
                          <option selected disabled>Select the Employee</option>
                          @foreach($employees as $employee)
                        <option value="{{$employee->id}}">{{$employee->full_name}} | {{$employee->job_title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

              <div class="col-lg-10 col-md-10 col-xs-12">
                <div class="form-group">
                  <label for="product_id">Product:</label>
                    <select class="form-control" name="product_id" >
                     <option selected disabled>Select the product</option>
                      @foreach($products as $product)
                      <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                      @endforeach
                    </select>
                </div>
              </div>
                    
                    <div class="col-lg-5 col-md-5 col-xs-12">
                        <div class="form-group">
                            <label for="return_date">Return Date:</label>
                            <input type="date" class="form-control" name="return_date" value="{{ old('return_date') }}" required/>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-xs-12">
                        <div class="form-group">
                            <label for="tag_no"> Tag No:</label>
                            <input type="text" class="form-control" name="tag_no" value="{{ old('tag_no') }}" required/>
                        </div>
                    </div>

                  <div class="col-lg-5 col-md-5 col-xs-12">
                      <div class="form-group">
                          <label for="class_id">Class:</label>
                          <select class="form-control" name="class_id" >
                            <option selected disabled>Select the Class</option>
                            @foreach($classes as $class)
                              <option value="{{$class->id}}">{{$class->class}}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="col-lg-5 col-md-5 col-xs-12">
                      <div class="form-group">
                          <label for="status_id">Status:</label>
                          <select class="form-control" name="status_id" >
                            <option selected disabled>Select the Status</option>
                            @foreach($status as $state)
                              <option value="{{$state->id}}">{{$state->status}}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>

              <div class="col-lg-5 col-md-5 col-xs-12">
                  <div class="form-group">
                      <label for="quantity">Quantity:</label>
                      <input type="text" class="form-control" name="quantity" value="1" required id="qty" />
                  </div>
              </div>

              <div class="col-lg-5 col-md-5 col-xs-12">
                  <div class="form-group">
                      <label for="returned_id">Returned By:</label>
                      <select class="form-control" name="returned_emp" readonly>
                      <option selected disabled>Select the Returning By</option>
                        @foreach($employees as $employee)
                        @if($empid == $employee->id)
                          <option value="{{$empid}}" selected>{{$employee->full_name}} | {{$employee->job_title}}</option>
                        @endif  
                      @endforeach
                      </select>
                    </div>
                  </div>

            </div>
            <div class="col-lg-2 col-md-2 col-xs-12 pull-right">
              {{-- <div>  
              <a class="btn btn-primary" href="{{ route('products.create') }}">
                  <li class="fa fa-plus"></li>&nbsp;Add New Product &nbsp;&nbsp;
                </a>
              </div>
              <br>
              <div>
                <a class="btn btn-primary" href="{{ route('employees.create') }}">
                    <li class="fa fa-plus"></li>&nbsp;Add New Employee
                </a>
              </div> --}}
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <button type="submit" class="btn btn-success">&nbsp;Save</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                </div>
          </div>
        </form>
    </div>
  </div>
  <script src="{{ asset('template/js/jquery.min.js') }}"></script>
  <script type="text/javascript">

$(document).ready(function(){
  $("#qty").on("input", function(evt) {
      $('span.text-danger').hide();
      $('span.text').hide();
      var inputVal = $(this).val();
      var numericReg = /[^0-9\.]/g;
      if(numericReg.test(inputVal)) {
          $(this).after('<span class="text text-danger">Numeric characters only.</span>');
      }
    
      var self = $(this);
      self.val(self.val().replace(/[^0-9\.]/g, ''));
      if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
      {
        evt.preventDefault();
      }
    });
});
  </script>
@endsection