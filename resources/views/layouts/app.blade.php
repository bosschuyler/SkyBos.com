<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'SkyBos.com')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="/css/bootstrap-extension.min.css">
    <link rel="stylesheet" href="/css/utilities.css">

    @yield('links')

    <style>
        body {
            font-family: 'Lato';
        }
    </style>

    @yield('styling')

    @yield('headAdditions')
</head>
<body id="app-layout">
    <nav class="navbar @yield('navbar-theme', 'navbar-dark') @yield('navbar-style', 'navbar-static-top') ">
        <div class="container">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                @section('logo')
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        SkyBos Designs
                    </a>
                @show
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->

                @if (Auth::check())
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/home') }}">Home</a></li>
                    </ul>
                @endif

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Services <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href=""><i class="fa fa-btn fa-desktop"></i> UI Design</a></li>
                            <li><a href=""><i class="fa fa-btn fa-cogs"></i> API Integration</a></li>
                            <li><a href=""><i class="fa fa-btn fa-database"></i> Database Optimization</a></li>
                        </ul>
                    </li> -->   

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Samples <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/sample/code-monkeys">Sample Page</a></li>
                        </ul>
                    </li> 	

                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <!-- <li><a href="{{ url('/login') }}">Login</a></li> -->
                        <li><a id="registration-link" href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Tools <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/tools/stair-calculator') }}"><i class="fa fa-btn fa-calculator"></i>Stair Calculation</a></li>
                            </ul>
                        </li>   

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>

                        
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div id="loading-modal" class="modal fade oswald" data-backdrop="static" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body text-center">
					<h3 class="no-margin"><i class='fa fa-gear spin'></i> Loading...</h3>
				</div>			
			</div>
		</div>
	</div>

    <!-- Pop Up Modals -->
	<div id="registration-modal" class="modal fade lato" data-backdrop="static" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header dark-bg">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">User Registration</h4>
				</div>
				<div class="modal-body">
					<form id="registration-form">
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<input id="email" name="email" type="email" class="form-control" placeholder="Email">
								</div>
							</div>
						</div>
                        <div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<input id="name" name="name" class="form-control" placeholder="Name">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<input id="password" name="password" type="password" class="form-control" placeholder="Password">
								</div>
								<div class="col-sm-6">
									<li id='charMin'>Password must be 8 characters long</li>
									<li id='charNum'>Password must contain 1 number</li>
									<li id='charSpecial'>Password must contain 1 special character (!@#$%^&*)</li>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-sm-6">
									<input id="confirm-password" name="confirm-password" type="password" class="form-control" placeholder="Confirm Password">
								</div>
							</div>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary">Register</button>
						</div>
					</form>
				</div>			
			</div>
		</div>
	</div>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="/js/libraries/jquery.validator.custom-methods.js"></script>
    <script src="/js/registration.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('scripts')
</body>
</html>
