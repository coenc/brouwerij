<?php $__env->startSection('title', 'Bieren'); ?>

<?php $__env->startSection('content'); ?>

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <div class = 'row'>
        <div class="col-md-6 col-md-offset-1">

            <table id="biertabel" class="table table-striped table-hover">
            
                <thead>
                    <tr>
                        <th class="text-left">Code</th>
                        <th>Naam</th>
                        <th>Categorie</th>
                        <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>Nieuw</button></th>
                     </tr>
                 </thead>
                 
                 <tbody id="biersoortbody">
                    <?php $__currentLoopData = $biersoorten; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biersoort): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr id="biersoort<?php echo e($biersoort->id); ?>">
                            <td><?php echo e($biersoort->code); ?></td>
                            <td><?php echo e($biersoort->omschrijving); ?></td>
                            <td><?php echo e(isset($biersoort->beercategory->omschrijving) ? $biersoort->beercategory->omschrijving : ''); ?></td>
                            <!-- <td class="text-center">&euro; <?php echo e(isset($biersoort->accijnstarif->tariefperhl) ? $biersoort->accijnstarif->tariefperhl : ''); ?></td> -->
                            <td align="right">
                                <div class="input-group">                    
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning btn-xs btn-detail but-spacing open-modal" value="<?php echo e($biersoort->id); ?>"><span class="glyphicon glyphicon-edit"></span>Edit</button> 
                                        <button class="btn btn-danger btn-xs btn-delete but-spacing delete-biersoort" value="<?php echo e($biersoort->id); ?>"><span class="glyphicon glyphicon-remove"></span>Delete</button>
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
                    <div>Bier opslaan</div>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk bier</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-md-9">
                        <?php echo Form::model($biersoort, ['files' => false, 'data-parsley-validate' => '', 'id'=>'uploadForm']); ?> 

                            <?php echo e(csrf_field()); ?>

                               
                            <div class="form-group">
                                <input type="hidden" id="biersoort_id" name="biersoort_id" value="0"/>
                            </div>
                            <div class="form-group error col-md-3 col-xs-3">
                                <?php echo e(Form::label('code', 'Code:', 'class="control-label"')); ?>

                                <?php echo e(Form::text('code', null, ["class" => 'form-control', 'required' => '', 'maxlength' => '3', ])); ?>

                            </div>
                            <div class="form-group col-md-9  col-xs-9">
                                <?php echo e(Form::label('omschrijving', 'Naam:', 'class="control-label"')); ?>

                                <?php echo e(Form::text('omschrijving', null,  ["class" => 'form-control', 'required' => ''])); ?>

                            </div>
                            <div class="form-group col-md-12">
                                <?php echo e(Form::label('toelichting', 'Toelichting:', 'class="control-label"')); ?>

                                <?php echo e(Form::textarea('toelichting', null,  ["class" => 'form-control', 'rows'=> '5' ,'required' => ''])); ?>

                            </div>
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('beercategory_id', 'Categorie:', 'class="control-label"')); ?> 
                                <?php echo e(Form::select('beercategory_id', $biercategorieen, null, ['class' => 'form-control', 'required' => ''])); ?>

                            </div>
                            <div class="form-group col-md-6">
                                <?php echo e(Form::label('accijnstarif_id', 'Accijnstarief:', 'class="control-label"')); ?>

                                <?php echo e(Form::select('accijnstarif_id', $accijnstarieven, null, ['class' => 'form-control', 'required' => ''])); ?>

                            </div>
                        </div>

                        <div class="col col-md-3">
                            
                            <div>
                                <input type='file' name='image' id='image' onchange="readURL(this);" />
                                <div style="font-size: 11px">Maximaal <?php echo e($maxfilesize); ?>b</div>
                            </div>                            
                            <div class= "well">
                                <a class="fancybox" href="/images/biersoorten/<?php echo e(isset($biersoort->image) ? $biersoort->image : 'notfound.png'); ?>" id="fancyboximage">
                                    <img src="/images/biersoorten/<?php echo e(isset($biersoort->image) ? $biersoort->image : 'notfound.png'); ?>" id="imagepreview" width="100%" class="img-responsive">
                                </a>
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
    
    <script type="text/javascript">

        var url = "/bier";
        
        //Cancel button
        $('#btn-cancel').click(function(){
            $('#myModal').modal('hide');
        });


        //display modal form for biersoort editing
        $('.open-modal').click(function(){
            var biersoort_id = $(this).val();
            var image = '';
            $.get(url + '/' + biersoort_id, function (data) {
                //success data
                console.log(data);
                $('#myModalLabel').text("Bewerk bier");
                $('#code').val(data.code);
                $('#omschrijving').val(data.omschrijving);
                $('#toelichting').val(data.toelichting);
                $('#biersoort_id').val(data.id);
                $('#beercategory_id').val(data.beercategory_id);
                $('#accijnstarif_id').val(data.accijnstarif_id);
                if(data.image===null){data.image = 'notfound.png'};
                $('#image').val('');
                $("#imagepreview").attr("src", "/images/biersoorten/" + data.image);
                $("#fancyboximage").attr("href", "/images/biersoorten/" + data.image) //For Fancybox class
                $('#btn-save').val("update");
                $('#myModal').modal('show');
            }) 


        });


        //delete biersoort and remove from table
        $('.delete-biersoort').click(function(){

            var biersoort_id = $(this).val();
            
            swal({
              title: 'Biersoort verwijderen?',
              text: "Weet u het zeker? Deze aktie kan niet ongedaan worden gemaakt!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Verwijder'
            }).then(function () {
                //AJAX call to delete biersoort
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: url + '/' + biersoort_id,
                    success: function (data) {
                        //remove row from table
                        $("#biersoort" + biersoort_id).remove();
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            })
        });

        //display modal form for creating new biersoort
        $('#btn-add').click(function(){
            $('#btn-save').val("add");
            $('#myModalLabel').text("Nieuw bier");
            $('#code').val("");
            $('#omschrijving').val("");
            $('#toelichting').val("");
            $('#beercategory_id').val("");
            $('#accijnstarif_id').val("");
            $("#imagepreview").attr("src", "");
            $('#myModal').modal('show');
        });        


        //create new biersoort / update existing biersoort
        $("#btn-save").click(function (e) {
            
            e.preventDefault();

            // var form = document.forms.namedItem('uploadForm');
            var form = $('form')[0];
            var formdata = new FormData(form);
            console.log('var formdata=');
            console.log(formdata);
            for (var [key, value] of formdata.entries()) { 
              console.log(key, value);
            }
            
            $('#ajaxloader').show();

            //determine the http action [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var type = "POST"; //for creating new resource
            var biersoort_id = $('#biersoort_id').val();
            var my_url = url;

            if (state == "update"){
                type = "PUT"; //for updating existing resource
                my_url = my_url + '/' + biersoort_id;
            }
            
            // $.ajaxSetup({
            //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
            // });
            
            $.ajax({
                type: type,
                url: my_url,
                headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
                data: formdata,
                // dataType: 'json',
                // contentType: 'application/json',
                cache: false,
                processData: false,
                contentType: false,
                success: function (data) {
                    var bierrow = '<tr biersoortid="' + data.id + '">';
                    bierrow += '<td>' + data.code + '</td>';
                    bierrow += '<td>' + data.omschrijving + '</td>';
                    bierrow += '<td>' + $('#beercategory_id').find('option:selected').text() + '</td>'
                    //bierrow += '<td class="text-center">' + $('#accijnstarif_id').find('option:selected').text() + '</td>'
                    bierrow += '<td align="right">';
                    bierrow += '<button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-edit"></span>Edit</button>';
                    bierrow += '<button class="btn btn-danger btn-xs btn-delete delete-biersoort but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-remove"></span>Delete</button>';
                    bierrow += '</td>';
                    bierrow += '</tr>';

                    if (state == "add"){ //if user added a new record
                        $('#biersoortbody').append(bierrow);
                    }else{ //if user updated an existing record
                        $("#biersoort" + data.id).replaceWith(bierrow);
                    }

                    $('#ajaxloader').hide();
                    $('#myModal').modal('hide');

                },
                error: function (data) {
                    console.log('Error in postPOST/PUT (biersoort):', data);
                     $('#ajaxloader').hide();
                }
            });
        });

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
            // $('#fancyboximage').attr('href', e.target.result);

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


            $('#biertabel').DataTable({
                "responsive": true,
                // "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Alle"]],
                // "pageLength": -1, //Default All
                "bPaginate": false,
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