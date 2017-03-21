<?php $__env->startSection('title', 'Verbruik grondstoffen'); ?>

<?php $__env->startSection('css'); ?>
	<!--  -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

	    <div class = 'row'>
        <div class="col-md-7 col-md-offset-1">

            <table id="verbruikstable" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Datum</th>
                    <th>Brouwsel</th>
                    <th>Grondstof</th>
                    <th class="text-right">Hoeveelheid (kg)</th>
                 </tr>
                 </thead>
                 <tbody id="voorraadbody">
                    <?php $__currentLoopData = $voorraadgrondstoffen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voorraadgrondstof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td data-order="strtotime(<?php echo e($voorraadgrondstof->datum); ?>)"><?php echo e(date('d-m-Y', strtotime($voorraadgrondstof->datum))); ?></td>
                            <td><?php echo e($voorraadgrondstof->liters); ?> x <?php echo e($voorraadgrondstof->bier); ?></td>
                            <td><?php echo e($voorraadgrondstof->grondstof); ?></td>
                            <td class="text-right"><?php echo e($voorraadgrondstof->hoeveelheidkg); ?></td>
                        </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    
    <script type="text/javascript">

        $(document).ready(function(){

            $('#verbruikstable').DataTable({
                "responsive": true,
                "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Alle"]],
                "pageLength": -1, //Default All
                "order": [[ 0, "desc" ]],
                "bPaginate": true,
                "searching": true,
                "processing": true,
                "language": {
                    "url": "/js/datatables_lang/datatables_lang_dut.json"
                },
                columnDefs: [ 
                    {
                        targets: [ 0 ],
                        orderData: [ 0, 2 ],
                        orderable: true
                    }, {
                        targets: [ 1 ],
                        orderData: [ 1, 0 ],
                        orderable: true
                    }, {
                        targets: [ 2 ],
                        orderable: true
                    }, {
                        targets: [ 3 ],
                        orderable: false
                    }
                ],
            });

        });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>