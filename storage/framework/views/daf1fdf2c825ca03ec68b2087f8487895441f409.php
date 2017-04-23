<?php $__env->startSection('title', 'Productie'); ?>

<?php $__env->startSection('css'); ?>
    
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">-->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <div class="row">
        <div id="newbrouwselerror" class="alert alert-warning text-center" role="alert" style="display:none">
            << Error message for grondstoffentekort here... >>
        </div>
    </div><!-- div class row-->

    <div class = 'row'>
        <div class="col-md-10 col-md-offset-1">

            <table id="brouwtable" class="table table-responsive table-striped table-hover">
                <thead>
                <tr>
                    <th>Datum</th>
                    <th class="text-right">Aant</th>
                    <th>Product</th>
                    <th class="hidden-xs hidden-sm">Opmerking</th>
                    <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>Nieuw</button></th>
                </tr>
                </thead>
                 
                <tbody id="brouwselbody">
                    <?php $__currentLoopData = $brouwsels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brouwsel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="brouwselid<?php echo e($brouwsel->id); ?>">
                            <td data-order="<?php echo e(strtotime($brouwsel->datum)); ?>"><?php echo e(date('d-m-Y', strtotime($brouwsel->datum))); ?></td>
                            <td class="text-right"><?php echo e($brouwsel->liters); ?></td>
                            <td><?php echo e($brouwsel->beersort->code); ?> <?php echo e($brouwsel->beersort->omschrijving); ?></td>
                            <td title="<?php echo e($brouwsel->opmerking); ?>" class="hidden-xs hidden-sm"><?php echo e(str_limit($brouwsel->opmerking, $limit = 30, $end = '...')); ?></td>
                            <td align="right">
                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="<?php echo e($brouwsel->id); ?>"><span class="glyphicon glyphicon-edit"></span>Bewerk</button> 
                                        <button class="btn btn-danger btn-xs btn-delete delete-brouwsel but-spacing" value="<?php echo e($brouwsel->id); ?>"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>
    </div><!-- div class row-->



    <!-- modal form for editing and adding -->
    <div class="modal fade bd-example-modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk productie</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <div class="row"> 
                    <?php echo Form::model($brouwsels, ['data-parsley-validate' => '', 'id'=>'frmBrouwsels', 'files' => false]); ?>

                        
                        <?php echo e(csrf_field()); ?>


                        <input type="hidden" id="brouwsel_id" name="brouwsel_id" value="0">
                        
                        <div class="col col-md-3 col-xs-5">
                            <div class="form-group error">                            
                                <?php echo e(Form::label('datum', 'Datum:', 'class="control-label"')); ?>

                                <?php echo e(Form::text('datum', null, ["id" => "datepicker", "class" => 'form-control', 'required' => ''])); ?>

                            </div>
                        </div>

                        <div class="col col-md-3 col-xs-5">
                            <div class="form-group">
                                <?php echo e(Form::label('liters', 'Hoeveelheid:', 'class="control-label"')); ?>

                                <?php echo e(Form::text('liters', null,  ["class" => 'form-control', 'required' => ''])); ?>

                            </div>
                        </div>

                        <div class="col col-md-6 col-xs-10">
                            <div class="form-group">
                                <?php echo e(Form::label('biersoort_id', 'Product:', 'class="control-label"')); ?> 
                                <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Alleen producten waarvan een recept beschikbaar is worden weergegeven in deze lijst"></span>
                                <?php echo e(Form::select('biersoort_id', $beersrtn, null, ['class' => 'form-control', 'required' => ''])); ?>

                            </div>
                        </div>

                        <div class="col col-md-12 col-xs-10">
                            <div class="form-group">
                                <?php echo e(Form::label('opmerking', 'Opmerking:', 'class="control-label"')); ?>

                                <?php echo e(Form::textarea('opmerking', null,  ["class" => 'form-control',  'rows'=>'4' ,'required' => ''])); ?>

                            </div>
                        </div>
                    <?php echo Form::close(); ?>

                    </div>
                </div><!-- modal body -->
                
                <div class="modal-footer">
                    <div class="col col-md-12">
                    <button type="button" class="btn btn-primary" id="btn-cancel">Cancel</button>
                    <button type="button" class="btn btn-primary" id="btn-save" value="add">Opslaan</button>
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

        $(document).ready(function(){

            $('[data-toggle="tooltip"]').tooltip(); 
            
            //Datepicker init
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                language: 'nl',
                weekStart: '1'
            });

            $('#newbrouwselerror').hide();

            $('#brouwtable').DataTable({
                "responsive": true,
                "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Alle"]],
                "pageLength": -1, //Default All
                "bPaginate": false,
                "order": [[ 0, "desc" ]],
                "searching": false,
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
                        orderable: false
                    }, {
                        targets: [ 2 ],
                        orderable: true
                    }, {
                        targets: [ 3 ],
                        orderable: false
                    },{
                        targets: [ 4 ],
                        orderable: false                        
                    } 
                ],
            });

            var url = "/productie";

            //Cancel button
            $('#btn-cancel').click(function(){
                $('#myModal').modal('hide');
            });

            $('#brouwtable').on('click','.open-modal', function(){
                var brouwsel_id = $(this).val();
                $.get(url + '/' + brouwsel_id, function (data) {
                    //success data
                    console.log(brouwsel_id);
                    console.log(data);
                    $('#myModalLabel').text("Bewerk productie");
                    $('#brouwsel_id').val(data.id);
                    $('#datepicker').datepicker('update', data.datum);
                    $('#liters').val(data.liters);
                    $('#biersoort_id').val(data.biersoort_id);
                    $('#opmerking').val(data.opmerking);
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                }) 
            });

            //Create new biersoort / update existing biersoort
            $("#btn-save").click(function (e) {
                e.preventDefault();

                $('#ajaxloader').show();

                var formData = {
                    datum: $('#datepicker').val(),
                    liters: $('#liters').val(),
                    opmerking: $("#opmerking").val(),
                    biersoort_id: $('#biersoort_id').val(),
                };
                
                //determine the http action [add=POST], [update=PUT]
                var state = $('#btn-save').val();
                var type = "POST"; //for creating new resource
                var brouwsel_id = $('#brouwsel_id').val();
                var my_url = url;

                if (state == "update"){
                    type = "PUT"; //for updating existing resource
                    my_url = my_url + '/' + brouwsel_id;
                }

                $.ajax({
                    type: type,
                    url: my_url,
                    headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                    data: formData,
                    dataType: 'json',
                    success: function (data) {

                        if(data.message == 'ERROR'){
                            $('#newbrouwselerror').html("<strong>Waarschuwing grondstof tekort:</strong><br><strong>NIEUWE PRODUCTIE NIET OPGESLAGEN.</strong><br><br>Er is onvoldoende voorraad grondstoffen voor " + $('#liters').val() + ' ' + $("#biersoort_id :selected").text() + ".<br><br>Dit wordt veroorzaakt door een tekort aan de onderstaande grondstoffen:" + data.details);
                            $('#newbrouwselerror').show();
                        }

                        if(data.message != 'ERROR'){
                                var brouwselrow = '<tr brouwselid="' + data.id + '">';
                                brouwselrow += '<td>' + data.datum + '</td>';
                                brouwselrow += '<td class="text-right">' + data.liters + '</td>';
                                brouwselrow += '<td>' + $('#biersoort_id').find('option:selected').text() + '</td>'
                                brouwselrow += '<td>' + data.opmerking + '</td>';
                                brouwselrow += '<td class="text-right">';
                                brouwselrow += '    <div class="input-group">';
                                brouwselrow += '        <div class="input-group-btn">';
                                brouwselrow += '            <button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="'+data.id+'"><span class="glyphicon glyphicon-edit"></span>Bewerk</button>';
                                brouwselrow += '            <button class="btn btn-danger btn-xs btn-delete but-spacing delete-brouwsel" value="'+data.id+'"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>';
                                brouwselrow += '        </div>';
                                brouwselrow += '    </div>';
                                brouwselrow += '</td>';
                                brouwselrow += '</tr>';

                                if (state == "add"){ //if user added a new record
                                    $('#brouwselbody').prepend(brouwselrow);
                                }else{ //if user updated an existing record
                                    $("#brouwselid" + data.id).replaceWith(brouwselrow);
                                }
                        }

                        $('#myModal').modal('hide');

                    },
                    error: function (data) {
                        console.log('Error in PUT (brouwsel):', data);
                    }
                });
            });

            //display modal form for creating new biersoort
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#myModalLabel').text("Nieuwe productie");
                $('#datum').val("");
                $('#datepicker').val("");
                $('#biersoort_id').val("");
                $('#liters').val("");
                $('#opmerking').val("");
                $('#myModal').modal('show');
            });


            //delete biersoort and remove from table
            $('#brouwtable').on('click','.delete-brouwsel', function(){

                var brouwsel_id = $(this).val();
                
                swal({
                  title: 'Productie verwijderen?',
                  text: "Weet u het zeker? Deze aktie kan niet ongedaan worden gemaakt!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Verwijder'
                }).then(function () {
                    //Delete brouwsel
                    $.ajax({
                        type: "DELETE",
                        url: url + '/' + brouwsel_id,
                        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                        success: function (data) {
                            //remove row from table
                            $("#brouwselid" + brouwsel_id).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                })
                .catch(swal.noop)
            });            

        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>