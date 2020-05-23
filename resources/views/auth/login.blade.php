<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Asset Management Information System</title>

        <!-- Bootstrap Core CSS -->
        <link href="{{ asset('/template/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="{{ asset('/template/css/metisMenu.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="{{ asset('/template/css/startmin.css') }}" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="{{ asset('/template/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('/css/customcss.css') }}" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body background="{{ asset('/img/background3.jpg') }}">

        <div class="container">
            <div class="col-lg-12 col-md-12 col-xs-12 background-style">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xs-3 " style="">
                        <img src="{{ asset('/img/logo.png') }}" class="img-responsive pull-left" style="padding-left:150px;"/>
                    </div>

                    <div class="col-lg-6 col-md-6 col-xs-6 text text-center title-style">
                        <h3 class="h1-margin" style="">Islamic Republic of Afghanistan</h3>
                        <h4 class="h1-margin" style="">Ministry of Labors and Social Affairs</h4>
                        <h4 class="h1-margin" style="">Placing Labor Abroad & Connecting to Employment Domestically</h4>
                        <h4 class="h1-margin" style="">Asset Management Information System</h4>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xs-3 " style="">
                            <img src="{{ asset('/img/MinistryLogo.png') }}" class="img-responsive pull-right" style="padding-right:150px;"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-xs-12" style="">
                        <div class="login-panel panel panel-primary" style="margin-bottom: 70px; margin-top: 50px;">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Please Sign In</h3>
                                </div>
                                <div class="panel-body">
                                <form role="form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <fieldset>
                                    <div class="form-group">
                                        <input id= "email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                         @error('email')
                                            <span class="invalid-feedback" role="alert">
                                            <strong class="text text-danger">{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" type="password" required autocomplete="current-password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                <strong class="text text-danger">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me" {{ old('remember') ? 'checked' : '' }}>Remember Me
                                        </label>
                                    </div>
                                                <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" href="index.html" class="btn btn-lg btn-primary btn-block">Login</button>
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </fieldset>
                                </form>
                            </div>
                        </div>
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
</html>
