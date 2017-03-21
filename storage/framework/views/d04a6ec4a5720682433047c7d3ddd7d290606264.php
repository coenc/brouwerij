<?php $__env->startSection('css'); ?>
    <style>
        #loginstatus{
            /*visibility: hidden;*/
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php $__env->startSection('title', 'Home'); ?>

<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-primary">
                
                <div class="panel-heading"><h4>Brouwerij Informatie Systeem v.<?php echo e($appversion); ?></h4></div>
                
                <div class="panel-body">
                    <div class="col-md-6" style="margin-bottom: 30px"> 
                        <div class="row">Laravel Framework v.<?php echo App::Version(); ?></div>
                        <div class="row">PHP v.<?php echo e($phpversion); ?></div>
                        <div class="row">(c) 2017 Coen Coppoolse</div>
                        <div class="row"><a href='mailto: <?php echo e($email); ?>'><?php echo e($email); ?></a></div>
                    </div>

                    <div class="col-md-12"> 
                        <button id="about_button" type="button" class="btn btn-primary btn-block">About this webapplication</button>
                    </div>


                </div>

                <hr>
                
                <div id="loginstatus" class="row text-center">
                    U bent <?php echo (Auth::check() ? 'ingelogd. <a href="/auth/logout" id="logoutlink">Logout</a>' : 'uitgelogd. <a href="#" id="loginlink">Login</a>'); ?>

                </div>
                <div class="row">
                    <?php if(Auth::check()): ?>
                        <div class="col-md-5 col-xs-6 col-sm-4" id="logo_row"> 
                            <div class="well" id="logo_well">
                                <div class="text-center"><sup><?php echo e($groupname); ?></sup></div>
                                <img id="group_logo" class="img-responsive" src="/images/<?php echo e($grouplogo); ?>"/>
                            </div>

                        </div>
                    <?php endif; ?>
                </div>

                <hr>

            </div>
        </div>
    </div>

    <!-- modal form for login -->
    <?php if(!Auth::check()): ?>
    <div class="modal fade bd-example-modal-lg" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Inloggen</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <div class="panel-body">

                            <?php echo e(csrf_field()); ?>


                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                <label for="email" class="col-md-4 control-label">E-mail adres</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                <label for="password" class="col-md-4 control-label">Wachtwoord</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Onthoud mij op deze computer
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col col-md-12">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        
                            <div class="col-md-4 ">
                                <a class="btn btn-link" href="<?php echo e(url('/password/reset')); ?>">
                                    Wachtwoord vergeten?
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-link" href="<?php echo e(url('/auth/register')); ?>">
                                    Registreren
                                </a>
                            </div>
                        </div>
                    </div><!-- modal footer -->
                </form>
            </div>
        </div>
    </div> <!-- end modal loginform -->
    <?php endif; ?>



    <!-- modal form About -->
    <div class="modal fade bd-example-modal-lg" id="modalAbout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h3 class="modal-title" id="myModalLabel">About this webapplication</h3>
                </div><!-- modal header -->

                <div class="modal-body">
                    <div class="row">
                        <div class="col col-md-12">
                            <?php echo $__env->make('about_this_webapplication', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </div>
                </div><!-- end modal body -->
                
                <div class="modal-footer">
                    <div class="col col-md-12">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div><!-- modal footer -->

            </div><!-- end modal content -->
        </div><!-- end modal dialog -->
    </div><!-- end modal form -->


</div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

    <script type="text/javascript">

        $("#loginlink").click(function (e) {
            $('#modalLogin').modal('show');
        });

        $("#about_button").click(function (e) {
            $('#modalAbout').modal('show');
        });

        // $("#closeAbout").click(function (e) {
        //     $('#modalAbout').modal('hide');
        // });

        
        $(document).ready(function(){

            $('#modalLogin').modal('show');
            
            //$("#toongebruikers").click(function(){
            $(document).on('click', '#toongebruikers', function() {
                
                if($("#toongebruikers").val = 1){
                    $("#gebruikers").show();
                    $("#toongebruikers").val(0);
                    $("#toongebruikers").html('Verberg gebruikers');
                }
                if($("#toongebruikers").val = 0){
                    $("#gebruikers").hide();
                    $("#toongebruikers").val(1);
                    $("#toongebruikers").html('Toon gebruikers');                    
                }
            });

        });


    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>