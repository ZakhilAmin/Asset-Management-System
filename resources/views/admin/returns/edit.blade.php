@extends('layouts.admin-master')

@section('title')
	 Returns
@endsection

@section('page_title')
	Edit Prodcut Returned
@endsection

@section('content')
  
      <div class="panel panel-primary uper">
        <div class="panel-heading">
          <h4>Edit Returned Product</h4>
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
            <form method="post" action="{{ route('returns.update', $return->id) }}">
                @csrf
                @method('PATCH')
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="clo-lg-10 col-md-10 col-xs-10 pull-left">
                        @include('includes.info-box') {{-- For Alerts  --}}

                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="employee_id">Employee:</label>
                                <select class="form-control" name="employee_id" disabled>
                                  <option selected disabled>Select the Employee</option>
                                  @foreach($employees as $employee)
                                  @if($return->employee_id == $employee->id)
                                <option value="{{$employee->id}}" selected>{{$employee->id}} | {{$employee->full_name}}</option>
                                @else
                                <option value="{{$employee->id}}">{{$employee->id}} | {{$employee->full_name}}</option>  
                                @endif
                                @endforeach
                                </select>
                            </div>
                        </div>

                      <div class="col-lg-10 col-md-10 col-xs-12">
                        <div class="form-group">
                          <label for="product_id">Product:</label>
                            <select class="form-control" name="product_id" disabled>
                             <option selected disabled>Select the product</option>
                              @foreach($products as $product)
                              @if($return->product_id == $product->id)
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
                                <label for="tag_no"> Tag No:</label>
                                <input type="text" class="form-control" name="tag_no" value="{{$return->tag_no}}" required readonly/>
                            </div>
                        </div>
                        
                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="return_date">Return Date:</label>
                                <input type="date" class="form-control" name="return_date" value="{{$return->return_date}}" required/>
                            </div>
                        </div>

                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="class_id">Class:</label>
                                <select class="form-control" name="class_id" disabled>
                                  <option selected disabled>Select the Class</option>
                                  @foreach($classes as $class)
                                  @if($return->class_id == $return->id)
                                    <option value="{{$class->id}}" selected>{{$class->unit}}</option>
                                  @else
                                  <option value="{{$class->id}}">{{$class->unit}}</option>
                                  @endif
                                  @endforeach
                                </select>
                            </div>
                        </div>
      
                        <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="status_id">Status:</label>
                                <select class="form-control" name="status_id" disabled>
                                  <option selected disabled>Select the Status</option>
                                  @foreach($status as $state)
                                  @if($return->status_id == $return->id)
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
                              <label for="quantity">Quantity:</label>
                              <input type="text" class="form-control" name="quantity" value="{{$return->quantity}}" readonly/>
                          </div>
                      </div>

                      <div class="col-lg-5 col-md-5 col-xs-12">
                            <div class="form-group">
                                <label for="returned_emp">Returned By:</label>
                                <select class="form-control" name="returned_emp" disabled>
                                  <option selected disabled>Select the Employee</option>
                                  @foreach($employees as $employee)
                                  @if($return->returned_emp == $employee->id)
                                <option value="{{$employee->id}}" selected>{{$employee->full_name}} | {{$employee->job_title}}</option>
                                @else
                                <option value="{{$employee->id}}">{{$employee->full_name}} | {{$employee->job_title}}</option>  
                                @endif
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                <div class="col-lg-12 col-md-12 col-xs-12">
                <span class="">
                <button type="submit" class="btn btn-success">Update</button>
                <a type="reset" class="btn btn-danger" href={{ route('returns.index') }}>Cancel</a>
                </span>
              </div>
            </form>
        </div>
      </div>
@endsection
