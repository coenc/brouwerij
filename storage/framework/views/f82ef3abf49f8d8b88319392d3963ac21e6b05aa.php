<?php $__env->startSection('title', 'Accijns afdracht'); ?>

<?php $__env->startSection('content'); ?>


	


<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

	<script src="/js/highcharts.js"></script>
	<script src="/js/highcharts-more.js"></script>
	<script src="/js/exporting.js"></script>

	<script type="text/javascript">

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>