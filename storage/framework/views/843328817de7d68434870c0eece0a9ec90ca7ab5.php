<?php $__env->startSection('title', 'Correspondentie'); ?>



<?php $__env->startSection('css'); ?>
<style>
	@media  print {
	  .page-header * {
	    visibility: hidden;
	  }
	  navbar * {
	    visibility: hidden;
	  }
	  #printbutton{
	  	visibility: hidden;	
	  }
	  #section-to-print, #section-to-print * {
	    visibility: visible;
	  }
	  #section-to-print {
	    position: absolute;
	    left: 0;
	    top: 0;
	  }
	}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	<div class="col-md-12 col-md-offset-1">
		<div class="well">
			<div id="printableArea">
				
				<?php echo e(isset($leverancier->naam) ? $leverancier->naam : ''); ?><br>
				<?php echo e(isset($leverancier->factuurnaam) ? $leverancier->factuurnaam : ''); ?><br>
				<?php echo e(isset($leverancier->factuuradres) ? $leverancier->factuuradres : ''); ?><br>
				<?php echo e(isset($leverancier->factuurpostcode) ? $leverancier->factuurpostcode : ''); ?><br>
				<?php echo e(isset($leverancier->factuurplaats) ? $leverancier->factuurplaats : ''); ?><br>
				<br>
				<br>
				Amsterdam, <?php echo e(date("d M Y")); ?><br>
				<br>
				Geachte heer, mevrouw <?php echo e($leverancier->factuurnaam); ?>,<br>
				<br>
				<br>
				<br>
				<br>

				<br>
				<br>
				<br>
				<br>
				Met vriendelijke groeten,<br>
				<br>
				<br>
					<?php echo e(isset($group->groupname) ? $group->groupname : ''); ?><br>
					<?php echo e(isset($group->adres) ? $group->adres : ''); ?><br>
					<?php echo e(isset($group->woonplaats) ? $group->woonplaats : ''); ?> 				
			</div>
		</div>
	</div>
	<div class="col-md-12 ">
		<div class="col col-md-12 col-md-offset-1 align-left" id="printbutton" style="margin-top:20px">
			<input type="button" onclick="printDiv('printableArea')" value="Afdrukken" />
		</div>

	</div>




<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script type="text/javascript">
		function printDiv(divName) {
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
 			document.body.innerHTML = originalContents;
	 	};
     </script>
}

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>