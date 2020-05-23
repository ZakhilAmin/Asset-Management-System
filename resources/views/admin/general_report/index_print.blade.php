<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>AMIS|Assets Report</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('/template/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('/template/css/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('/template/css/startmin.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('/template/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('/css/customcss.css') }}" rel="stylesheet" type="text/css">
        <style type="text/css">
          #h{
            /* display: none; */
          }
          #print{
            /* overflow: auto; */
            font-size: 9px;
          }
          table{
            width: 100%;
          }
        </style>
        <script type="text/javascript">
          function printContent() {
            document.getElementById('p').style="display: none;";
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
                    <h5 class="h1-margin" style="">Ministry of Labor and Social Affairs</h5>
                    <h5 class="h1-margin" style="">Project of PLACED</h5>
                    <h5 class="h1-margin" style="">Admin/ Finance Department </h5>
                    <h5 class="h1-margin" style="">Asset Management Information System</h5>  
                    <h4 style="margin-top:5px;">{{$report_title}}</h4>
                </div>
                  
                  <div class="col-lg-3 col-md-3 col-xs-3 text text-right" style="">
                      <img src="{{asset('/img/MinistryLogo.png')}}" width="100px" height="100px" class="img-responsive pull-right" style=""/>
                    </div>
                  </div>
                  <div class="row">
                     
                    <div class="col-lg-12 col-md-12 col-xs-12" style="">
                        <span class="pull-right"><a href="" id="p" onclick="printContent()" class="text text-danger pull-right">print</a></span>
                        <span class="pull-right"><a href="" id="d" class="text text-danger pull-right" style="display: none;">Date: {{now()}}</a></span>
                        <span>&nbsp;</span>
                        {{$meta}}
                        <table class="table table-striped text-center table-bordered table-responsive-lg text-small table-sm">
                            <thead class="bg-primary">
                                <tr>
                                    <td>S.No</td>
                                    <td>Serial Number</td>
                                    <td>Tag Ref No. Assigned</td>
                                    <td>Class of Asset</td>
                                    <td>Name of Asset</td>
                                    <td id="h">Description of Asset</td>
                                    <td id="h">Expected Life of the Asset</td>
                                    <td>Status</td>
                                    <td id="h">Date of Contract</td>
                                    <td id="h">Asset Receiving Date</td>
                                    <td>Cost Price</td>
                                    <td>Purchased document P.O/M16/ Voucher NO.</td>
                                    <td>GRN/ M7 Reference No.</td>
                                    <td>Project</td>
                                    <td>Donor / Funded by </td>
                                    <td>Location of Asset </td>
                                    <td>Department / Unit / Office</td>
                                    <td>Name of the Person to Whom Assigned</td>
                                    <td id="h">Remarks</td>
                                </tr>
                            </thead>
                            <tbody>
                                <span style="display:none;">{{$sno=0}}</span>
                                <span style="display:none;">{{$f=$flag}}</span>
                                <span style="display:none;">{{$total_handover=0}}</span>
                                <span style="display:none;">{{$total_stock=0}}</span>
                                <tr ><td colspan="19" class="bg-info text text-left">Handovered Assets</td></tr>
                              @if($f == 0)  
                                @foreach($handovered as $handover)
                                <span style="display:none;">{{$total_handover += $handover->cost}}</span>
                                  <tr>
                                      <td>{{++$sno}}</td>
                        
                                      <td>{{$handover->serial_no}}</td>
                        
                                      <td>{{$handover->tag_no}}</td>
                        
                                      @foreach($classes as $class)
                                      @if($handover->class_id == $class->id)
                                      <td>{{$class->class}}</td>
                                      @endif
                                      @endforeach
                                      
                                      @foreach($products as $product)
                                      @if($handover->product_id == $product->id)
                                      <td>{{$product->product}} |{{$product->manufacturer}} |{{$product->model}} |{{$product->brand}}</td>
                                      @endif
                                      @endforeach
                        
                                      <td id="h">{{$handover->description}}</td>
                        
                                      <td id="h">{{$handover->expected_life}}</td>
                        
                                      @foreach($status as $state)
                                      @if($handover->status_id == $state->id)
                                      <td>{{$state->status}}</td>
                                      @endif
                                      @endforeach
                        
                                      <td id="h">{{$handover->contract_date}}</td>
                        
                                      <td id="h">{{$handover->receive_date}}</td>
                        
                                      <td>{{number_format($handover->cost)}}</td>
                        
                                      <td>{{$handover->m16}}</td>
                        
                                      <td>{{$handover->m7}}</td>
                        
                                      @foreach($projects as $project)
                                      @if($handover->project_id == $project->id)
                                      <td>{{$project->name}}</td>
                                      @endif
                                      @endforeach
                                      
                                      @foreach($donars as $donar)
                                      @if($handover->donar_id == $donar->id)
                                      <td>{{$donar->name}}</td>
                                      @endif
                                      @endforeach
                        
                                      @foreach($locations as $location)
                                      @if($handover->location_id == $location->id)
                                      <td>{{$location->name}}</td>
                                      @endif
                                      @endforeach
                        
                                      @foreach($departments as $department)
                                      @if($handover->department_id == $department->id)
                                      <td>{{$department->department}}</td>
                                      @endif
                                      @endforeach
                        
                                      @foreach($emps as $emp)
                                      @if($handover->employee_id == $emp->id)
                                      <td>{{$emp->full_name}}</td>
                                      @endif
                                      @endforeach
                                      
                                      <td id="h">&nbsp;</td>
                                  </tr>
                                  @endforeach
                                  <tr>
                                    <td colspan="10">Grand Total of Cost Price</td>
                                    <td colspan="9" class="text text-left">{{number_format($total_handover)}}</td>
                                  </tr>
                              @else
                              <tr><td colspan="19">No Record Found!</td></tr>
                              @endif
                                  {{-- <tr ><td colspan="19" class="bg-info text text-left">Stocked Assets</td></tr>
                                  @foreach($stocked as $stock)
                                  <span style="display:none;">{{$total_stock += $stock->cost}}</span>
                                  <tr>
                                      <td>{{++$sno}}</td>
                        
                                      <td>{{$stock->serial_no}}</td>
                        
                                      <td>{{$stock->tag_no}}</td>
                        
                                      @foreach($classes as $class)
                                      @if($stock->class_id == $class->id)
                                      <td>{{$class->class}}</td>
                                      @endif
                                      @endforeach
                                      
                                      @foreach($products as $product)
                                      @if($stock->product_id == $product->id)
                                      <td>{{$product->product}} |{{$product->manufacturer}} |{{$product->model}} |{{$product->brand}}</td>
                                      @endif
                                      @endforeach
                        
                                      <td id="h">{{$stock->description}}</td>
                        
                                      <td id="h">{{$stock->expected_life}}</td>
                        
                                      @foreach($status as $state)
                                      @if($stock->status_id == $state->id)
                                      <td>{{$state->status}}</td>
                                      @endif
                                      @endforeach
                        
                                      <td id="h">{{$stock->contract_date}}</td>
                        
                                      <td id="h">{{$stock->receive_date}}</td>
                        
                                      <td>{{number_format($stock->cost)}}</td>
                        
                                      <td>{{$stock->m16}}</td>
                        
                                      <td>{{$stock->m7}}</td>
                        
                                      @foreach($projects as $project)
                                      @if($stock->project_id == $project->id)
                                      <td>{{$project->name}}</td>
                                      @endif
                                      @endforeach
                                      
                                      @foreach($donars as $donar)
                                      @if($stock->donar_id == $donar->id)
                                      <td>{{$donar->name}}</td>
                                      @endif
                                      @endforeach
                        
                                      @foreach($locations as $location)
                                      @if($stock->location_id == $location->id)
                                      <td>{{$location->name}}</td>
                                      @endif
                                      @endforeach
                        
                                      @foreach($departments as $department)
                                      @if($stock->department_id == $department->id)
                                      <td>{{$department->department}}</td>
                                      @endif
                                      @endforeach
                        
                                      <td>Stocked Asset</td>
                                      
                                      <td id="h">&nbsp;</td>
                                  </tr>
                                  @endforeach
                                  <tr>
                                      <td colspan="10">Grand Total of Cost Price</td>
                                      <td colspan="9" class="text text-left">{{number_format($total_stock)}}</td>
                                    </tr>

                                    <tr>
                                        <td colspan="10">Total Cost of Handovered and Stocked Assets</td>
                                        <td colspan="9" class="text text-left">{{number_format($total_stock + $total_handover)}}</td>
                                      </tr> --}}

                                  <tr ><td colspan="19" class="bg-info text text-left">Returned Assets</td></tr>
                                  @foreach($stocked as $stock)
                                  <tr>
                                      <td>{{++$sno}}</td>
                        
                                      <td>{{$stock->serial_no}}</td>
                        
                                      <td>{{$stock->tag_no}}</td>
                        
                                      @foreach($classes as $class)
                                      @if($stock->class_id == $class->id)
                                      <td>{{$class->class}}</td>
                                      @endif
                                      @endforeach
                                      
                                      @foreach($products as $product)
                                      @if($stock->product_id == $product->id)
                                      <td>{{$product->product}} |{{$product->manufacturer}} |{{$product->model}} |{{$product->brand}}</td>
                                      @endif
                                      @endforeach
                        
                                      <td id="h">{{$stock->description}}</td>
                        
                                      <td id="h">{{$stock->expected_life}}</td>
                        
                                      @foreach($status as $state)
                                      @if($stock->status_id == $state->id)
                                      <td>{{$state->status}}</td>
                                      @endif
                                      @endforeach
                        
                                      <td id="h">{{$stock->contract_date}}</td>
                        
                                      <td id="h">{{$stock->receive_date}}</td>
                        
                                      <td>0</td>
                        
                                      <td>{{$stock->m16}}</td>
                        
                                      <td>{{$stock->m7}}</td>
                        
                                      @foreach($projects as $project)
                                      @if($stock->project_id == $project->id)
                                      <td>{{$project->name}}</td>
                                      @endif
                                      @endforeach
                                      
                                      @foreach($donars as $donar)
                                      @if($stock->donar_id == $donar->id)
                                      <td>{{$donar->name}}</td>
                                      @endif
                                      @endforeach
                        
                                      @foreach($locations as $location)
                                      @if($stock->location_id == $location->id)
                                      <td>{{$location->name}}</td>
                                      @endif
                                      @endforeach
                        
                                      @foreach($departments as $department)
                                      @if($stock->department_id == $department->id)
                                      <td>{{$department->department}}</td>
                                      @endif
                                      @endforeach
                        
                                      <td>Returned Asset</td>
                                      
                                      <td id="h">&nbsp;</td>
                                  </tr>
                                  @endforeach

                                  <tr><td colspan="19" id="h">&nbsp;</td></tr>
                            <tr>
                              <td colspan="5">
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
                              <td colspan="5">
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
                              <td colspan="5">
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
                              <td colspan="4">
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
