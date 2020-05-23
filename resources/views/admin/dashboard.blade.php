@extends('layouts.admin-master')

@section('title')
	 Dashboard
@endsection

@section('page_title')
	Dashboard
@endsection

@section('content')
<div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-industry fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <div class="huge">{{$products_type}}</div>
                            <div>Types of Product</div>
                        </div>
                    </div>
                </div>
            <a href="{{route('products.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                            {{-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                             @endif --}}
                        <div class="col-xs-3">
                            <i class="fa fa-bitbucket fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <div class="huge">{{$products_in_stock}}</div>
                            <div>In Stock Products</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('stock.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <div class="huge">{{$users}}</div>
                            <div>All Users</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('users.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-group fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                        <div class="huge">{{$employees}}</div>
                            <div>All Employees</div>
                        </div>
                    </div>
                </div>
                <a href="{{route('employees.index')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">

            <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title" ><i class="fa fa-bar-chart-o fa-fw"></i> Stock, Handover and Returns Line Chart</h3>
                            <span class="pull-right clickable" ><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                    <div class="panel-body">
                                            <div id="temps_div"></div>
                                            {{-- // With Lava class alias --}}
                                            <?= \Lava::render('LineChart', 'Temps', 'temps_div') ?>

                                            {{-- // With Blade Templates --}}
                                            @linechart('Temps', 'temps_div')
                                    </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

    </div>
    {{-- end of row --}}

    <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Total Handoverable Products in Stock</h3>
                            <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                    <div class="panel-body">
                                            {{-- {!!$pie->html() !!} --}}
                                            <div id="chart-div"></div>
                                            {{-- // With Lava class alias --}}
                                            <?= \Lava::render('DonutChart', 'STOCK', 'chart-div') ?>

                                            {{-- // With Blade Templates --}}
                                            @donutchart('STOCK', 'chart-div')
                                    </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
    </div>
    <!-- /.row -->

    <div class="row"> 
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" ><i class="fa fa-bar-chart-o fa-fw"></i>Total Stocked Products Chart</h3>
                        <span class="pull-right clickable" ><i class="glyphicon glyphicon-chevron-up"></i></span>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                                <div class="panel-body">
                                        {{-- {!! $chart_stock->html() !!} --}}
                                        <div id="finances-div"></div>
                                        {{-- // With Lava class alias --}}
                                        <?= Lava::render('ComboChart', 'Finances', 'finances-div') ?>

                                        {{-- // With Blade Templates --}}
                                        @combochart('Finances', 'finances-div')
                                </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-6 -->
        </div>

        {{-- <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12 pull-left">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Employees Handovers Chart</h3>
                            <span class="pull-right clickable "><i class="glyphicon glyphicon-chevron-up"></i></span>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                    <div class="panel-body">
                                            {{-- {!! $chart_handover->html() !!} --}}
                                    {{-- </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 --> --}}
        
                {{-- <div class="col-lg-6 col-md-6 col-xs-12 pull-right">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i> Returned Handovers Chart</h3>
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="row">
                                        <div class="panel-body"> --}}
                                                {{-- {!! $chart_return->html() !!} --}}
                                        {{-- </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
        </div>  --}}

        <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-12  pull-left">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>New Products in Stock</h3>
                                    <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="row">
                                            <div class="panel-body">
                                                    {{-- {!!$newpie->html() !!} --}}
                                                    <div id="chart-div-new"></div>
                                            {{-- // With Lava class alias --}}
                                            <?= \Lava::render('DonutChart', 'NEW', 'chart-div-new') ?>

                                            {{-- // With Blade Templates --}}
                                            @donutchart('NEW', 'chart-div-new')
                                            </div>
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-6 -->

                        <div class="col-lg-6 col-md-6 col-xs-12  pull-right">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Used Products in Stock</h3>
                                        <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="row">
                                                <div class="panel-body">
                                                        {{-- {!!$usedpie->html() !!} --}}
                                                        <div id="chart-div-used"></div>
                                            {{-- // With Lava class alias --}}
                                            <?= \Lava::render('DonutChart', 'USED', 'chart-div-used') ?>

                                            {{-- // With Blade Templates --}}
                                            @donutchart('USED', 'chart-div-used')
                                                </div>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->

        <div class="row">
                <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-bar-chart-o fa-fw"></i>Damaged Products in Stock</h3>
                                <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="row">
                                        <div class="panel-body">
                                                {{-- {!!$dmgpie->html() !!} --}}
                                                <div id="chart-div-damaged"></div>
                                            {{-- // With Lava class alias --}}
                                            <?= \Lava::render('DonutChart', 'DAMAGED', 'chart-div-damaged') ?>

                                            {{-- // With Blade Templates --}}
                                            @donutchart('DAMAGED', 'chart-div-damaged')
                                        </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel --> 
            </div>
        </div>


        {{-- {!! Charts::assets() !!} --}}
    {{-- {!! Charts::scripts() !!} --}}
    {{-- {!! $chart_stock->script() !!} --}}
    {{-- {!! $chart_handover->script() !!}
    {!! $chart_return->script() !!} --}}
    {{-- {!! $pie->script() !!} --}}
    {{-- {!! $newpie->script() !!}
    {!! $usedpie->script() !!}
    {!! $dmgpie->script() !!} --}}

@endsection