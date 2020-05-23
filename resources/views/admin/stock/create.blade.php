@extends('layouts.admin-master')

@section('title')
	 Stock
@endsection

@section('page_title')
	Create Stock Item
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('stock.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
<div class="panel panel-primary uper p-relative">
  <div class="panel-heading">
    <h4>Add New Stock Item</h4>
  </div>
  <div class="panel-body">
    <form method="post" action="{{ route('stock.store') }}" id="form">
        @csrf
          <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="clo-lg-10 col-md-10 col-xs-10 pull-left">
              @include('includes.info-box') {{-- For Alerts  --}}

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
                      <label for="cost">Serial Number:</label>
                      <input type="text" class="form-control" name="serial_no" value="{{ old('serial_no') }}" required/>
                  </div>
              </div>

              <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="form-group">
                    <label for="cost">Tag No:</label>
                    <input type="text" class="form-control" name="tag_no" value="{{ old('tag_no') }}" required/>
                </div>
              </div>

              <div class="col-lg-5 col-md-5 col-xs-12">
                  <div class="form-group">
                      <label for="expected_life">Expected Life:</label>
                      <input type="text" class="form-control" name="expected_life" value="{{ old('expected_life') }}"/>
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
                      <label for="contract_date">Contract Date:</label>
                      <input type="date" id="cDate" class="form-control" name="contract_date" value="{{ old('contract_date') }}"/>
                  </div>
              </div>
              <div class="col-lg-5 col-md-5 col-xs-12">
                  <div class="form-group">
                      <label for="receive_date">Receive Date:</label>
                      <input type="date" id="rDate" class="form-control" name="receive_date" value="{{ old('receive_date') }}"/>
                  </div>
              </div>
              <div class="col-lg-10 col-md-10 col-xs-12">
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
                      <label for="m7">M7:</label>
                      <input type="text" class="form-control" name="m7" value="{{ old('m7') }}"/>
                  </div>
              </div>
              <div class="col-lg-5 col-md-5 col-xs-12">
                  <div class="form-group">
                      <label for="m16">M16:</label>
                      <input type="text" class="form-control" name="m16" value="{{ old('m16') }}"/>
                  </div>
              </div>
              <div class="col-lg-5 col-md-5 col-xs-12">
                  <div class="form-group">
                      <label for="unit_id">Unit:</label>
                      <select class="form-control" name="unit_id" >
                        <option selected disabled>Select the Unit</option>
                        @foreach($units as $unit)
                          <option value="{{$unit->id}}">{{$unit->unit}}</option>
                        @endforeach
                      </select>
                  </div>
              </div>

              <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="form-group">
                    <label for="cost">Cost:</label>
                    <input type="text" id="cost" class="form-control" name="cost" value="{{ old('cost') }}" required />
                </div>
              </div>

              <div class="col-lg-5 col-md-5 col-xs-12">
                  <div class="form-group">
                      <label for="quantity">Quantity:</label>
                      <input type="text" id="quantity" class="form-control" name="quantity" value="1" required/>
                    </div>
              </div>

              <div class="col-lg-5 col-md-5 col-xs-12 ">
                <div class="form-group bg-info">
                    <label for="total_cost">Total Cost:</label><br>
                    <span name="total_cost" class="form-control" id="totalcost"></span>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="form-group">
                    <label for="donar_id">Donar:</label>
                    <select class="form-control" name="donar_id" >
                      <option selected disabled>Select the Donar</option>
                      @foreach($donars as $donar)
                        <option value="{{$donar->id}}">{{$donar->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="form-group">
                    <label for="location_id">Location:</label>
                    <select class="form-control" name="location_id" >
                      <option selected disabled>Select the Location</option>
                      @foreach($locations as $location)
                        <option value="{{$location->id}}">{{$location->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="form-group">
                    <label for="project_id">Project:</label>
                    <select class="form-control" name="project_id" >
                      <option selected disabled>Select the Project</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}">{{$project->name}}</option>
                      @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-5 col-md-5 col-xs-12">
                <div class="form-group">
                    <label for="department_id">Department:</label>
                    <select class="form-control" name="department_id" >
                      <option selected disabled>Select the Department</option>
                      @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->department}}</option>
                      @endforeach
                    </select>
                </div>
            </div>

            <div class="col-lg-10 col-md-10 col-xs-12">
                <div class="form-group">
                    <label for="description">Asset Description:</label>
                    <textarea type="text" class="form-control" name="description" >{{ old('description') }}</textarea>
                </div>
            </div>

            </div>
            <div class="col-lg-1 col-lg-offset-1 col-md-1 col-md-offset-1 col-xs-12 pull-right">
                <a class="btn btn-primary top-right-align" href="{{ route('products.create') }}">
                  <li class="fa fa-plus"></li>&nbsp;Add New Product
                </a>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <button type="submit" class="btn btn-success">&nbsp;Save</button>
                <button type="reset" class="btn btn-danger">Reset</button>
                </div>
          </div>
        </form>
    </div>
  </div>

  
  <script src="{{ asset('/template/js/jquery.min.js') }}"></script>

  <script type="text/javascript">
$(document).ready(function(){

    var total = 0;
    $('#cost').keyup(function(){
      var cst = $(this).val();
      var qty = $('#quantity').val();
      total = cst * qty;
      $('#totalcost').html(total);
    });

    $('#quantity').keyup(function(){
      var qty = $(this).val();
      var cst = $('#cost').val();
      total = cst * qty;
      $('#totalcost').html(total);
    });

    // validation
    $("#cost").on("input", function(evt) {
      $('span.text-danger').hide();
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

    $("#quantity").on("input", function(evt) {
      $('span.text-danger').hide();
      $('span.text').hide();
      var inputVal = $(this).val();
      var numericReg = /[^0-9\.]/g;
      if(numericReg.test(inputVal)) {
          $(this).after('<span class="text text-danger">Numeric characters only.</span>');
          $("#totalcost").after('<span class="text"> Please Enter correct Data!</span>');
      }
    
      var self = $(this);
      self.val(self.val().replace(/[^0-9\.]/g, ''));
      if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
      {
        evt.preventDefault();
      }
    });

    $("#rDate").on("input", function(evt) {
      $('span.text-danger').hide();
      var cDate = $("#cDate").val();
      var rDate = $(this).val();
      if(rDate < cDate) {
          $("#rDate").after('<span class="text text-danger">Date is not correct!</span>');
          $("#rDate").focus();
          return false;
      }
    });

    $("#form").on("submit", function(){
      var cDate = $("#cDate").val();
      var rDate = $("#rDate").val();
      if(rDate < cDate) {
          $("#rDate").after('<span class="text text-danger">Date is not correct!</span>');
          $("#rDate").focus();
          return false;
      }
    });


});
</script>
@endsection