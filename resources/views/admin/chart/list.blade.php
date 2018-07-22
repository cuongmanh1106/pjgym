@extends('admin.include.layout')
@section('title','Chart')
@section('content')
@include('admin.include.report')
<div class="container">
	<h2>Revenue</h2>
	<?php
	$year = date("Y");

	?>
	<div class="card">
		<div class="card-body">
			<select name="year" class="form-control">
				@for($i = $year; $i > $year - 5; $i--)
				<option value="{{ $i }}">{{ $i }}</option>
				@endfor

			</select>
			<div id="chart_html">
				{!! $pie_chart->html() !!}
				{!! $pie_chart->script() !!}

			</div>


		</div>
		{!! Charts::scripts() !!}
		<div class="card">
			<div class="card-header">
				Filter Revenue
			</div>
			<div class="card-body">
				<h5 class="card-title">Search Revenue:</h5>
				<div class="row">
					<div class="col-md-4"><input class="form-control" type="date" name="date"></div>
					<div class="col-md-8"><b>Revenue:</b> <span id="revenue"></span></div>
				</div>
			</div>
		</div>



		<div class="card">
			<div class="card-header" style="text-align: center;">
				Top products avenue
			</div>
			<div class="card-body">
				<h5 class="card-title" style="text-align: center;">Top 10</h5>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>STT</th>
							<th>Image</th>
							<th>Name</th>
							<th>Times order</th>
							<th>Revenue</th>
						</tr>

					</thead>
					<tbody>
						@foreach($top_product as $key=>$tp)
						<tr>
							<td>{{ $key + 1 }}</td>
							<td><img src="{{ asset('/public/admin/images') }}//{{ $tp->image }}" width="60px"></td>
							<td>{{ $tp->name }}</td>
							<td>{{ $tp->total_quantity }}</td>
							<td>${{ number_format($tp->total,2) }}</td>

						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>





<script type="text/javascript">
	$('select[name=year').on('click',function(){
		year  = $('select[name=year]').val();
		console.log(year);
		$.ajax({
			type:'POST',
			url:'{{ route('admin.chart.year') }}',
			data:{'year':year},
			success:function(data){
				$('#chart_html').html(data);

			}
		})
	})

	$('input[name=date]').on('change',function(){
		date = $('input[name=date]').val();
		$.ajax({
			type:'POST',
			url :'{{ route('admin.chart.filter') }}',
			data:{'date':date},
			success:function(data){
				$('#revenue').html("$ "+data);
			}
		})
	})
</script>
@endsection