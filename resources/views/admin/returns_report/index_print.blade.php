<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>AMIS|Returns Report</title>

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
                    <h5 class="h1-margin" style="">Ministry of Labor and Social Affairs</h5>
                    <h5 class="h1-margin" style="">Project of PLACED</h5>
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
                        <table class="table table-striped text-center table-bordered">
                            <thead class="bg-primary">
                                <tr>
                                    <td>S.No</td>
                                    <td>Product</td>
                                    <td>Tag No</td>
                                    <td>Return Date</td>
                                    <td>From Employee</td>
                                    <td>quantity</td>
                                    <td>Class</td>
                                    <td>Status</td>
                                    <td>Returned By</td>
                                </tr>
                            </thead>
                            <tbody>
                            <span style="display: none;">{{$sno=0}}</span>
                                @foreach($returns as $return)
                                <tr>
                                    <td>{{++$sno}}</td>
                                    
                                    @foreach($products as $product)
                                    @if($return->product_id == $product->id)
                                    <td>{{$product->product}}|{{$product->model}}</td>
                                    @endif
                                    @endforeach

                                    <td>{{$return->tag_no}}</td>

                                    <td>{{$return->return_date}}</td>

                                    @foreach($employees as $employee)
                                    @if($return->employee_id == $employee->id)
                                    <td>{{$employee->full_name}}</td>
                                    @endif
                                    @endforeach
                                    
                                    <td>{{$return->quantity}}</td>

                                    @foreach($classes as $class)
                                    @if($return->class_id == $class->id)
                                    <td>{{$class->class}}</td>
                                    @endif
                                    @endforeach

                                    @foreach($status as $state)
                                    @if($return->status_id == $state->id)
                                    <td>{{$state->status}}</td>
                                    @endif
                                    @endforeach

                                    @foreach($employees as $employee)
                                    @if($return->returned_emp == $employee->id)
                                    <td>{{$employee->full_name}}</td>
                                    @endif
                                    @endforeach
                                </tr>
                                @endforeach
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
