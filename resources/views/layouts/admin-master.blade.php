<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="KhayalBacha" content="">
    
    <title> AMIS | @yield('title')</title>
    
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('/template/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- MetisMenu CSS -->
    <link href="{{ asset('/template/css/metisMenu.min.css') }}" rel="stylesheet">
    
    <!-- Timeline CSS -->
    <link href="{{ asset('/template/css/timeline.css') }}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('/template/css/startmin.css') }}" rel="stylesheet">
    
    <!-- Morris Charts CSS -->
    <link href="{{ asset('/template/css/morris.css') }}" rel="stylesheet">
    
    <!-- Custom Fonts -->
    <link href="{{ asset('/template/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    
    <!-- Custome CSS CSS -->
    <link href="{{ asset('/css/customcss.css') }}" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="{{ asset('/template/js/jquery.min.js') }}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('/template/js/bootstrap.min.js') }}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{ asset('/template/js/metisMenu.min.js') }}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{ asset('/template/js/startmin.js') }}"></script>

    <!-- Custom JavaScript -->
    <script src="{{ asset('/js/customejs.js') }}"></script>

    <!-- DataTables -->
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/DataTables/datatables.min.css') }}"/>
  <script type="text/javascript" src="{{ asset('/DataTables/datatables.min.js') }}"></script> --}}
    @yield('links')

    <style type="text/css">
        .sidebar{
            overflow-y: scroll;
            position: fixed;
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #1d68a7; border-bottom-color: #1d68a7" role="navigation">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">AMIS</a>
        </div>

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Top Navigation: Left Menu -->
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home fa-fw"></i> Home </a></li>
        </ul>

        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">
            {{-- Notificatin Area --}}
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" 
            href="">
                    <i class="fa fa-user fa-fw"></i> 
                    @if(Auth::user())
                    {{ Auth::user()->email }}
                    @else
                    {{ redirect(url('login')) }}
                    @endif
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href=" @if(Auth::user()){{route('users.show', Auth::user()->id )}} @endif"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href=" @if(Auth::user()){{route('users.edit', Auth::user()->id )}} @endif"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ route('logout') }}" 
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse" >
                        {{-- // --}}
                        {{-- // --}}
                        <ul class="nav" id="side-menu" >
                            <li class="sidebar-search">
                                <form action="{{ route('search') }}" method="POST">
                                    @csrf
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" name="query" placeholder="Search..." required>
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                                <!-- /input-group -->
                            </li>
@if(Auth::user()->emp_type == 1)
                            <li>
                                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('projects.index') }}"><i class="fa fa-industry fa-fw"></i>Projects</a>
                            </li>
                            <li>
                                <a href="" onclick="event.preventDefault();" id="rm"><i class="fa fa-users fa-fw"></i>Employees<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="{{ route('employees.index') }}">Employee Details</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('users.index') }}">User Accounts</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            
                            <li>
                                <a href="{{ route('products.index') }}"><i class="fa fa-truck fa-fw"></i>Products</a>
                            </li>

                            <li>
                                <a href="{{ route('stock.index') }}"><i class="fa fa-shopping-basket fa-fw"></i>Stock</a>
                            </li>
@endif
@if(Auth::user()->emp_type == 1 || Auth::user()->emp_type == 2)
                            <li>
                                    <a href="" onclick="event.preventDefault();" id="rm1"><i class="fa fa-file-text-o fa-fw"></i>Handovers<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                        <a href="{{ route('handovers.index') }}">Handover to Employee</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('returns.index') }}">Return from Employee</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                            </li>
@endif
@if(Auth::user()->emp_type == 1)
                            <li>
                                    <a href="" onclick="event.preventDefault();" id="rm2"><i class="fa fa-files-o fa-fw"></i>Reports<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                            <a href="{{ route('general_report.index') }}">General Report</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('employee_report.index') }}">Employees Report</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('stock_report.index') }}">Stock Report</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('returns_report.index') }}">Returns Report</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                            </li>


                            <li>
                                <a href="" onclick="event.preventDefault();" id="rm3"><i class="fa fa-gears fa-fw"></i>Settings<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level" >
                                    <li>
                                        <a href="{{ route('donar.index') }}">Donars</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('location.index') }}">Locations</a>
                                    </li>
                                    <li>
                                    <a href="{{ route('department.index') }}">Departments</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('categories.index') }}">Categories</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('class.index') }}">Classes</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('status.index') }}">Status</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('units.index') }}"> Units</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>

                            <li>
                                    <a href="" onclick="event.preventDefault();" id="rm4"><i class="fa fa-thumb-tack fa-fw"></i>Logs<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                        <li>
                                        <a href="{{ route('stocklogs.index') }}">Stock Logs</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('handoverlogs.index') }}">Handover Logs</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('returnlogs.index') }}">Return Logs</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-second-level -->
                            </li>
@endif
                            <li>
                                <a href="{{ route('logout') }}" 
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-fw"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12 p-relative">
                    <span class="col-lg-12 col-md-12 col-xs-12">
                    <h2 class="page-header">@yield('page_title')</h2>
                    </span>
                    <span class="col-lg-12 col-md-12 col-xs-12 btn-section">
                        @yield('btn')
                    </span>
                </div>
            </div>

            <!-- ... Your content goes here ... -->
            @yield('content')

        </div>
    </div>

</div>

    <script>
        var topNavBar = 50;
        var footer = 10;
        var height = $(window).height();
        $('.sidebar').css('height', (height - (topNavBar+footer)));

        $(window).resize(function(){
            var height = $(window).height();
            $('.sidebar').css('height', (height - (topNavBar+footer)));
        });

        $(document).ready(function(){
            $("#rm").removeClass('active');
            $("#rm1").removeClass('active');
            $("#rm2").removeClass('active');
            $("#rm3").removeClass('active');
            $("#rm4").removeClass('active');
        });
    </script>

</body>
</html>
