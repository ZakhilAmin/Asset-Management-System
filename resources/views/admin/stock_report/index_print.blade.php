<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>AMIS|Stock Report</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('/template/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('/template/css/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('/template/css/startmin.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('/template/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('/css/customcss.css') }}" rel="stylesheet" type="text/css">

        <script type="text/javascript">
          function printContent() {
            document.getElementById('p').style="display: none;"
            document.getElementById('d').style="display: inline;";
            print();
            window.close();
          }
        </script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body background="{{asset('/img/background3.jpg')}}">

        <div class="container">
          <div class="col-lg-12 col-md-12 col-xs-12 background-style" id="print">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-xs-3 text text-left" style="">
                  <img src="{{asset('/img/logo.png')}}" width="90px" height="90px"  class="img-responsive" style=""/>
                </div>
                
                <div class="col-lg-6 col-md-6 col-xs-6 text text-center title-style" style="">
                    <h5 class="h1-margin" style="color:blue;">Islamic Republic of Afghanistan</h5> 
                    <h5 class="h1-margin" style="color:blue;">Ministry of Labor and Social Affairs</h5>
                    <h5 class="h1-margin" style="color:blue;">Project of PLACED</h5>
                    <h5 class="h1-margin" style="color:blue;">Asset Management Information System</h5>  
                    <h4 style="margin-top:5px;" style="color:blue;">{{$report_title}}</h4>
                  </div>
                  
                  <div class="col-lg-3 col-md-3 col-xs-3 text text-right" style="">
                      <img src="{{asset('/img/MinistryLogo.png')}}" width="100px" height="100px" class="img-responsive pull-right" style=""/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12" style="">
                        <span class="pull-right">
                          {{-- <a href="{{route('employees.index.pdf', $empid)}}" id="pd" onclick="hide()" class="text text-danger">Pdf</a>&nbsp;&nbsp;&nbsp; --}}
                          <a href="" id="p" onclick="printContent()" class="text text-danger">Print</a>
                        </span>
                        <span class="pull-right"><a href="" id="d" class="text text-danger pull-right" style="display: none;">Date: {{now()}}</a></span>
                      <span>&nbsp;</span>

                        <table class="table table-striped text-center table-bordered table-responsive" style="border-bottom: 1px solid black; ">
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
                            <span style="display: none;">{{$grand_total=0}}</span>
                            <span style="display: none;">{{$sti=0}}</span>
                            <span style="display: none;">{{$st=""}}</span>

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
                                      <span style="display: none;">{{$total_cost=$qty*$i->cost}}</span>
                                      <span style="display: none;">{{$grand_total += $total_cost}}</span>
                                @endif
                              @endforeach
                                
                                <td>{{$item->quantity}}</td>
                  
                                <td>{{number_format($total_cost)}}</td>
                                <td>New Items</td>
                              </tr>
                              @endforeach
                            @if($total_cost != 0)
                            <tr >
                              <td class="bg-info" colspan="9">Grand Total of Cost Price</td>
                              <td class="bg-info " colspan="">{{number_format($grand_total) }}</>
                              <td></td>
                            </tr>
                            @else
                            <tr><td colspan="11">No Record Found!</td></tr>
                            @endif

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
                                      <span style="display: none;">{{$total_cost=$qty*$i->cost}}</span>
                                      <span style="display: none;">{{$grand_total += $total_cost}}</span>
                                @endif
                              @endforeach
                                
                                <td>{{$item->quantity}}</td>
                  
                                <td>{{number_format($total_cost)}}</td>
                                <td>Returned Items</td>
                              </tr>
                              @endforeach
                         {{-- ////////// --}}

                            <tr><td colspan="11">&nbsp;</td></tr>
                            <tr>
                              <td colspan="3">
                                <div class="form-group">
                                  <label for="preparedBy">Prepared By</label>
                                  <select class="form-control" id="emp1">
                                    <option class="text text-center">Select the Employee</option>
                                    @foreach($emps as $emp)
                                    <option value="{{$emp->id}}">{{$emp->full_name}}</option>
                                    @endforeach
                                  </select>
                                    <input type="text" id="emp11" class="form-control text-center" placeholder="Job title">
                                </div>
                              </td>
                              <td colspan="3">
                                  <div class="form-group">
                                      <label for="checkedBy">Checked By</label>
                                      <select class="form-control" id="emp2">
                                        <option class="text text-center">Select the Employee</option>
                                        @foreach($emps as $emp)
                                        <option value="{{$emp->id}}">{{$emp->full_name}}</option>
                                        @endforeach
                                      </select>
                                        <input type="text" id="emp22" class="form-control text-center" placeholder="Job title">
                                    </div>
                              </td>
                              <td colspan="2">
                                  <div class="form-group">
                                      <label for="endorsedBy">Endorsed By</label>
                                      <select class="form-control" id="emp3">
                                        <option class="text text-center">Select the Employee</option>
                                        @foreach($emps as $emp)
                                        <option value="{{$emp->id}}">{{$emp->full_name}}</option>
                                        @endforeach
                                      </select>
                                        <input type="text" id="emp33" class="form-control text-center" placeholder="Job title">
                                    </div>
                              </td>
                              <td colspan="3">
                                  <div class="form-group">
                                      <label for="approvedBy">Approved By</label>
                                      <select class="form-control" id="emp4">
                                        <option class="text text-center">Select the Employee</option>
                                        @foreach($emps as $emp)
                                        <option value="{{$emp->id}}">{{$emp->full_name}}</option>
                                        @endforeach
                                      </select>
                                        <input type="text" id="emp44" class="form-control text-center" placeholder="Job title">
                                    </div>
                              </td>
                            </tr>
                        </tbody>
                      </table>
             
                </div>
        </div>
    </div>

        <!-- jQuery -->
        <script src="{{ asset('/template/js/jquery.min.js') }}"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="{{ asset('/template/js/bootstrap.min.js') }}"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="{{ asset('/template/js/metisMenu.min.js') }}"></script>

        <!-- Custom Theme JavaScript -->
        <script src="{{ asset('/template/js/startmin.js') }}"></script>

    </body>
  {{-- <script src="{{ asset('template/js/jquery.min.js') }}"></script> --}}
  <script type="text/javascript">

$(document).ready(function(){

       $('#emp1').change(function(){ 
          var id = $(this).val();
      //    // AJAX request 
          $.ajax({
            url: 'employee/getemployee/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                   var job = response.job_title;
                 $("#emp11").val(job); 

              }
         });
        });

        $('#emp2').change(function(){ 
          var id = $(this).val();
      //    // AJAX request 
          $.ajax({
            url: 'employee/getemployee/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                   var job = response.job_title;
                 $("#emp22").val(job); 

              }
         });
        });

        $('#emp3').change(function(){ 
          var id = $(this).val();
      //    // AJAX request 
          $.ajax({
            url: 'employee/getemployee/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                   var job = response.job_title;
                 $("#emp33").val(job); 

              }
         });
        });

        $('#emp4').change(function(){ 
          var id = $(this).val();
      //    // AJAX request 
          $.ajax({
            url: 'employee/getemployee/'+id,
            type: 'get',
            dataType: 'json',
            success: function(response){
                   var job = response.job_title;
                 $("#emp44").val(job); 

              }
         });
        });
});
</script>
</html>
