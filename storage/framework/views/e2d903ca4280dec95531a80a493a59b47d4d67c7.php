<?php $__env->startSection('title', 'Productie'); ?>

<?php $__env->startSection('content'); ?>

	<div id="container" style="min-width: 310px; height: 600px; max-width: 600px; margin: 0 auto"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script src="/js/highcharts.js"></script>
	<script src="/js/highcharts-more.js"></script>
	<script src="/js/exporting.js"></script>

	<script type="text/javascript">

		Highcharts.chart('container', {
		    chart: {
		        type: 'column'
		    },
		    title: {
		        text: 'Productie per datum'
		    },
		    credits: {
		        enabled: false
		    },
		    xAxis: {
		        categories: <?php echo $xas; ?>

		    },
		    yAxis: {
		        min: 0,
		        title: {
		            text: 'Total in ltr'
		        },
		        stackLabels: {
		            enabled: true,
		            style: {
		                fontWeight: 'bold',
		                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
		            }
		        }
		    },
		    legend: {
		        align: 'right',
		        x: -30,
		        verticalAlign: 'top',
		        y: 25,
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
		    // series: [{
		    //     name: 'John',
		    //     data: [5, 3, 4, 7, 2]
		    // }, {
		    //     name: 'Jane',
		    //     data: [2, 2, 3, 2, 1]
		    // }, {
		    //     name: 'Joe',
		    //     data: [3, 4, 4, 2, 5]
		    // }]
		    series: <?php echo $myData; ?>

		});

    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>