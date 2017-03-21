<?php $__env->startSection('title', 'Productie'); ?>

<?php $__env->startSection('content'); ?>


	<div id="container" style="min-width: 310px; height: 600px; max-width: 600px; margin: 0 auto"></div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

	<script src="/js/highcharts.js"></script>
	<script src="/js/highcharts-more.js"></script>
	<script src="/js/exporting.js"></script>

	<script type="text/javascript">

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
	            	categories: <?php echo $xas; ?>

	        	},
		      	series: <?php echo $graphdata; ?> 
			});
			// End chart
		

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>