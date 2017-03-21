<?php $__env->startSection('title', 'Inkoop grondstoffen'); ?>

<?php $__env->startSection('css'); ?>
    
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <div class = 'row'>
        <div class="col-md-9 col-md-offset-1">

            <table class="table table-striped table-hover" id="inkooptabel">
                <thead>
                <tr>
                    <th>Datum</th>
                    <th>Grondstof</th>
                    <th class="text-right">Hoeveelheid (kg)</th>
                    <th class="text-right">Prijs (&euro;/kg)</th>
                    <th class="text-left" colspan = "2">Verbruikt (kg)</th>
                    
                    <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>Nieuw</button></th>
                    
                 </tr>
                 </thead>
                 
                 <tbody id="grondstofsoortbody">
                    <?php $__currentLoopData = $inkoopgrondstoffen; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inkoopgrondstof): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="inkoop<?php echo e($inkoopgrondstof->id); ?>" title="grondstof id <?php echo e($inkoopgrondstof->grondstof->id); ?>-<?php echo e($inkoopgrondstof->grondstof->naam); ?>">
                            <td><?php echo e($inkoopgrondstof->datum); ?></td>
                            <td ><?php echo e($inkoopgrondstof->grondstof->naam); ?></td>
                            <td class="text-right"><?php echo e($inkoopgrondstof->hoeveelheidkg); ?></td>
                            <td class="text-right">&euro;<?php echo e($inkoopgrondstof->prijsexbtw); ?></td>
                            <td class="text-right">
                                <div><?php echo e($inkoopgrondstof->verbruiktkg); ?></div>
                            </td>
                            <td width = "66px">
                                <div id='verbruiktotaal' title="Totaal ingekocht <?php echo e($inkoopgrondstof->hoeveelheidkg); ?> kg" style="position:absolute; width:55px;height:10px;margin-top:5px;background-color: green;"></div>
                                <div id='verbruik' title="Verbruikt <?php echo e($inkoopgrondstof->verbruiktkg); ?> kg" style="position:absolute; width: <?php echo e((55 - ($inkoopgrondstof->hoeveelheidkg - $inkoopgrondstof->verbruiktkg) / $inkoopgrondstof->hoeveelheidkg * 55)); ?>px;height: 10px;margin-top:5px;background-color: red;"></div>
                            </td>
                            <td align="right">
                                <div class="input-group">                    
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="<?php echo e($inkoopgrondstof->id); ?>"><span class="glyphicon glyphicon-edit"></span>Bewerk</button> 
                                        <button class="btn btn-danger btn-xs btn-delete delete-inkoop but-spacing" value="<?php echo e($inkoopgrondstof->id); ?>"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div> <!-- div class row-->
    


    <!-- modal form for editing and adding -->
    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div id="ajaxloader">
                    <img src= 'images/ajax-loader.gif'>
                    <div>Inkoop opslaan</div>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk Inkoop</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                <div class="row">
                    <?php echo Form::model($grondstoffen, ['data-parsley-validate' => '', 'id'=>'uploadForm', 'files' => false]); ?>    
                        
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group">
                            <input type="hidden" id="inkoop_id" name="inkoop_id" value="0"/>
                        </div>

                        <div class="col col-md-6">
                        <div class="form-group error">
                            <?php echo e(Form::label('datum', 'Datum:', 'class="control-label"')); ?>

                            <?php echo e(Form::text('datum', null, ["id" => "datepicker", "class" => 'form-control', 'required' => '', 'maxlength' => '3', ])); ?>

                        </div>
                        </div>

                        <div class="col col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('grondstof_id', 'Grondstof:', 'class="control-label"')); ?> 
                            <?php echo e(Form::select('grondstof_id', $grondstof_dropdown, null, ['class' => 'form-control', 'required' => ''])); ?>

                        </div>
                        </div>

                        <div class="col col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('hoeveelheidkg', 'Hoeveelheid (kg):', 'class="control-label"')); ?>

                            <?php echo e(Form::text('hoeveelheidkg', null,  ["class" => 'form-control', 'required' => ''])); ?>

                        </div>
                        </div>

                        <div class="col col-md-6">
                        <div class="form-group">
                            <?php echo e(Form::label('prijsexbtw', 'Prijs/kg ex. BTW:', 'class="control-label"')); ?>

                            <?php echo e(Form::text('prijsexbtw', null,  ["class" => 'form-control', 'required' => ''])); ?>

                        </div>
                        </div>
                    
                    <?php echo Form::close(); ?>

                </div>
                </div><!-- modal body -->
                
                <div class="modal-footer">
                    <div class="col col-md-12">
                        <button type="button" class="btn btn-primary" id="btn-cancel">Cancel</button>
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Save</button>
                    </div>
                </div><!-- modal footer -->

                
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

    <script src="../js/bootstrap-datepicker.js"></script>
    <script src="../js/locales/bootstrap-datepicker.nl.js"></script>

    <script type="text/javascript">

        //Datepicker init
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            language: 'nl',
            weekStart: '1'
        });
        

        $(document).ready(function(){

            var url = "/inkoop";

            //Cancel button
            $('#btn-cancel').click(function(){
                $('#myModal').modal('hide');
            });

            
            //display modal form for biersoort editing
            $('#inkooptabel').on('click','.open-modal', function(){
                var inkoop_id = $(this).val();
                $.get(url + '/' + inkoop_id, function (data) {
                    //success data
                    console.log(data);
                    $('#myModalLabel').text("Bewerk inkoop");
                    $('#inkoop_id').val(data.id)
                    $('#datum').val(data.datum);
                    $('#datepicker').val(data.datum);
                    // $('#datepicker').setDate(data.datum);
                    $('#grondstof_id').val(data.grondstof_id);
                    $('#hoeveelheidkg').val(data.hoeveelheidkg);
                    $('#prijsexbtw').val(data.prijsexbtw);
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                }) 
            });

            //delete biersoort and remove from table
            $('#inkooptabel').on('click','.btn-delete', function(){

                var inkoop_id = $(this).val();
                
                swal({
                  title: 'Inkoop verwijderen?',
                  text: "Weet u het zeker? Deze aktie kan niet ongedaan worden gemaakt!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Verwijder'
                }).then(function () {
                    //Delete biersoort
                    $.ajax({
                        type: "DELETE",
                        url: url + '/' + inkoop_id,
                        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                        success: function (data) {
                            //remove row from table
                            $("#inkoop" + inkoop_id).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                })
                .catch(swal.noop)
            });

            //display modal form for creating new biersoort
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#myModalLabel').text("Nieuwe inkoop grondstof");
                // $('#datum').val("");
                $('#datepicker').val("");
                $('#grondstof_id').val("");
                $('#hoeveelheidkg').val("");
                $('#prijsexbtw').val("");
                $('#myModal').modal('show');
            });

            //create new biersoort / update existing biersoort
            // $("#btn-save").click(function (e) {
            $('#myModal').on('click','#btn-save', function(e){
                
                e.preventDefault();
                
                $('#ajaxloader').show();
                
                var formData = {
                    datum: $('#datepicker').val(),
                    grondstof_id: $('#grondstof_id').val(),
                    hoeveelheidkg: $("#hoeveelheidkg").val(),
                    prijsexbtw: $('#prijsexbtw').val(),
                };

                console.log(formData);

                //determine the http action [add=POST], [update=PUT]
                var state = $('#btn-save').val();
                var type = "POST"; //for creating new resource
                var inkoop_id = $('#inkoop_id').val();
                var my_url = url;

                if (state == "update"){
                    type = "PUT"; //for updating 
                    my_url = my_url + '/' + inkoop_id;
                }
                
                $.ajax({
                    type: type,
                    url: my_url,
                    headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                    data: formData,
                    dataType: 'json',
                    success: function (data) {

                        console.log('AJAX call success: data=>>>');
                        console.log(data);

                        var inkooprow = '<tr biersoortid="' + data.id + '">';
                        inkooprow += '<td>' + data.datum + '</td>';
                        inkooprow += '<td>' + $('#grondstof_id').find('option:selected').text() + '</td>'
                        inkooprow += '<td class="text-right">' + data.hoeveelheidkg + '</td>';
                        inkooprow += '<td class="text-right">&euro;' + data.prijsexbtw + '</td>';
                        inkooprow += '<td class="text-right">0</td>';
                        inkooprow += '<td class="text-right"><div style="position:absolute; width:44px;height:10px;margin-top:5px;background-color: green;"></div></td>';
                        inkooprow += '<td class="text-right">';
                        inkooprow += '<button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-edit"></span>Bewerk</button>';
                        inkooprow += '<button class="btn btn-danger btn-xs btn-delete delete-inkoop but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-remove"></span>Delete</button>';
                        inkooprow += '</td>';
                        inkooprow += '</tr>';

                        if (state == "add"){ //if user added a new record
                            $('#grondstofsoortbody').prepend(inkooprow);
                        }else{ //if user updated an existing record
                            $("#inkoop" + data.id).replaceWith(inkooprow);
                        }
                        
                        $('#myModal').modal('hide');

                    },
                    error: function (data) {
                        console.log('Error in postPOST/PUT (biersoort):', data);
                    }
                });

                $('#ajaxloader').hide();
            });

        });

    </script>

    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>