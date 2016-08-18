<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Laravel</title>

	<!-- Fonts -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
	<link href='https://fonts.googleapis.com/css?family=Oswald:400,300' rel='stylesheet' type='text/css'>

	<!-- Styles -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="http://skybos.com/css/bootstrap-extension.min.css">

	<style>
		.checkmark-circle {
		  width: 25px;
		  height: 25px;
		  position: relative;
		  display: inline-block;
		  vertical-align: top;
		}
		.checkmark-circle .background {
		  width: 25px;
		  height: 25px;
		  border-radius: 50%;
		  position: absolute;
		}
		.checkmark-circle .checkmark {
		  border-radius: 5px;
		}

		.checkmark-circle .checkmark.draw:after {
		  -webkit-animation-delay: 200ms;
		  -moz-animation-delay: 200ms;
		  animation-delay: 200ms;
		  -webkit-animation-duration: 2s;
		  -moz-animation-duration: 2s;
		  animation-duration: 2s;
		  -webkit-animation-timing-function: ease;
		  -moz-animation-timing-function: ease;
		  animation-timing-function: ease;
		  -webkit-animation-name: checkmark;
		  -moz-animation-name: checkmark;
		  animation-name: checkmark;		  
		  -webkit-animation-fill-mode: forwards;
		  -moz-animation-fill-mode: forwards;
		  animation-fill-mode: forwards;

		  -webkit-animation-iteration-count: infinite;
		  -moz-animation-iteration-count: infinite;
		  animation-iteration-count: infinite;
		}

		.checkmark-circle .checkmark:after {
		  opacity: 1;
		  height: 50%;
		  width: 25%;
		  -webkit-transform-origin: left top;
		  -moz-transform-origin: left top;
		  -ms-transform-origin: left top;
		  -o-transform-origin: left top;
		  transform-origin: left top;

		  -webkit-transform: scaleX(-1) rotate(135deg);
		  -moz-transform: scaleX(-1) rotate(135deg);
		  -ms-transform: scaleX(-1) rotate(135deg);
		  -o-transform: scaleX(-1) rotate(135deg);
		  transform: scaleX(-1) rotate(135deg);

		  border-right: 2.5px solid white;
		  border-top: 2.5px solid white;
		  border-radius: 2.5px !important;
		  content: '';
		  left: 25%;
		  top: 50%;
		  position: absolute;
		}

		@-webkit-keyframes checkmark {
		  0% {
		    height: 0;
		    width: 0;
		    opacity: 1;
		  }
		  20% {
		    height: 0;
		    width: 25%;
		    opacity: 1;
		  }
		  40% {
		    height: 50%;
		    width: 25%;
		    opacity: 1;
		  }
		  100% {
		    height: 50%;
		    width: 25%;
		    opacity: 1;
		  }
		}
		@-moz-keyframes checkmark {
		  0% {
		    height: 0;
		    width: 0;
		    opacity: 1;
		  }
		  20% {
		    height: 0;
		    width: 25%;
		    opacity: 1;
		  }
		  40% {
		    height: 50%;
		    width: 25%;
		    opacity: 1;
		  }
		  100% {
		    height: 50%;
		    width: 25%;
		    opacity: 1;
		  }
		}
		@keyframes checkmark {
		  0% {
		    height: 0;
		    width: 0;
		    opacity: 1;
		  }
		  20% {
		    height: 15%;
		    width: 25%;
		    opacity: 1;
		  }
		  40% {
		    height: 50%;
		    width: 25%;
		    opacity: 1;
		  }
		  100% {
		    height: 50%;
		    width: 25%;
		    opacity: 1;
		  }
		}


		.gray-banner {
			font-size:20px;
			font-family: 'Oswald';
			border-bottom:1px solid #DEDEDE;
			background-color: #E9E9E9;
			padding: 15px 0px;
		}

		.banner-section.orange{
			background-color:#D66C3B; 
			border-top: 1px solid #FF9361;
		}

		.lato {
			font-family: 'Lato';
		}


		.logo-image {
			width: 50px;
		}

		.logo-image:hover {
			-webkit-animation-name: spin;
		    -webkit-animation-duration: 1000ms;
		    -webkit-animation-iteration-count: infinite;
		    -webkit-animation-timing-function: linear;
		    -moz-animation-name: spin;
		    -moz-animation-duration: 1000ms;
		    -moz-animation-iteration-count: infinite;
		    -moz-animation-timing-function: linear;
		    -ms-animation-name: spin;
		    -ms-animation-duration: 1000ms;
		    -ms-animation-iteration-count: infinite;
		    -ms-animation-timing-function: linear;
		}

		.logo-text {
			text-decoration: none;
			font-size: 16px;
			font-family: 'Oswald';
		}

		.feature-image-wrapped {
			width:30%; 
			margin-top:10px;
		}

		a:hover {
			text-decoration: none;
		}

		.oswald {
			font-family: 'Oswald';
		}

		.dark-bg {
			background-color: #424242;
			color:#fff;
		}

		.gray-bg {
			background-color: #E9E9E9;
		}

		.green-bg {
		  background: #3c763d;
		}

		.text-white {
			color:#fff;
		}

		.text-gray {
			color:#ccc;
		}
		
		.text-yellow {
			color:#fcc21b;
		}

		.text-orange {
			color: #ed6c30;
		}

		.inline-block {
			display: inline-block
		}

		.full-width {
			width:100%;
		}

		.fa-btn {
			margin-right: 6px;
		}

		.navbar {
		    margin-bottom: 0;
		}

		@-moz-keyframes spin {
		    from { -moz-transform: rotate(0deg); }
		    to { -moz-transform: rotate(360deg); }
		}
		@-webkit-keyframes spin {
		    from { -webkit-transform: rotate(0deg); }
		    to { -webkit-transform: rotate(360deg); }
		}
		@keyframes spin {
		    from {transform:rotate(0deg);}
		    to {transform:rotate(360deg);}
		}

		.spin {
			-webkit-animation-name: spin;
		    -webkit-animation-duration: 1000ms;
		    -webkit-animation-iteration-count: infinite;
		    -webkit-animation-timing-function: linear;
		    -moz-animation-name: spin;
		    -moz-animation-duration: 1000ms;
		    -moz-animation-iteration-count: infinite;
		    -moz-animation-timing-function: linear;
		    -ms-animation-name: spin;
		    -ms-animation-duration: 1000ms;
		    -ms-animation-iteration-count: infinite;
		    -ms-animation-timing-function: linear;
		}
	</style>
</head>


<body id="app-layout">
	

	<nav class="navbar navbar-dark navbar-static-top">
		<div class="navbar-inner">
		<div class="container">
			<div class="navbar-header">

				<!-- Collapsed Hamburger -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<!-- Branding Image -->
				<a href="">
					<img class="logo-image" src="/img/monkey-logo.png">
					<span class="logo-text text-yellow">{<span class="text-orange">Code Monkeys</span>}</span>
				</a>
			</div>

			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!-- Left Side Of Navbar -->

				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">					
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								Services <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li><a href=""><i class="fa fa-btn fa-desktop"></i>UI Design</a></li>
								<li><a href=""><i class="fa fa-btn fa-cogs"></i>API Integration</a></li>
								<li><a href=""><i class="fa fa-btn fa-database"></i>Database Optimization</a></li>
							</ul>
						</li>   	

						<li><a class="btn" id="registration-link">Register</a></li>					
				</ul>
			</div>
		</div>
	</div>
	</nav>

	<div class="container-fluid">
		<div class="row gray-banner">
			<div class="col-md-10 col-md-offset-1 text-center">
				<div id="banner">
					<div class="inline-block">Sign up to get news updates and access to our open source tools. </div> 
					<div class="btn btn-primary margin-left-md" id="start-registration" style="">Start Registration!</div>
				</div>
				<div class="hidden text-success" id="success-banner">
					<div class="checkmark-circle"><div class="background green-bg"><i class="fa fa-check" aria-hidden="true"></i></div><div class="checkmark draw"></div></div> Successfully Registered a New Account!
				</div>
			</div>
		</div>

		<div class="row padding-top-xxl padding-bottom-xxl margin-top-lg margin-bottom-lg">
			<div class="col-md-8 col-md-offset-2 col-sm-12">
				<div class="container-fluid rounded-md dark-bg text-gray padding-top-lg padding-bottom-lg">
					<div class="row">
						<div class="col-sm-8">
							<div id="chart" style="width:100%; height:300px"></div>
						</div>
						<div class="col-sm-4">
							<h3 class="oswald text-white"><i class="fa fa-line-chart"></i> Analytics </h3>
							<div>
								<small>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
									Proin at fermentum nisl. Curabitur aliquet blandit cursus. Morbi semper ligula dolor, ut blandit nisl dapibus sit amet. 
									Nullam quis suscipit ex. Nam efficitur auctor pharetra. 
									Curabitur eget ante magna. Nunc in lacus bibendum, molestie magna accumsan, elementum erat. 
								</small>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="row padding-bottom-xxl banner-section orange">
			<div class="col-sm-12 col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">				
				<div class="row text-white">
					<div class="col-sm-4 padding-top-xxl">
						<h3 class="no-margin oswald text-white"><img style="width:50px;" src="/img/api-integration.png">
							API Integrations</h3>
						<div class="row margin-top-lg">
							<div class="col-sm-12">
								<small>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
									Proin at fermentum nisl. Curabitur aliquet blandit cursus. Morbi semper ligula dolor, ut blandit nisl dapibus sit amet. 
									Nullam quis suscipit ex. Nam efficitur auctor pharetra. 
									Curabitur eget ante magna. Nunc in lacus bibendum, molestie magna accumsan, elementum erat. 
									Quisque vel nibh at odio commodo sollicitudin eget et nibh.
								</small>
							</div>
						</div>
					</div>
					<div class="col-sm-4 padding-top-xxl">
						<h3 class="no-margin oswald text-white"><img style="width:50px" src="/img/ui-design.png"> UI Design</h3>
						<div class="row margin-top-lg">
							<div class="col-sm-12">
								<small>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
									Proin at fermentum nisl. Curabitur aliquet blandit cursus. Morbi semper ligula dolor, ut blandit nisl dapibus sit amet. 
									Nullam quis suscipit ex. Nam efficitur auctor pharetra. 
									Curabitur eget ante magna. Nunc in lacus bibendum, molestie magna accumsan, elementum erat. 
									Quisque vel nibh at odio commodo sollicitudin eget et nibh.
								</small>
							</div>
						</div>
					</div>
					<div class="col-sm-4 padding-top-xxl">
						<h3 class="no-margin oswald text-white"><img style="width:50px;" src="/img/db-management.png"> Database Optimization</h3>
						<div class="row margin-top-lg">
							<div class="col-sm-12">
								<small>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
									Proin at fermentum nisl. Curabitur aliquet blandit cursus. Morbi semper ligula dolor, ut blandit nisl dapibus sit amet. 
									Nullam quis suscipit ex. Nam efficitur auctor pharetra. 
									Curabitur eget ante magna. Nunc in lacus bibendum, molestie magna accumsan, elementum erat. 
									Quisque vel nibh at odio commodo sollicitudin eget et nibh.
								</small>
							</div>
						</div>
					</div>
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

	<div id="loading-modal" class="modal fade oswald" data-backdrop="static" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body text-center">
					<h3 class="no-margin"><i class='fa fa-gear spin'></i> Loading...</h3>
				</div>			
			</div>
		</div>
	</div>
	
	<!-- JavaScripts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/additional-methods.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>

	<!-- More Generic functions, Semi re-usable separating from page specific functionality -->
	<script>
		$.validator.addMethod('hasNumber', function(value, element) {
			return this.optional(element) || /\d/.test(value);
		}, 'Must contain at least 1 number');

		$.validator.addMethod('hasSpecial', function(value, element, params) {
			// console.log(params);
			var regex = new RegExp(params);
			return this.optional(element) || regex.test(value);
		}, 'Must contain at least 1 special character (!@#$%^&*)');

		function getRandomInt(min, max) {
		  min = Math.ceil(min);
		  max = Math.floor(max);
		  return Math.floor(Math.random() * (max - min)) + min;
		}

		function randomizeData(min, max, numberOfPoints) {
			var data = [];

			for(var x =0; x<numberOfPoints; x++) {
				data.push(getRandomInt(min, max));	
			}

			return data;
		}
	</script>

	<!-- Page Specific JS functionality -->
	<script>
		$(document).on('click', '#start-registration, #registration-link', setupRegistration);
		
		function validateForm() {
			var errors = 0;
			errors += validatePassword();
		}


		function removeError(element) {
			element.removeClass('text-danger').addClass('text-success');
		}

		function addError(element) {
			element.addClass('text-danger').removeClass('text-success');
		}

		function validatePassword() {
			errorCount = 0;
		
			var charMinimum = 8;
			var element = $('#password');
			var password = element.val();

			if(password.length >= charMinimum) {
				removeError($('#charMin'));
			} else {
				addError($('#charMin'));
				errorCount++;
			}

			if(/\d/.test(password)) {
				removeError($('#charNum'));
			} else {
				addError($('#charNum'));
				errorCount++;
			}

			if(/[!@#$%^&*]/.test(password)) {
				removeError($('#charSpecial'));
			} else {
				addError($('#charSpecial'));
				errorCount++;
			}

			if(errorCount > 0) {
				$('#password').parent('div').addClass('has-error');
			} else {
				$('#password').parent('div').removeClass('has-error');
			}

			return errorCount;
		}

		function setupRegistration() {
			$('#registration-form').validate({
				rules: {
					email: {
						required: true,
						email: true
					},
					password: {
						required: true,
						minlength: 8,
						hasSpecial: '[!@#$%^&*]',
						hasNumber: true
					},
					"confirm-password": {
						equalTo: '#password',
						required: true
					}
				},
				messages: {
					"confirm-password": {
						equalTo: 'Password must match'
					}
				},
				errorClass: "text-danger",
				onkeyup: false,
				submitHandler: function() {
					$('#registration-modal').modal('hide');
					$('#loading-modal').modal('show');

					setTimeout(successfulRegistration, 2000);
				}
			});
			

			$(document).on('keyup', '#registration-form input', validateForm);

			$('#registration-modal').modal('show');
		}

		function successfulRegistration() {
			$('#loading-modal').modal('hide');

			$('#banner').addClass('hidden');
			$('#registration-link').addClass('hidden');
			$('#success-banner').removeClass('hidden');
		}

		function drawChart() {
			var data1 = randomizeData(1,50, 20);
			var data2 = randomizeData(1,50, 20);

		    $('#chart').highcharts({
		        chart: {
		            type: 'line',
		            style: {
		            	fontFamily: 'Oswald',
		            	borderRadius: '5px'
		            }
		        },
		        title: {
		            text: 'Data Analysis'
		        },
		        xAxis: {
		            categories: []
		        },
		        yAxis: {
		            title: {
		                text: 'Data'
		            }
		        },
		        series: [{
		            name: 'Person 1',
		            data: data1
		        }, {
		            name: 'Person 2',
		            data: data2
		        }]
		    });
		}

		$(document).ready(function() {
			drawChart();			
		});	
	</script>

</body>
</html>
