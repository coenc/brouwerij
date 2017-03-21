<?php $__env->startSection('title', 'Productie'); ?>

<?php $__env->startSection('content'); ?>

	<div id="container" style="min-width: 310px; height: 600px; max-width: 600px; margin: 0 auto"></div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script src="/js/highcharts.js"></script>
	<script src="/js/highcharts-more.js"></script>
	<script src="/js/exporting.js"></script>

	<script type="text/javascript">

		var processed_json = new Array();   
        $.getJSON('/rapportagedata', function(data) {

            console.log(data['categories']);
            console.log(data['series']);

			var i;
			for(i=0; i<data['series'].length; i++)
			{
				console.log(data['series'][i].name);
				console.log(data['series'][i].data);
			}
    	});

    </script>

    <script type="text/javascript">

		$(document).ready(function() {

		    var options = {
		        chart: {
		            renderTo: 'container',
		            type: 'bar'
		        },
		        xAxis: [{}],
		        series: [{}]
		    };

		    $.getJSON('/rapportagedata', function(data) {
		        options.xAxis[0].data = data['categories'];
		        options.series[0].data = data['series'];

		        var chart = new Highcharts.Chart(options);
		    });

		});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>