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

		</div>
	</div>
</div>
@endsection

@section('scripts')
	<script>
		$(document).on('click', '#process', function(e) {
			e.preventDefault();

			var data = $('#data').serialize();
			console.log(data);

			$.ajax({
				url: '/tools/stair-process',
				data: data,
				type: 'POST'
			}).then(function(html) {
				$('#result-view').html(html);
			})


		});

	</script>

@endsection