<?php $__env->startSection('title', 'Mijn profiel'); ?>

<?php $__env->startSection('css'); ?>
    <!--Fancybox-->
    <link rel="stylesheet" href="/css/jquery.fancybox.css" type="text/css" media="screen" />
    <!--
    <link rel="stylesheet" href="/css/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
    -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <div class = 'row'>

        <div class="col-md-10 col-md-offset-1">
            
            <?php echo Form::model($group, ['files' => true, 'data-parsley-validate' => '', 'id'=>'uploadForm']); ?> 

            <div class="col-md-5">    
                    
                    <div class="form-group error col-md-12">
                        <?php echo e(Form::label('groupnaam', 'Naam:', 'class="control-label"')); ?>

                        <?php echo e(Form::text('groupname', null, ["class" => 'form-control', 'required' => '', 'maxlength' => '300', ])); ?>

                    </div>
                    <div class="form-group col-md-12">
                        <?php echo e(Form::label('adres', 'Adres:', 'class="control-label"')); ?>

                        <?php echo e(Form::text('adres', null,  ["class" => 'form-control', 'required' => ''])); ?>

                    </div>
                    <div class="form-group col-md-12">
                        <?php echo e(Form::label('woonplaats', 'Woonplaats:', 'class="control-label"')); ?>

                        <?php echo e(Form::text('woonplaats', null,  ["class" => 'form-control', 'rows'=> '5' ,'required' => ''])); ?>

                    </div>
                    <div class="form-group col-md-12">
                        <?php echo e(Form::label('email', 'Email:', 'class="control-label"')); ?>

                        <?php echo e(Form::text('email', null,  ["class" => 'form-control', 'rows'=> '5' ,'required' => ''])); ?>

                    </div>
                    <div class="form-group col-md-6">
                        <?php echo e(Form::label('password', 'Wachtwoord:', 'class="control-label"')); ?>

                        <?php echo e(Form::password('password', ["class" => 'form-control', 'rows'=> '5' ,'required' => ''])); ?>

                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>  

            </div>

            <div class="col-md-5">
                <div class= "well" id="logo_well">
                    <a class="fancybox" href="/images/logos/<?php echo e(isset($group->logo) ? $group->logo : 'notfound.png'); ?>" id="fancyboximage">
                        <img src="/images/logos/<?php echo e(isset($group->logo) ? $group->logo : 'notfound.png'); ?>" id="imagepreview" width="100%" class="img-responsive">
                    </a>
                </div>
                <div>
                    <input type='file' name='image' id='image' onchange="readURL(this);" />
                </div> 
            </div>

            <?php echo Form::close(); ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
    <script type="text/javascript" src="/js/jquery.fancybox.js"></script>

    <script type="text/javascript">

		$(document).ready(function(){
			$(".fancybox").fancybox({
                closeBtn    : 'true',
                openEffect  : 'elastic',
                closeEffect : 'elastic',
                helpers : {
                    overlay : {
                        css : {
                            'background' : 'rgba(58, 42, 45, 0.85)'
                        }
                    }
                }
            });
        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>