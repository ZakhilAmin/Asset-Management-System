@extends('layouts.admin-master')

@section('title')
	 Handover
@endsection

@section('page_title')
	Create Handover
@endsection

@section('btn')
<a class="btn btn-primary top-right-align" href="{{ route('handovers.index') }}">
  <li class="fa fa-arrow-left"></li>&nbsp;Back
</a>
@endsection

@section('content')
<div class="panel panel-primary uper p-relative">
  <div class="panel-heading">
    <h4>Add New Handover</h4>
  </div>
  <div class="panel-body">
    <form method="post" action="{{ route('handovers.store') }}" enctype="multipart/form-data" id="form">
        @csrf
          <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="clo-lg-12 col-md-12 col-xs-12">
                @include('includes.info-box') {{-- For Alerts  --}}

                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="request_ref">Request Ref. No:</label>
                        <input type="text" class="form-control" name="request_ref" value="{{ old('request_ref') }}" required/>
                    </div>
                </div> 

                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="form-group">
                        <label for="handover_date">Handover Date:</label>
                        <input type="date" class="form-control" name="handover_date" value="{{ old('handover_date') }}" required/>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-xs-12">
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

                  <div class="col-lg-6 col-md-6 col-xs-12">
                      <div class="form-group">
                          <label for="request_emp">Requesting Person:</label>
                          <select class="form-control" name="request_emp" >
                            <option selected disabled>Select the Reqsting Person</option>
                            @foreach($employees as $employee)
                          <option value="{{$employee->id}}">{{$employee->full_name}} | {{$employee->job_title}}</option>
                            @endforeach
                          </select>
                      </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-12">
                        <div class="form-group">
                            <label for="approved_emp">Approved By:</label>
                            <select class="form-control" name="approved_emp" >
                              <option selected disabled>Select the Approving Person</option>
                              @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->full_name}} | {{$employee->job_title}}</option>
                              @endforeach
                            </select>
                        </div>
                      </div>

                      <div class="col-lg-6 col-md-6 col-xs-12">
                          <div class="form-group">
                              <label for="handovered_emp">Handover By:</label>
                              <select class="form-control" name="handovered_emp" readonly>
                                <option selected disabled>Select the Handovere Person</option>
                                @foreach($employees as $employee)
                                @if($employee->id == $cur_user)
                              <option value="{{$employee->id}}" selected>{{$employee->full_name}} | {{$employee->job_title}}</option>
                                @endif
                              @endforeach
                              </select>
                          </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="form-group">
                                <label for="file_path">Requested Form:</label>
                                <input type="file" class="form-control-file" name="file_path" id="file_path" aria-describedby="fileHelp" required>
                                <small id="fileHelp" class="form-text text-muted">Please upload a valid file. Size of file should not be more than 2MB.</small>
                            </div>
                        </div>

            <div class="col-lg-12 col-md-12 col-xs-12 bg-info" id="particulars">
                 <h4>Add Particular(s)</h4> {{--<button type="button" class="btn btn-primary pull-right" id="add" >Add New Particular</button>--}}
                <br>
                <table class="table-responsive text text-center">
                  <thead class="bg-primary">
                    <tr>
                      <td>S.No</td>
                      <td>Product</td>
                      <td>Tag No</td>
                      <td>Qty</td>
                      <td>Remarks</td>
                    </tr>
                  </thead>
                  <tbody id="pb">
                    <tr id="pr" class="bg-warning">
                      <td>1<span>&nbsp;</span></td>
                      <td>
                              <div class="form-group">
                                  <select id="product_id0" class="form-control" name="particulars[0][product_id]" >
                                   <option value="0" selected>Select the product</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                    @endforeach
                                  </select>
                                  <span>&nbsp;</span>
                              </div>
                      </td>
                      <td>
                          <div class="form-group">
                                <select id="stock_id0" class="form-control" name="particulars[0][tag_no]">
                                 <option value="0" selected>Select the Asset Code</option>
                                 @foreach($product_stock as $p_s)  
                                <option value="{{$p_s->tag_no}}">
                                  {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                  @foreach ($status as $state)
                                      @if($p_s->status_id == $state->id)
                                        {{$state->status}}
                                      @endif
                                  @endforeach
                                </option>
                                  @endforeach
                                </select>
                                <span>&nbsp;</span>
                            </div>
                      </td>
                      <td>
                          <div class="form-group">
                              <input type="text" class="form-control qty" name="particulars[0][quantity]" value="1" required/>
                          </div>
                            <span class="text text-danger text-center" id="qu0">&nbsp;</span>
                      </td>
                      
                      <td>
                          <div class="form-group">
                              <input type="text" class="form-control" name="particulars[0][remarks]" value="{{ old('remarks') }}" />
                              <span>&nbsp;</span>
                            </div>
                      </td>
                    </tr>

                    <tr id="pr" class="bg-warning">
                        <td>2<span>&nbsp;</span></td>
                        <td>
                                <div class="form-group">
                                    <select id="product_id1" class="form-control" name="particulars[1][product_id]" >
                                     <option value="0" selected>Select the product</option>
                                      @foreach($products as $product)
                                      <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                      @endforeach
                                    </select>
                                    <span>&nbsp;</span>
                                </div>
                        </td>
                        <td>
                            <div class="form-group">
                                  <select id="stock_id1" class="form-control" name="particulars[1][tag_no]">
                                   <option selected value="0">Select the Asset Code</option>
                                   @foreach($product_stock as $p_s)  
                                <option value="{{$p_s->tag_no}}">
                                  {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                  @foreach ($status as $state)
                                      @if($p_s->status_id == $state->id)
                                        {{$state->status}}
                                      @endif
                                  @endforeach
                                </option>
                                  @endforeach
                                  </select>
                                  <span>&nbsp;</span>
                              </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control qty" name="particulars[1][quantity]" value="1" required/>
                            </div>
                            {{-- <div class="text text-danger text-center"> --}}
                              <span class="text text-danger text-center" id="qu1">&nbsp;</span>
                            {{-- </div> --}}
                        </td>
                        
                        <td>
                            <div class="form-group">
                                <input type="text" class="form-control" name="particulars[1][remarks]" value="{{ old('remarks') }}" />
                                <span>&nbsp;</span>
                              </div>
                        </td>
                      </tr>

                      <tr id="pr" class="bg-warning">
                          <td>3<span>&nbsp;</span></td>
                          <td>
                                  <div class="form-group">
                                      <select id="product_id2" class="form-control" name="particulars[2][product_id]" >
                                       <option value="0" selected>Select the product</option>
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                        @endforeach
                                      </select>
                                      <span>&nbsp;</span>
                                  </div>
                          </td>
                          <td>
                              <div class="form-group">
                                    <select id="stock_id2" class="form-control" name="particulars[2][tag_no]">
                                     <option selected value="0">Select the Asset Code</option>
                                     @foreach($product_stock as $p_s)  
                                <option value="{{$p_s->tag_no}}">
                                  {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                  @foreach ($status as $state)
                                      @if($p_s->status_id == $state->id)
                                        {{$state->status}}
                                      @endif
                                  @endforeach
                                </option>
                                  @endforeach
                                    </select>
                                    <span>&nbsp;</span>
                                </div>
                          </td>
                          <td>
                              <div class="form-group">
                                  <input type="text" class="form-control qty" name="particulars[2][quantity]" value="1" required/>
                              </div>
                                <span class="text text-danger text-center" id="qu2">&nbsp;</span>
                          </td>
                          
                          <td>
                              <div class="form-group">
                                  <input type="text" class="form-control" name="particulars[2][remarks]" value="{{ old('remarks') }}" />
                                  <span>&nbsp;</span>
                                </div>
                          </td>
                        </tr>


                      <tr id="pr" class="bg-warning">
                          <td>4<span>&nbsp;</span></td>
                          <td>
                                  <div class="form-group">
                                      <select id="product_id3" class="form-control" name="particulars[3][product_id]" >
                                       <option value="0" selected>Select the product</option>
                                        @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                        @endforeach
                                      </select>
                                      <span>&nbsp;</span>
                                  </div>
                          </td>
                          <td>
                              <div class="form-group">
                                    <select id="stock_id3" class="form-control" name="particulars[3][tag_no]">
                                     <option selected value="0">Select the Asset Code</option>
                                     @foreach($product_stock as $p_s)  
                                <option value="{{$p_s->tag_no}}">
                                  {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                  @foreach ($status as $state)
                                      @if($p_s->status_id == $state->id)
                                        {{$state->status}}
                                      @endif
                                  @endforeach
                                </option>
                                  @endforeach
                                    </select>
                                    <span>&nbsp;</span>
                                </div>
                          </td>
                          <td>
                              <div class="form-group">
                                  <input type="text" class="form-control qty" name="particulars[3][quantity]" value="1" required/>
                              </div>
                                <span class="text text-danger text-center" id="qu3">&nbsp;</span>
                          </td>
                          
                          <td>
                              <div class="form-group">
                                  <input type="text" class="form-control" name="particulars[3][remarks]" value="{{ old('remarks') }}" />
                                  <span>&nbsp;</span>
                                </div>
                          </td>
                        </tr>

                        <tr id="pr" class="bg-warning">
                            <td>5<span>&nbsp;</span></td>
                            <td>
                                    <div class="form-group">
                                        <select id="product_id4" class="form-control" name="particulars[4][product_id]" >
                                         <option selected value="0">Select the product</option>
                                          @foreach($products as $product)
                                          <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                          @endforeach
                                        </select>
                                        <span>&nbsp;</span>
                                    </div>
                            </td>
                            <td>
                                <div class="form-group">
                                      <select id="stock_id4" class="form-control" name="particulars[4][tag_no]">
                                       <option selected value="0">Select the Asset Code</option>
                                       @foreach($product_stock as $p_s)  
                                <option value="{{$p_s->tag_no}}">
                                  {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                  @foreach ($status as $state)
                                      @if($p_s->status_id == $state->id)
                                        {{$state->status}}
                                      @endif
                                  @endforeach
                                </option>
                                  @endforeach
                                      </select>
                                      <span>&nbsp;</span>
                                  </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control qty" name="particulars[4][quantity]" value="1" required/>
                                </div>
                                  <span class="text text-danger text-center" id="qu4">&nbsp;</span>
                            </td>
                            
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="particulars[4][remarks]" value="{{ old('remarks') }}" />
                                    <span>&nbsp;</span>
                                  </div>
                            </td>
                          </tr>

                          <tr id="pr" class="bg-warning">
                              <td>6<span>&nbsp;</span></td>
                              <td>
                                      <div class="form-group">
                                          <select id="product_id5" class="form-control" name="particulars[5][product_id]" >
                                           <option selected value="0">Select the product</option>
                                            @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                            @endforeach
                                          </select>
                                          <span>&nbsp;</span>
                                      </div>
                              </td>
                              <td>
                                  <div class="form-group">
                                        <select id="stock_id5" class="form-control" name="particulars[5][tag_no]">
                                         <option selected value="0">Select the Asset Code</option>
                                         @foreach($product_stock as $p_s)  
                                <option value="{{$p_s->tag_no}}">
                                  {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                  @foreach ($status as $state)
                                      @if($p_s->status_id == $state->id)
                                        {{$state->status}}
                                      @endif
                                  @endforeach
                                </option>
                                  @endforeach
                                        </select>
                                        <span>&nbsp;</span>
                                    </div>
                              </td>
                              <td>
                                  <div class="form-group">
                                      <input type="text" class="form-control qty" name="particulars[5][quantity]" value="1" required/>
                                  </div>
                                    <span class="text text-danger text-center" id="qu5">&nbsp;</span>
                              </td>
                              
                              <td>
                                  <div class="form-group">
                                      <input type="text" class="form-control" name="particulars[5][remarks]" value="{{ old('remarks') }}" />
                                      <span>&nbsp;</span>
                                    </div>
                              </td>
                            </tr>

                            <tr id="pr" class="bg-warning">
                                <td>7<span>&nbsp;</span></td>
                                <td>
                                        <div class="form-group">
                                            <select id="product_id6" class="form-control" name="particulars[6][product_id]" >
                                             <option value="0" selected>Select the product</option>
                                             @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                            @endforeach
                                            </select>
                                            <span>&nbsp;</span>
                                        </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                          <select id="stock_id6" class="form-control" name="particulars[6][tag_no]">
                                           <option selected value="0">Select the Asset Code</option>
                                           @foreach($product_stock as $p_s)  
                                            <option value="{{$p_s->tag_no}}">
                                              {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                              @foreach ($status as $state)
                                                  @if($p_s->status_id == $state->id)
                                                    {{$state->status}}
                                                  @endif
                                              @endforeach
                                            </option>
                                              @endforeach
                                          </select>
                                          <span>&nbsp;</span>
                                      </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control qty" name="particulars[6][quantity]" value="1" required/>
                                    </div>
                                      <span class="text text-danger text-center" id="qu6">&nbsp;</span>
                                </td>
                                
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="particulars[6][remarks]" value="{{ old('remarks') }}" />
                                        <span>&nbsp;</span>
                                      </div>
                                </td>
                              </tr>

                              <tr id="pr" class="bg-warning">
                                  <td>8<span>&nbsp;</span></td>
                                  <td>
                                          <div class="form-group">
                                              <select id="product_id7" class="form-control" name="particulars[7][product_id]" >
                                               <option value="0" selected>Select the product</option>
                                                @foreach($products as $product)
                                                <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                                @endforeach
                                              </select>
                                              <span>&nbsp;</span>
                                          </div>
                                  </td>
                                  <td>
                                      <div class="form-group">
                                            <select id="stock_id7" class="form-control" name="particulars[7][tag_no]">
                                             <option selected value="0">Select the Asset Code</option>
                                             @foreach($product_stock as $p_s)  
                                <option value="{{$p_s->tag_no}}">
                                  {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                  @foreach ($status as $state)
                                      @if($p_s->status_id == $state->id)
                                        {{$state->status}}
                                      @endif
                                  @endforeach
                                </option>
                                  @endforeach
                                            </select>
                                            <span>&nbsp;</span>
                                        </div>
                                  </td>
                                  <td>
                                      <div class="form-group">
                                          <input type="text" class="form-control qty" name="particulars[7][quantity]" value="1" required/>
                                      </div>
                                        <span class="text text-danger text-center" id="qu7">&nbsp;</span>
                                  </td>
                                  
                                  <td>
                                      <div class="form-group">
                                          <input type="text" class="form-control" name="particulars[7][remarks]" value="{{ old('remarks') }}" />
                                          <span>&nbsp;</span>
                                        </div>
                                  </td>
                                </tr>

                                <tr id="pr" class="bg-warning">
                                    <td>9<span>&nbsp;</span></td>
                                    <td>
                                            <div class="form-group">
                                                <select id="product_id8" class="form-control" name="particulars[8][product_id]" >
                                                 <option value="0" selected>Select the product</option>
                                                  @foreach($products as $product)
                                                  <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                                  @endforeach
                                                </select>
                                                <span>&nbsp;</span>
                                            </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                              <select id="stock_id8" class="form-control" name="particulars[8][tag_no]">
                                               <option selected value="0">Select the Asset Code</option>
                                               @foreach($product_stock as $p_s)  
                                              <option value="{{$p_s->tag_no}}">
                                                {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                                @foreach ($status as $state)
                                                    @if($p_s->status_id == $state->id)
                                                      {{$state->status}}
                                                    @endif
                                                @endforeach
                                              </option>
                                                @endforeach
                                              </select>
                                              <span>&nbsp;</span>
                                          </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control qty" name="particulars[8][quantity]" value="1" required/>
                                        </div>
                                          <span class="text text-danger text-center" id="qu8">&nbsp;</span>
                                    </td>
                                    
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="particulars[8][remarks]" value="{{ old('remarks') }}" />
                                            <span>&nbsp;</span>
                                          </div>
                                    </td>
                                  </tr>

                                  <tr id="pr" class="bg-warning">
                                      <td>10<span>&nbsp;</span></td>
                                      <td>
                                              <div class="form-group">
                                                  <select id="product_id9" class="form-control" name="particulars[9][product_id]" >
                                                   <option value="0" selected>Select the product</option>
                                                    @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->product}}|{{$product->manufacturer}}|{{$product->model}}|{{$product->brand}}</option>
                                                    @endforeach
                                                  </select>
                                                  <span>&nbsp;</span>
                                              </div>
                                      </td>
                                      <td>
                                          <div class="form-group">
                                                <select id="stock_id9" class="form-control" name="particulars[9][tag_no]">
                                                 <option selected value="0">Select the Asset Code</option>
                                                 @foreach($product_stock as $p_s)  
                                                  <option value="{{$p_s->tag_no}}">
                                                    {{$p_s->serial_no}} | {{$p_s->tag_no}} | 
                                                    @foreach ($status as $state)
                                                        @if($p_s->status_id == $state->id)
                                                          {{$state->status}}
                                                        @endif
                                                    @endforeach
                                                  </option>
                                                    @endforeach
                                                </select>
                                                <span>&nbsp;</span>
                                            </div>
                                      </td>
                                      <td>
                                          <div class="form-group">
                                              <input type="text" class="form-control qty" name="particulars[9][quantity]" value="1" required/>
                                          </div>
                                            <span class="text text-danger text-center" id="qu9">&nbsp;</span>
                                      </td>
                                      
                                      <td>
                                          <div class="form-group">
                                              <input type="text" class="form-control" name="particulars[9][remarks]" value="{{ old('remarks') }}" />
                                              <span>&nbsp;</span>
                                            </div>
                                      </td>
                                    </tr>

                  </tbody>
                </table>
                      </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12">
                      <br>
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

       $('#product_id0').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id0').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                 var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                
                 $("#stock_id0").append(option); 
               }
              }
             }
           });
         });

         $('#product_id1').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id1').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id1").append(option); 
               }
              }
             }
           });
         });


         $('#product_id2').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id2').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id2").append(option); 
               }
              }
             }
           });
         });


         $('#product_id3').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id3').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id3").append(option); 
               }
              }
             }
           });
         });

         $('#product_id4').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id4').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id4").append(option); 
               }
              }
             }
           });
         });

         $('#product_id5').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id5').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id5").append(option); 
               }
              }
             }
           });
         });

         $('#product_id6').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id6').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id6").append(option); 
               }
              }
             }
           });
         });

         $('#product_id7').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id7').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id7").append(option); 
               }
              }
             }
           });
         });

         $('#product_id8').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id8').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id8").append(option); 
               }
              }
             }
           });
         });

         $('#product_id9').change(function(){ 
        // product id
          var id = $(this).val();
      //    // Empty the dropdown
          $('#stock_id9').find('option').not(':first').remove();
      //    // AJAX request 
          $.ajax({
            url: 'create/getstock/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){

              var len = 0;
              if(response['data'] != null){
                len = response['data'].length;
               }

              if(len > 0){
                // Read data and create <option >
                 for(var i=0; i<len; i++){
                   var serial_no = response['data'][i].serial_no;
                   var tag_no = response['data'][i].tag_no;
                   var status = response['data'][i].status;
                   
                   var option = "<option value='"+tag_no+"'>"+serial_no+"|"+tag_no+" | "+status+"</option>"; 
                  
                 $("#stock_id9").append(option); 
               }
              }
             }
           });
         });

       // For quantity.....................................
         $('#stock_id0').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu0").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id1').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu1").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id2').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu2").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id3').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu3").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id4').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu4").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id5').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu5").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id6').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu6").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id7').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu7").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id8').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu8").html('Available: '+quantity);
              
              }
            });
          });

          $('#stock_id9').change(function(){
          // product id
           var id = $(this).val();

           $.ajax({
             url: 'create/getquantity/'+id,
             type: 'get',
             dataType: 'json',
             success: function(response){
 
                    var quantity = response.quantity;

                  $("#qu9").html('Available: '+quantity);
              
              }
            });
          });
          ///////////
          // Validation
          $(".qty").on("input", function(evt) {
            var inputVal = $(this).val();
            var numericReg = /[^0-9\.]/g;
            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
            {
              evt.preventDefault();
            }
          });

          var size = 0;
          $("#file_path").change(function(evt) {
            $('span.test').hide();
            size = this.files[0].size;
            if(size > 2097152) {
                $("#file_path").after('<span class="text text-danger test">Select a valid file! file size is not valid.</span><br>');
                $("#file_path").focus();
            }
          });

          $("#form").on("submit", function(evt){
            $('span.test').hide();
            if(size > 2097152) {
                $("#file_path").after('<span class="text text-danger test">Select a valid file! file size is not valid.</span><br>');
                $("#file_path").focus();
                return false;
            }
          });


});
      </script>
@endsection