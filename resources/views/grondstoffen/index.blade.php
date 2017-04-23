@extends('main')

@section('title', 'Grondstoffen')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class = 'row'>
        <div class="col-md-8 col-md-offset-1">

            <table id="grondstoftable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Grondstof</th>
                        <th>Categorie</th>
                        <th class="text-right">
                            <button id="btn-add" name="btn-add" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-plus"></span>Nieuw
                            </button>
                        </th>
                     </tr>
                 </thead>
                 
                 <tbody id="tablebody">
                    @foreach($grondstoffen as $grondstof)
                        <tr id="grondstof{{ $grondstof->id }}">
                            <td>{{ $grondstof->naam or ''}}</td>
                            <td>{{ $grondstof->grondstofcategorie->omschrijving or ''}}</td>
                            <td align="right">
                                <div class="input-group">                    
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="{{$grondstof->id}}"><span class="glyphicon glyphicon-edit"></span>Bewerk</button> 
                                        <button class="btn btn-danger btn-xs btn-delete delete-grondstof but-spacing" value="{{$grondstof->id}}"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>
                                    </div>
                                </div>
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- modal form for editing and adding -->
    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">

            <div class="modal-content">

                <div id="ajaxloader">
                    <img src= '/images/ajax-loader.gif'>
                    <div>Grondstof opslaan</div>
                </div>

                {!! Form::model($grondstoffen, ['files' => false, 'data-parsley-validate' => '', 'id'=>'uploadForm'])  !!}   

                    {{ csrf_field() }}

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">Bewerk grondstof</h4>
                    </div><!-- modal header -->
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col col-md-12"> 
                                <div class="form-group">
                                    <input type="hidden" id="grondstof_id" name="grondstof_id" value="0"/>
                                </div>
                                <div class="form-group error">
                                    {{ Form::label('naam', 'Grondstof:', 'class="control-label"') }}
                                    {{ Form::text('naam', null, ["class" => 'form-control', 'required' => '' ]) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('grondstofcategorie_id', 'Categorie:', 'class="control-label"') }}
                                    {{ Form::select('grondstofcategorie_id', $grondstofcat_dropdown, null, ['class' => 'form-control', 'required' => '']) }}
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

                {!! Form::close() !!}

            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal -->

    
@endsection

@section('scripts')

    <script type="text/javascript">

        $(document).ready(function(){

            $('#grondstoftable').DataTable({
                "responsive": true,
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Alle"]],
                "pageLength": -1, //Default All
                "searching": true,
                "processing": true,
                "language": {
                    "url": "/js/datatables_lang/datatables_lang_dut.json"
                },
                columnDefs: [ 
                    {
                        targets: [ 0 ],
                        orderData: [ 0, 1 ]
                    }, {
                        targets: [ 1 ],
                        orderData: [ 1, 0 ]
                    }, {
                        targets: [ 2 ],
                        orderable: false
                    } 
                ],
            });

            var url = "/grondstof";

            //Cancel button
            $('#btn-cancel').click(function(){
                $('#myModal').modal('hide');
            });
            
            //display modal form for biersoort editing
            $('#grondstoftable').on('click','.open-modal', function(){
                var grondstof_id = $(this).val();
                $.get(url + '/' + grondstof_id, function (data) {
                    //success data
                    console.log(data);
                    $('#myModalLabel').text("Bewerk grondstof");
                    $('#grondstof_id').val(data.id);
                    $('#naam').val(data.naam);
                    $('#grondstofcategorie_id').val(data.grondstofcategorie_id);
                    $('#btn-save').val("update");   
                    $('#myModal').modal('show');
                }) 
            });

            //delete biersoort and remove from table
            $('#grondstoftable').on('click','.delete-grondstof', function(){

                var grondstof_id = $(this).val();
                
                swal({
                  title: 'Grondstof verwijderen?',
                  html: "Deze aktie kan niet ongedaan worden gemaakt!<br/><br/>Weet u het zeker?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Verwijder'
                }).then(function () {
                    //AJAX call to delete grondstof
                    $.ajax({
                        type: "DELETE",
                        url: url + '/' + grondstof_id,
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success: function (data) {
                            //remove row from table
                            $("#grondstof" + grondstof_id).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                })
                .catch(swal.noop)
            });

            //display modal form for creating new grondstof
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#myModalLabel').text("Nieuwe grondstof");
                $('#naam').val("");
                $('#grondstofcategorie_id').val("");
                $('#myModal').modal('show');
            });

            //create new grondstof / update existing grondstof
            $('#myModal').on('click','#btn-save', function(e){
                
                e.preventDefault();

                $('#ajaxloader').show();

                // var form = document.forms.namedItem('uploadForm');
                // var formdata = new FormData(form);
                // console.log(formdata);
                // for (var [key, value] of formdata.entries()) { 
                //     console.log(key, value);
                // }

                var formData = {
                    naam: $('#naam').val(),
                    grondstofcategorie_id: $('#grondstofcategorie_id').val(),
                }

                console.info(formData);

                //determine the http action [add=POST], [update=PUT]
                var state = $('#btn-save').val();
                var type = "POST"; //for creating new resource
                var grondstof_id = $('#grondstof_id').val();
                var my_url = url;

                if (state == "update"){
                    type = "PUT"; //for updating existing resource
                    my_url = my_url + '/' + grondstof_id;
                }

                $.ajax({
                    type: type,
                    url: my_url,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: formData,
                    dataType: 'json',
                    // cache: false,
                    // processData: false,
                    // contentType: false,
                    success: function (data) {
                        var table_row = '<tr grondstofid="' + data.id + '">';
                        table_row += '<td>' + data.naam + '</td>';
                        table_row += '<td>' + $('#grondstofcategorie_id').find('option:selected').text() + '</td>'
                        table_row += '<td align="right">';
                        table_row += '<button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '"><span class="glyphicon glyphicon-edit"></span>Bewerk</button>';
                        table_row += '<button class="btn btn-danger btn-xs btn-delete delete-grondstof" value="' + data.id + '"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>';
                        table_row += '</td>';
                        table_row += '</tr>';

                        if (state == "add"){ //if user added a new record
                            $('#tablebody').prepend(table_row);
                        }else{ //if user updated an existing record
                            $("#grondstof" + data.id).replaceWith(table_row);
                        }

                        $('#ajaxloader').hide();
                        $('#myModal').modal('hide');

                    },
                    error: function (data) {
                        console.log('Error in postPOST/PUT (grondstof):', data);
                         $('#ajaxloader').hide();
                    }
                });
            });

        });

    </script>

@endsection