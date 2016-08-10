<div class="panel panel-default">

	<div class="panel-body" id="container" data-calculations="{{json_encode($item->getAttributes())}}">

		<div class="row">
			<div class="col-sm-6">
				
				<h3 class="text-left">General Specs</h3>
				
				<div class="row">
					<div class="col-sm-6"><strong>Number Of Stairs</strong></div>
					<div class="col-sm-6">{!! $item->numberOfStairs !!}</div>
				</div>				

				<div class="row">
					<div class="col-sm-6"><strong>Board Width</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->boardWidth) !!}"</div>
				</div>

				<div class="row">
					<div class="col-sm-6"><strong>Board Length Required</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->treadSpacing * $item->numberOfStairs) !!}"</div>
				</div>

				<div class="row">
					<div class="col-sm-6"><strong>Distance Between Treads</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->treadSpacing) !!}"</div>
				</div>



			</div>

			<div class="col-sm-6">
				<h3>Tread Specs</h3>
				<div class="row">
					<div class="col-sm-6"><strong>Tread Rise</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->treadRise) !!}"</div>
				</div>

				<div class="row">
					<div class="col-sm-6"><strong>Tread Run</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->treadRun) !!}"</div>
				</div>

				<div class="row">
					<div class="col-sm-6"><strong>Tread Inset</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->boardInset) !!}"</div>
				</div>

				<div class="row">
					<div class="col-sm-6"><strong>Board Remaining</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->boardRemaining) !!}"</div>
				</div>

				<div class="row">
					<div class="col-sm-6"><strong>Large Angle</strong></div>
					<div class="col-sm-6">{!! number_format(rad2deg($item->treadRunAngle), 2) !!} Degrees</div>
				</div>

				<div class="row">
					<div class="col-sm-6"><strong>Small Angle</strong></div>
					<div class="col-sm-6">{!! number_format(rad2deg($item->treadRiseAngle), 2) !!} Degrees</div>
				</div>
			</div>

			<div class="col-sm-6">
				<h3>Bottom Stair Specs</h3>

				<div class="row">
					<div class="col-sm-6"><strong>Bottom Tread Inset</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->bottomInset) !!}"</div>
				</div>

				<div class="row">
					<div class="col-sm-6"><strong>Bottom Board Length</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->bottomBoardLength) !!}"</div>
				</div>
			</div>

			<div class="col-sm-6">							
				<h3>Top Stair Specs</h3>

				<div class="row">
					<div class="col-sm-6"><strong>Board Attachment Point</strong></div>
					<div class="col-sm-6">{!! ViewHelper::fraction($item->boardAttachment) !!}"</div>
				</div>							
			</div>
		</div>

		<br>

		<canvas id="stringerView" height="250"></canvas>

	</div>
</div>

<script>
		var canvas = null;
		var tool = null;
		var data = null;

		var canvasWidth = null;
		var scale = null;

		var leftEdge = 30;
		var topEdge = 50;
		var rightEdge = 30;
		var bottomEdge = 0;

		$(document).ready(function() {
			canvas = document.getElementById("stringerView");
			tool = canvas.getContext("2d");
			data = $('#container').data('calculations');
			resizeCanvas();
		});

		window.addEventListener('resize', resizeCanvas);

		function resizeCanvas() {
			canvas.width = $('#container').width();

			draw();
		}	

		
				
		function draw() {
			// convert the width to be dynamic

			canvasWidth = canvas.width;

			data['boardLength'] = data['numberOfStairs'] * data['treadSpacing'];
			scale = (canvasWidth - (leftEdge + rightEdge)) / data['boardLength'];

			drawBoard();
			
			tool.beginPath();
			tool.fillStyle="#eee";
			drawAttachment();
			for(var x=1; x < data['numberOfStairs']; x++) {
				drawTread(x);
			}
			drawBottom(data['numberOfStairs']);


			// tool.save();
			// tool.rotate(-Math.PI/2);
			// tool.fillText('test', -80,10);
			// tool.font = '20px "Roboto"';
			// tool.fillStyle = 'black';
			// tool.restore();
		}

		

		function getScaled(propName) {
			if(data.hasOwnProperty(propName)) {
				return data[propName] * scale;
			} else {
				throw "No data parameter found for: " + propName;
			}			
		}

		function drawBoard() {
			tool.beginPath();
			tool.moveTo(leftEdge, topEdge);
			tool.lineTo(leftEdge, getScaled('boardWidth') + topEdge);
			tool.lineTo(data['numberOfStairs'] * getScaled('treadSpacing') + leftEdge, getScaled('boardWidth') + topEdge);
			tool.lineTo(data['numberOfStairs'] * getScaled('treadSpacing') + leftEdge, topEdge);
			tool.lineTo(leftEdge, topEdge);
			tool.stroke();
			
		}

		function getStartOffset(stairNumber) {
			var multiplier = (stairNumber - 1);
			return multiplier * getScaled('treadSpacing');
		}

		function drawAttachment() {
			tool.beginPath();
			tool.setLineDash([5]);
			tool.moveTo(leftEdge, getScaled('boardInset') + topEdge);

			tool.lineTo(getScaled('attachmentOffset') + leftEdge, getScaled('boardWidth') + topEdge);
			tool.stroke();
		}

		function drawTread(stairNumber) {
			tool.beginPath();
			tool.setLineDash([5]);

			var startOffset = getStartOffset(stairNumber);

			tool.moveTo(startOffset + leftEdge, getScaled('boardInset') + topEdge);
			tool.lineTo(getScaled('largeTreadOffset') + startOffset + leftEdge, topEdge);
			tool.lineTo(getScaled('treadSpacing') + startOffset + leftEdge, getScaled('boardInset') + topEdge);
			tool.stroke();

			
		}

		function drawBottom(stairNumber) {
			tool.beginPath();
			tool.setLineDash([5]);

			var startOffset = getStartOffset(stairNumber);

			tool.moveTo(startOffset + leftEdge, getScaled('boardInset') + topEdge);
			tool.lineTo(getScaled('largeTreadOffset') + startOffset + leftEdge, topEdge);
			tool.lineTo(getScaled('largeTreadOffset') + startOffset + getScaled('bottomOffset') + leftEdge, getScaled('bottomInset') + topEdge);

			tool.lineTo((getScaled('largeTreadOffset') + startOffset + getScaled('bottomOffset') + leftEdge) - getScaled('bottomBoardBack'), getScaled('boardWidth') + topEdge);
			tool.stroke();
		}

	</script>

