<!DOCTYPE html>
<html lang=<?php echo e(config('app.locale')); ?>>

	<head>
    	<?php echo $__env->make('partials._head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </head>

    <body>

		<div id='cookie_alert' class="row"></div>
        
        <?php echo $__env->make('partials._menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('partials._messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <div class="content">
		<div class="container">

		    <div class="page-header">
		        <div class="row">
		            <div class="col-md-8">
		                <h3><?php echo $__env->yieldContent('title'); ?></h3>    
		            </div>
		        </div>
		    </div>

	        <?php echo $__env->yieldContent('content'); ?>
        
        </div><!--div content-->

        </div><!--div container-->

    </body>
    
	<?php echo $__env->make('partials._scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<?php echo $__env->yieldContent('scripts'); ?>
	
</html>
