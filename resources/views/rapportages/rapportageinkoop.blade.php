@extends('main')

@section('title', 'Productie')

@section('content')


	<div id="container" style="min-width: 310px; height: 600px; max-width: 600px; margin: 0 auto"></div>


@endsection


@section('scripts')

	<script src="/js/highcharts.js"></script>
	<script src="/js/highcharts-more.js"></script>
	<script src="/js/exporting.js"></script>

	<script type="text/javascript">

			var myData = [{
					        data: [{
					            name: 'Point 1',
					            color: '#00FF00',
					            y: 1
					        }, {
					            name: 'Point 2',
					            color: '#FF00FF',
					            y: 5
					        }]
					    }];

	        // Build the chart
			Highcharts.chart('container', {
			    chart: {
			        type: 'column'
			    },
			    title: {
			        text: 'Inkoop grondstoffen'
			    },
			    subtitle: {
			        text: 'in euro'
			    },
			        credits: {
			        enabled: false
			    },
    	        legend: {
		            align: 'right',
		            x: 0,
		            verticalAlign: 'right',
		            y: 0,
		            floating: true,
		            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
		            borderColor: '#CCC',
		            borderWidth: 1,
		            shadow: false
		        },
		        tooltip: {
		            headerFormat: '<b>{point.x}</b><br/>',
		            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
		        },
		        plotOptions: {
		            column: {
		                stacking: 'normal',
		                dataLabels: {
		                    enabled: true,
		                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
		                }
		            }
		        },
			    xAxis: {
	            	categories: {!!$xas!!}
	        	},
		      	series: {!!$graphdata!!} 
			});
			// End chart
		

</script>
@endsection
