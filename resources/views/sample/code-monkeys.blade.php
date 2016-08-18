@extends('layouts.app')

@section('navbar-theme', 'navbar-dark')

@section('styling')
    <style>
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

		a:hover {
			text-decoration: none;
		}


		.navbar {
		    margin-bottom: 0;
		}

		
    </style>
@endsection

@section('content')
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
						<h3 class="no-margin oswald text-white"><img style="width:50px;" src="/img/db-management.png"> DB Optimization</h3>
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

@endsection


@section('logo')
    <!-- Branding Image -->
    <a href="{{ url('/') }}">
        <img class="logo-image" src="/img/monkey-logo.png">
        <span class="logo-text text-yellow">{<span class="text-orange">Code Monkeys</span>}</span>
    </a>
@endsection

	
@section('scripts')
	<!-- More Generic functions, Semi re-usable separating from page specific functionality -->
	<script>
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
@endsection
