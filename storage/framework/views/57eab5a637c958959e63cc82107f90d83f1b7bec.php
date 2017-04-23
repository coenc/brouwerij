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
                            <?php echo e(Form::label('groupnaam', 'Naam', 'class="control-label"')); ?>

                            <?php echo e(Form::text('groupname', null, ["class" => 'form-control', 'required' => '', 'maxlength' => '100', ])); ?>

                        </div>
                        <div class="form-group col-md-12">
                            <?php echo e(Form::label('adres', 'Adres', 'class="control-label"')); ?>

                            <?php echo e(Form::text('adres', null,  ["class" => 'form-control'])); ?>

                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <?php echo e(Form::label('postcode', 'Postcode', 'class="control-label"')); ?>

                            <?php echo e(Form::text('postcode', null,  ["class" => 'form-control'])); ?>

                        </div>
                        <div class="form-group col-sm-8 col-md-8">
                            <?php echo e(Form::label('woonplaats', 'Woonplaats', 'class="control-label"')); ?>

                            <?php echo e(Form::text('woonplaats', null,  ["class" => 'form-control', 'rows'=> '5'])); ?>

                        </div>
                        <div class="form-group col-md-12">
                            <?php echo e(Form::label('email', 'Email', 'class="control-label"')); ?>

                            <?php echo e(Form::text('email', null,  ["class" => 'form-control', 'rows'=> '5'])); ?>

                        </div>

                </div>

                <div class="col-md-5">

                    <div class= "well" id="logo_well" style="width:50%; margin-top: 24px">
                        <a class="fancybox" href="/images/logos/<?php echo e(isset($group->logo) ? $group->logo : 'bislogo.gif'); ?>" id="fancyboximage">
                            <img src="/images/logos/<?php echo e(isset($group->logo) ? $group->logo : 'notfound.png'); ?>" id="imagepreview"    class="img-responsive">
                        </a>
                    </div>
                    <div>
                        
                        <?php echo e(Form::file('image', ['id' => 'image', 'onchange' => 'readURL(this);'])); ?>

                    </div> 
                </div>
                <br>
                <div class="form-group">
                    <div class="col-md-12" style="margin:15px">
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </div>

            <?php echo Form::close(); ?>


        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    
    <script type="text/javascript" src="/js/jquery.fancybox.js"></script>

    <script type="text/javascript">

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var new_img = e.target.result;
                    $('#imagepreview').attr('src', new_img);
                    $("#fancyboximage").prop("href", new_img);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


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