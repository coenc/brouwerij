<?php $__env->startSection('title', 'Productcategorieën'); ?>

<?php $__env->startSection('content'); ?>

<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php if(count($errors) > 0): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
    <?php endif; ?>

    <div class = 'row'>
        <div class="col-md-4 col-md-offset-1">

            <table id="biercattabel" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Omschrijving</th>
                        <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>Nieuw</button></th>
                     </tr>
                 </thead>
                 
                 <tbody id="biercatbody">
                    <?php $__currentLoopData = $biercats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biercat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="biercat<?php echo e($biercat->id); ?>">
                            <td><?php echo e($biercat->omschrijving); ?></td>
                            <td align="right">
                                <div class="input-group">                    
                                    <div class="input-group-btn">
                                        <a href= '/producten/cat/<?php echo e($biercat->id); ?>' title="Toon producten uit categorie" class="btn btn-info btn-xs but-spacing" role="button"><span class="glyphicon glyphicon-list"></span></a>
                                        <button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="<?php echo e($biercat->id); ?>"><span class="glyphicon glyphicon-edit"></span>Bewerk</button> 
                                        <button class="btn btn-danger btn-xs btn-delete delete-biercat but-spacing" value="<?php echo e($biercat->id); ?>"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>

            </table>
        </div>
    </div>

    <!-- modal form for editing and adding -->
    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                
                <div id="ajaxloader">
                    <div id="spinnerimage"><img src= '/images/ajax-loader.gif'></div>
                    <div class="text-center">Biercategorie opslaan</div>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk biercat</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-md-12">
                        
                            <div class="form-group">
                                <input type="hidden" id="biercat_id" name="biercat_id" value="0"/>
                            </div>
                            <div class="form-group">
                                <?php echo Form::model($biercats, ['files' => true, 'data-parsley-validate' => '', 'id'=>'uploadForm', 'files' => false]); ?>  
                                    <?php echo e(Form::label('omschrijving', 'Omschrijving:', 'class="control-label"')); ?>

                                    <?php echo e(Form::text('omschrijving', null, ['class' => 'form-control ', 'required' => ''])); ?>

                                <?php echo Form::close(); ?>

                            </div>
                        </div>
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

    <script type="text/javascript">


        $(document).ready(function(){

            $('#biercattabel').DataTable({
                "responsive": true,
                "bPaginate": false,
                "info":     false,
                "searching": false,
                "processing": true,
                "language": {
                    "url": "/js/datatables_lang/datatables_lang_dut.json"
                },
                columnDefs: [ 
                    {
                        targets: [ 0 ],
                        orderable: true
                    }, {
                        targets: [ 1 ],
                        orderable: false
                    }
                ],
            });

        });


        $(document).ready(function(){

            var url = "/biercategorie";

            //Cancel button
            $('#btn-cancel').click(function(){
                $('#myModal').modal('hide');
            });

            //display modal form for creating new biersoort
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#myModalLabel').text("Nieuwe productcategorie");
                $('#omschrijving').val("");
                $('#ajaxloader').hide();
                $('#myModal').modal('show');
            });

            //display modal form for biersoort editing
            $('#biercattabel').on('click','.open-modal', function(){
                var biercat_id = $(this).val();
                $.get(url + '/' + biercat_id, function (data) {
                    //success data
                    console.log(data);
                    $('#myModalLabel').text("Bewerk productcategorie");
                    $('#biercat_id').val(data.id);
                    $('#omschrijving').val(data.omschrijving);
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                }) 
            });


            //create new biersoort / update existing biersoort
            $('#myModal').on('click','#btn-save', function(e){

                $('#ajaxloader').show();
                
                e.preventDefault();

                // var form = document.forms.namedItem('uploadForm');
                // var formdata = new FormData(form);
                // console.log('Values from formdata::::');
                // for (var [key, value] of formdata.entries()) { 
                //   console.log(key, value);
                // }

                var formData = {
                    omschrijving: $('#omschrijving').val(),
                };

                //determine the http action [add=POST], [update=PUT]
                var state = $('#btn-save').val();
                var type = "POST"; //for creating new resource
                var biercat_id = $('#biercat_id').val();
                var my_url = url;

                if (state == "update"){
                    type = "PUT"; //for updating existing resource
                    my_url = my_url + '/' + biercat_id;
                }
                
                $.ajax({
                    type: type,
                    url: my_url,
                    headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var biercatrow = '<tr id=biercat' + data.id + '>';
                        biercatrow += '<td>' + data.omschrijving + '</td>';
                        biercatrow += '<td class="text-right">';
                        biercatrow += '<button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-edit"></span>Bewerk</button>';
                        biercatrow += '<button class="btn btn-danger btn-xs btn-delete delete-biersoort but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>';
                        biercatrow += '</td>';
                        biercatrow += '</tr>';

                        if (state == "add"){ 
                            // user added a new record
                            $('#biercatbody').prepend(biercatrow);
                        }else{ 
                            // user updated an existing record
                            document.getElementById('biercat' + data.id).innerHTML = biercatrow;
                        }

                    },
                    error: function (data) {
                        console.log('Error in POST/PUT (biercategorie):');
                        console.log(data);
                    }
                });
                
                $('#ajaxloader').hide();
                $('#myModal').modal('hide');

            });

            //Delete biercategorie and remove from htmltable
            $('#biercattabel').on('click', '.delete-biercat', function(){

                var biercat_id = $(this).val();
                
                swal({
                  title: 'Productcategorie verwijderen?',
                  html: "Deze aktie kan niet ongedaan worden gemaakt!<br/>Producten uit deze categorie worden ook verwijderd.<br/><br/>Weet u het zeker?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Verwijder'
                }).then(function () {
                    //Delete biersoort
                    $.ajax({
                        type: "DELETE",
                        url: url + '/' + biercat_id,
                        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                        success: function (data) {
                            //remove row from table
                            $("#biercat" + biercat_id).remove();
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