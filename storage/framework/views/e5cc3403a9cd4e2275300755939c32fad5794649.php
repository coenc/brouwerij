<?php $__env->startSection('title', 'Accijnsafdracht'); ?>



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

	<div class="col-md-6">
		
			<div id="printableArea">

			<table class="table table-striped table-hover" id="grondstofcattable">

				 <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Product</th>
                        <th>Liters</th>
                        <th>Tarief per HL</th>
                        <th class="text-right">Afdracht (€)</th>
                    </tr>
                </thead>

                <tbody id="grondstofcatbody">
					<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	                    <tr>
	                    	<td><?php echo e(date('d-m-Y', strtotime($item->datum))); ?></td>
	                    	<td><?php echo e($item->omschrijving); ?></td>
	                    	<td><?php echo e($item->liters); ?></td>
	                    	<td><?php echo e($item->tariefperhl); ?></td>
	                    	<td class="text-right">€ <?php echo e($item->afdracht); ?></td>
	                    </tr>
	                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

					<?php $__currentLoopData = $total; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tot): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                        	<td></td>
                            <td class="text-right"><strong>€ <?php echo e($tot->total); ?></strong></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	            </tbody>
            </table>



			</div>
		
	</div>
	<div class="col-md-7">
		<div class="col col-md-12 align-left" id="printbutton" style="margin-top:20px">
			<input type="button" onclick="printDiv('printableArea')" value="Afdrukken" />
		</div>

	</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

	<script type="text/javascript">
		function printDiv(divName) {
			$('#printtext').val($('#mytextarea').value); 
			var printContents = document.getElementById(divName).innerHTML;
			var originalContents = document.body.innerHTML;
			document.body.innerHTML = printContents;
			window.print();
 			document.body.innerHTML = originalContents;
	 	};
     </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>