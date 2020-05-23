@extends('layouts.admin-master')

@section('title')
	 Stock
@endsection

@section('page_title')
	Edit Stock Item
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Stock Item</h4>
        </div>
        <div class="panel-body">
            <form method="post" action="{{ route('stock.update', $stock->id) }}" id="form">
                @csrf
                @method('PATCH')
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="clo-lg-10 col-md-10 col-xs-10 pull-left">

                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="serial_no">Serial Number:</label>
                                <input type="text" class="form-control" name="serial_no" value="{{$stock->serial_no}}" required/>
                            </div>
                        </div>
          
                        <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="tag_no">Tag No:</label>
                              <input type="text" class="form-control" name="tag_no" value="{{$stock->tag_no}}" required/>
                          </div>
                        </div>

                      <div class="col-lg-10 col-md-10 col-xs-12">
                        <div class="form-group">
                          <label for="product_id">Product:</label>
                            <select class="form-control" name="product_id">
                              <option selected disabled>Select the product</option>
                              @foreach($products as $product)
                              @if($stock->product_id == $product->id)
                              <option value="{{$product->id}}" selected>{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                              @else
                              <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                              @endif
                              @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="expected_life">Expected Life:</label>
                              <input type="text" class="form-control" name="expected_life" value="{{$stock->expected_life}}"/>
                          </div>
                      </div>

                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="status_id">Status:</label>
                              <select class="form-control" name="status_id">
                                <option selected disabled>Select the Status</option>
                                @foreach($status as $state)
                                @if($stock->status_id == $state->id)
                                <option value="{{$state->id}}" selected>{{$state->status}}</option>
                                @else
                                <option value="{{$state->id}}">{{$state->status}}</option>
                                @endif
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="contract_date">Contract Date:</label>
                              <input type="date" id="cDate" class="form-control" name="contract_date" value="{{$stock->contract_date}}"/>
                          </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="receive_date">Receive Date:</label>
                              <input type="date" id="rDate" class="form-control" name="receive_date" value="{{$stock->receive_date}}"/>
                          </div>
                      </div>
                      <div class="col-lg-10 col-md-10 col-xs-12">
                          <div class="form-group">
                              <label for="class_id">Class:</label>
                              <select class="form-control" name="class_id">
                                <option selected disabled>Select the Class</option>
                                @foreach($classes as $class)
                                @if($stock->class_id == $class->id)
                                <option value="{{$class->id}}" selected>{{$class->class}}</option>
                                @else
                                <option value="{{$class->id}}">{{$class->class}}</option>
                                @endif
                                @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="m7">M7:</label>
                              <input type="text" class="form-control" name="m7" value="{{$stock->m7}}"/>
                          </div>
                      </div>
                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="m16">M16:</label>
                              <input type="text" class="form-control" name="m16" value="{{$stock->m16}}"/>
                          </div>
                      </div>

                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="unit_id">Unit:</label>
                              <select class="form-control" name="unit_id">
                                <option selected disabled>Select the Unit</option>
                                @foreach($units as $unit)
                                  @if($stock->unit_id == $unit->id)
                                  <option value="{{$unit->id}}" selected>{{$unit->unit}}</option>
                                  @else
                                  <option value="{{$unit->id}}">{{$unit->unit}}</option>
                                  @endif
                                @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="cost">Cost:</label>
                              <input type="text" id="cost" class="form-control" name="cost" value="{{$stock->cost}}" required/>
                          </div>
                      </div>

                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="quantity">Quantity:</label>
                              <input type="text" id="quantity" class="form-control" name="quantity" value="{{$stock->quantity}}"/>
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
                              <select class="form-control" name="donar_id">
                                <option selected disabled>Select the Donar</option>
                                @foreach($donars as $donar)
                                  @if($stock->donar_id == $donar->id)
                                  <option value="{{$donar->id}}" selected>{{$donar->name}}</option>
                                  @else
                                  <option value="{{$donar->id}}">{{$donar->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                          </div>
                      </div>
          
                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="location_id">Location:</label>
                              <select class="form-control" name="location_id">
                                <option selected disabled>Select the Location</option>
                                @foreach($locations as $location)
                                  @if($stock->location_id == $location->id)
                                  <option value="{{$location->id}}" selected>{{$location->name}}</option>
                                  @else
                                  <option value="{{$location->id}}">{{$location->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                          </div>
                      </div>

                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="project_id">Project:</label>
                              <select class="form-control" name="project_id">
                                <option selected disabled>Select the Project</option>
                                @foreach($projects as $project)
                                  @if($stock->project_id == $project->id)
                                  <option value="{{$project->id}}" selected>{{$project->name}}</option>
                                  @else
                                  <option value="{{$project->id}}">{{$project->name}}</option>
                                  @endif
                                @endforeach
                              </select>
                          </div>
                      </div>
          
                      <div class="col-lg-5 col-md-5 col-xs-12">
                          <div class="form-group">
                              <label for="department_id">Department:</label>
                              <select class="form-control" name="department_id">
                                <option selected disabled>Select the Department</option>
                                @foreach($departments as $department)
                                  @if($stock->department_id == $department->id)
                                  <option value="{{$department->id}}" selected>{{$department->department}}</option>
                                  @else
                                  <option value="{{$department->id}}">{{$department->department}}</option>
                                  @endif
                                @endforeach
                              </select>
                          </div>
                      </div>
          
                      <div class="col-lg-10 col-md-10 col-xs-12">
                          <div class="form-group">
                              <label for="description">Asset Description:</label>
                              <textarea type="text" class="form-control" name="description" >{{$stock->description}}</textarea>
                          </div>
                      </div>

                    </div>
                <div class="col-lg-12 col-md-12 col-xs-12">
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('stock.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>

      <script src="{{ asset('template/js/jquery.min.js') }}"></script>
  <script type="text/javascript">
$(document).ready(function(){
    $('#totalcost').html($('#cost').val() * $('#quantity').val());
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
