<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>AMIS|Employee Report</title>

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
            // document.getElementById('pd').style="display: none;"
            print();
            window.close();
          }
        //   function hide() {
        //     document.getElementById('pd').style="display: none;"
        //     document.getElementById('p').style="display: none;"
        //   }
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
                      <span>&nbsp;</span>
                        <table class="table table-striped text-center table-bordered table-responsive" style="border-bottom: 1px solid black; ">
                        <thead class="bg-primary">
                            <tr>
                              <td>S.No</td>
                              <td>Employee Ref. No</td>
                              <td>Employee Name</td>
                              <td>Job</td>
                              <td>Department</td>
                              <td>Project</td>
                              <td>Request Ref.</td>
                              <td>Handover Date</td>
                              <td>Handovered By</td>
                              <td>Product</td>
                              <td>Tag No</td>
                              <td>Cost Price</td>
                              <td>Qty</td>
                              <td>Total Cost</td>
                              <td>Remarks</td>
                            </tr>
                        </thead>
                        <tbody>
                          <span style="display: none;">{{$total_cost=0}}</span>
                          <span style="display: none;">{{$sno=0}}</span>
                          @if($employees != Null)
                            @foreach($employees as $employee)
                            <span style="display: none;">{{$total_cost += $employee->cost*$employee->qty}}</span>
                            <tr>
                                <td>{{++$sno}}</td>
                                <td>{{$employee->ref_no}}</td>
                                <td>{{$employee->full_name}}</td>
                                <td>{{$employee->job_title}}</td>
                                @foreach($departments as $department)
                                  @if($employee->department_id == $department->id)
                                    <td>{{$department->department}}</td>
                                  @endif
                                @endforeach
                                
                                @foreach($projects as $project)
                                @if($employee->project_id == $project->id)
                                <td>{{$project->name}}</td>
                                @endif
                                @endforeach
                  
                                <td>{{$employee->request_ref}}</td>
                  
                                <td>{{$employee->handover_date}}</td>

                                @foreach($emps as $emp)
                                  @if($employee->handovered_emp == $emp->id)
                                    <td>{{$emp->full_name}}</td>
                                  @endif
                                @endforeach

                                @foreach($products as $product)
                                  @if($employee->product_id == $product->id)
                                    <td>{{$product->product}}-{{$product->model}}</td>
                                  @endif
                                @endforeach

                                <td>{{$employee->tag_no}}</td>

                                <td>{{number_format($employee->cost)}}</td>

                                <td>{{$employee->qty}}</td>

                                <td class="bg-info">{{number_format($employee->cost * $employee->qty)}}</td>

                                <td>{{$employee->remarks}}</td>

                            </tr>                       
                            @endforeach
                            @endif
                            @if($total_cost != 0)
                            <tr >
                              <td class="bg-info" colspan="13">Grand Total of Cost Price</td>
                              <td class="bg-info text-left" colspan="2">{{number_format($total_cost) }}</>
                              
                            </tr>
                            @else
                            <tr><td colspan="15">No Record Found!</td></tr>
                            @endif
                        </tbody>
                      </table>
                    </span>
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
</html>
