@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2 text-left">
			<h2 class="text-info"><i class="fa fa-calculator"></i> Stair Calculator</h2>
			<br>
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif

			<form class="form-horizontal " id="data" role="form" method="POST" action="{{ url('/tools/stair-process') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="col-md-2 control-label">Board Width</label>
					<div class="col-md-3">
						<input class="form-control" name="boardWidth" value="11.25">
					</div>
				</div>

				<!-- <div class="form-group">
					<label class="col-md-2 control-label">Tread Max Rise</label>
					<div class="col-md-3">
						<input class="form-control" name="treadMaxRise" value="7.75">
					</div>
				</div> -->

				<div class="form-group">
					<label class="col-md-2 control-label">Tread Run</label>
					<div class="col-md-3">
						<input class="form-control" name="treadRun" value="10">
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-md-2 control-label">Decking Height</label>
					<div class="col-md-3">
						<input class="form-control" name="deckingHeight" value="1">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-2 control-label">Total Height</label>
					<div class="col-md-3">
						<input class="form-control" name="totalHeight" value="60">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-3 col-md-offset-2">
						<button type="submit" class="btn btn-primary" id="process">Calculate</button>
					</div>
				</div>
			</form>
		</div>

		<div class="col-md-8 col-md-offset-2" id="result-view">
			<canvas id="stringerView" height="250"></canvas>
		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script>
		var Stringer = function(width, rise, run, deckingHeight, numberOfStairs) {
			this.width = width;
			this.rise = rise;
			this.run = run;
			this.deckingHeight = deckingHeight;
			this.numberOfStairs = numberOfStairs;


			///////////////////////////
			////
			////	top stair additional calculations

			this.getBoardAttachment = function() {
				return this.getBoardRemaining() / this.getBoardInset() * this.rise;
			}

			this.getBoardAttachmentOffset = function() {
				return Math.sin(this.getRiseAngle()) * this.getBoardAttachment();
			}

			////////////////////////////
			////
			////	basic stair calculation

			this.getTreadSeparation = function() {
				return Math.sqrt(Math.pow(this.run, 2) + Math.pow(this.rise, 2));
			}

			this.getRiseAngle = function() {
				return Math.asin(this.rise / this.getTreadSeparation());
			}

			this.getRunAngle = function() {
				return Math.asin(this.run / this.getTreadSeparation());
			}

			this.getRunOffset = function() {
				return this.run * Math.cos(this.getRiseAngle());
			}

			this.getRiseOffset = function() {
				return this.rise * Math.sin(this.getRiseAngle());
			}

			this.getBoardInset = function () {
				return Math.sin(this.getRiseAngle()) * this.run;
			}

			this.getBoardRemaining = function() {
				return this.width - this.getBoardInset();
			}


			//////////
			////
			////	bottom stair calculations.

			this.getBottomStairRise = function() {
				return this.rise - this.deckingHeight;
			}

			this.getBottomInset = function() {
				return Math.sin(this.getRunAngle()) * this.getBottomStairRise();
			}

			this.getBottomOffset = function() {
				return Math.cos(this.getRunAngle()) * this.getBottomStairRise();
			}

			this.getBottomBoardRemaining = function() {
				return this.width - this.getBottomInset();
			}

			// the length of the bottom of the board where the tread will rest on the ground.
			this.getBottomBoardLength = function() {
				return this.getBottomBoardRemaining() / Math.cos(this.getRunAngle());
			}

			this.getBottomBoardBack = function() {
				return Math.sqrt( Math.pow(this.getBottomBoardLength(), 2) - Math.pow(this.getBottomBoardRemaining(), 2) );
			}
			

			this.getPoints = function() {
				var points = [];

				// start retrieving points around the board, starting with the attachment point to the ledger at the top of the stair.
				points.push(new Point(this.getBoardAttachmentOffset(), this.width));

				// move to the point where the top tread meets the edge of the board to optimize board yeild
				points.push(new Point(0, this.getBoardInset()));

				// move to the point where the front of the top tread meets the edge of the board, this begins the repeatable code.
				for(var stairCount =1; stairCount < this.numberOfStairs; stairCount++) {
					var previousStairOffset = (stairCount - 1) * this.getTreadSeparation();
					points.push(new Point(previousStairOffset + this.getRunOffset(), 0));
					points.push(new Point(previousStairOffset + this.getTreadSeparation(), this.getBoardInset()));
				}

				var lastOffset = (this.numberOfStairs - 1) * this.getTreadSeparation();

				points.push(new Point(lastOffset + this.getRunOffset(), 0));
				points.push(new Point(lastOffset + this.getRunOffset() + this.getBottomOffset(), this.getBottomInset()));
				points.push(new Point(lastOffset + this.getRunOffset() + this.getBottomOffset() - this.getBottomBoardBack(), this.width));

				return points;
			}
		}

		var Point = function(x, y) {
			this.x = x;
			this.y = y;
		}


		var canvas = null;
		var tool = null;
		var data = null;

		var canvasWidth = null;
		var scale = null;

		var paddingLeft = 30;
		var paddingTop = 50;
		var paddingRight = 30;
		var paddingBottom = 0;

		var modeler = null;
		var stringer = null;

		$(document).ready(function() {
			canvas = document.getElementById("stringerView");
			tool = canvas.getContext("2d");

			modeler = new twoDimViewer(tool);

			canvas.width = $('#result-view').width();
		});

		window.addEventListener('resize', resizeCanvas);

		function resizeCanvas() {
			canvas.width = $('#result-view').width();

			draw();
		}

		function draw() {
			tool.beginPath();
			tool.clearRect(0, 0, canvas.width, canvas.height);
			tool.stroke();

			canvasWidth = canvas.width;

			var boardLength = stringer.numberOfStairs * stringer.getTreadSeparation();
			scale = (canvasWidth - (paddingLeft + paddingRight)) / boardLength;	

			tool.beginPath();
			tool.rect(paddingLeft,paddingTop, boardLength * scale, stringer.width * scale);
			tool.stroke();

			var points = stringer.getPoints();

			tool.beginPath();
			tool.setLineDash([5]);

			tool.moveTo(points[0]['x'] * scale + paddingLeft, points[0]['y'] * scale + paddingTop);
			for(var position=1; position<=points.length - 1; position++) {
				tool.lineTo(points[position]['x'] * scale + paddingLeft, points[position]['y'] * scale + paddingTop);
			}
			tool.stroke();
		}


		$(document).on('click', '#process', function(e) {
			e.preventDefault();

			var data = $('#data').serializeArray().reduce(function(obj, item) {
			    obj[item.name] = item.value;
			    return obj;
			}, {});

			var maxTreadRise = 7.75;

			data['totalHeight'] / maxTreadRise;
		
			var numberOfStairs = Math.ceil(data['totalHeight'] / maxTreadRise);		
			var rise = data['totalHeight'] / numberOfStairs;

			stringer = new Stringer(data['boardWidth'], rise, data['treadRun'], data['deckingHeight'], numberOfStairs);

			draw();
		});

	</script>

@endsection
