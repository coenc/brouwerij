@extends('main')

@section('title', 'Grondstofcategorieën')

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class = 'row'>
        <div class="col-md-4 col-md-offset-1">

            <table class="table table-striped table-hover" id="grondstofcattable">
                
                <thead>
                    <tr>
                        <th>Categorie</th>
                        <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>Nieuw</button></th>
                    </tr>
                </thead>
                 
                <tbody id="grondstofcatbody">
                    @foreach($grondstofcats as $grondstofcat)
                        <tr id="grondstofcat{{$grondstofcat->id}}">
                            <td>{{ $grondstofcat->omschrijving }}</td>
                            <td align="right">
                                <div class="input-group">                    
                                    <div class="input-group-btn">
                                        <a href= '/grondstoffen/cat/{{ $grondstofcat->id }}' title="Toon grondstoffen uit categorie" class="btn btn-info btn-xs but-spacing" role="button"><span class="glyphicon glyphicon-list"></span></a>
                                        <button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="{{$grondstofcat->id}}"><span class="glyphicon glyphicon-edit"></span>Bewerk</button> 
                                        <button class="btn btn-danger btn-xs btn-delete delete-grondstofcat but-spacing" value="{{$grondstofcat->id}}"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>
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
                {!! Form::model($grondstofcats, ['data-parsley-validate' => '', 'id'=>'uploadForm', 'files' => true])  !!}
                <div id="ajaxloader">
                    <img src= '/images/ajax-loader.gif'>
                    <div>grondstofcategorie opslaan</div>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk grondstofcategorie</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-md-12">
                            <div class="form-group">
                                <input type="hidden" id="grondstofcategorie_id" name="grondstofcategorie_id" value="0"/>
                            </div>
                            <div class="form-group">
                                {{ Form::label('omschrijving', 'Omschrijving:', 'class="control-label"') }}
                                {{ Form::text('omschrijving', null,  ["class" => 'form-control', 'required' => '']) }}
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

            var url = "/grondstofcategorie";

            //Cancel button
            $('#btn-cancel').click(function(){
                $('#myModal').modal('hide');
            });

            //display modal form for creating new biersoort
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#myModalLabel').text("Nieuwe grondstofcategorie");
                $('#omschrijving').val("");
                $('#ajaxloader').hide();
                $('#myModal').modal('show');
            });

            //display modal form for grondstofcategorie editing
            $('#grondstofcattable').on('click','.open-modal', function(){
                var grondstofcat_id = $(this).val();
                $.get(url + '/' + grondstofcat_id, function (data) {
                    //success data
                    console.log(data);
                    $('#myModalLabel').text("Bewerk grondstofcategorie");
                    $('#grondstofcategorie_id').val(data.id);
                    $('#omschrijving').val(data.omschrijving);
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                }) 
            });

            //create new biersoort / update existing grondstofcategorie
            
            $('#myModal').on('click','#btn-save', function(e){
                
                e.preventDefault();

                $('#ajaxloader').show();

                // var form = document.forms.namedItem('uploadForm');
                // var formdata = new FormData(form);

                var formData = {
                    omschrijving: $('#omschrijving').val(),
                };

                //determine the http action [add=POST], [update=PUT]
                var state = $('#btn-save').val();
                var type = "POST"; //for creating new resource
                var grondstofcat_id = $('#grondstofcategorie_id').val();
                var my_url = url;

                if (state == "update"){
                    type = "PUT"; //for updating existing resource
                    my_url = my_url + '/' + grondstofcat_id;
                }

                $.ajax({
                    type: type,
                    url: my_url,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: formData,
                    dataType: 'json',
                    success: function (data) {
                        var grondstofcatrow = '<tr grondstofcatid="' + data.id + '">';
                        grondstofcatrow += '<td>' + data.omschrijving + '</td>';
                        grondstofcatrow += '<td class="text-right">';
                        grondstofcatrow += '<button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '"><span class="glyphicon glyphicon-edit"></span>Bewerk</button>';
                        grondstofcatrow += '<button class="btn btn-danger btn-xs btn-delete delete-grondstofcat" value="' + data.id + '"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>';
                        grondstofcatrow += '</td>';
                        grondstofcatrow += '</tr>';

                        if (state == "add"){ //if user added a new record
                            $('#grondstofcatbody').prepend(grondstofcatrow);
                        }else{ //if user updated an existing record
                            $("#grondstofcat" + data.id).replaceWith(grondstofcatrow);
                        }

                        $('#ajaxloader').hide();
                        $('#myModal').modal('hide');

                    },
                    error: function (data) {
                        console.log('Error in POST/PUT (grondstofcategorie):');
                        $('#ajaxloader').hide();
                    }
                });
            });


            //Delete grondstofcategorie and remove from table
            $('#grondstofcattable').on('click','.delete-grondstofcat', function(){

                var grondstofcat_id = $(this).val();
                
                swal({
                  title: 'Grondstofcategorie verwijderen?',
                  html: "Deze aktie kan niet ongedaan worden gemaakt!<br />Grondstoffen uit deze categorie worden ook verwijderd<br/><br/>Weet u het zeker?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Verwijder'
                }).then(function () {
                    //Delete grondstofcategorie
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: "DELETE",
                        url: url + '/' + grondstofcat_id,
                        success: function (data) {
                            //remove row from table
                            $("#grondstofcat" + grondstofcat_id).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                })
                .catch(swal.noop)
            });




            $('#grondstofcattable').DataTable({
                "responsive": true,
                // "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Alle"]],
                // "pageLength": -1, //Default All
                "bPaginate": false,
                "searching": false,
                "info":     false,
                "processing": true,
                "order": [[ 0, 'asc' ]],
                "language": {
                    "url": "/js/datatables_lang/datatables_lang_dut.json"
                },
                columnDefs: [ 
                    {
                        targets: [ 0 ],
                        orderData: [ 0 ],
                        orderable: true
                    },{
                        targets: [ 1 ],
                        orderData: [ 0 ],
                        orderable: false
                    }
                ],
            });

        });

    </script>

@endsection
