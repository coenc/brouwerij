@extends('main')

@section('title', 'Leveranciers')

@section('css')
	<!--  -->
@endsection

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

	<div class = 'row'>
        <div class="col-md-10 col-md-offset-1">

            <table id="leveranciertable" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>Naam</th>
                    <th>Adres</th>
                    <th>Postcode</th>
                    <th>Plaats</th>
                    <th class="hidden-xs">E-mail</th>
                    <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>Nieuw</button></th>
                 </tr>
                 </thead>
                 
                 <tbody id="leverancier_tablebody">

                    @foreach($leveranciers as $leverancier)
                        <tr id="leverancier{{$leverancier->id}}">
                            <td>{{ $leverancier->naam }}</td>
                            <td>{{ $leverancier->factuuradres }}</td>
                            <td>{{ $leverancier->factuurpostcode }}</td>
                            <td>{{ $leverancier->factuurplaats }}</td>
                            <td class="hidden-xs"><a href="mailto:{{ $leverancier->email }}">{{ $leverancier->email }}</a></td>
                            <td class="text-right">
                                <div class="input-group">                    
                                    <div class="input-group-btn">
                                        <a href="/brief?lev={{$leverancier->id}}" class="btn btn-success btn-xs but-spacing"><span class="glyphicon glyphicon-envelope"></span>Brief</a>
                                        <button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="{{$leverancier->id}}"><span class="glyphicon glyphicon-edit"></span>Bewerk</button> 
                                        <button class="btn btn-danger btn-xs btn-delete delete-leverancier but-spacing" value="{{$leverancier->id}}"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>

                                    </div>
                                </div>
                            </td>
                        </tr> 
                    @endforeach

                </tbody>
            </table>
        </div>

    </div> <!-- div class row-->
    

    <!-- modal form for editing and adding -->
    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div id="ajaxloader">
                    <img src= '/images/ajax-loader.gif'>
                    <div>Leverancier opslaan</div>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk leverancier</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-md-12">

                            {!! Form::model($leveranciers, ['files' => false, 'data-parsley-validate' => '', 'id'=>'uploadForm' ])  !!} 

                            <div class="col col-md-12">
                                <div class="form-group">
                                    <input type="hidden" id="leverancier_id" name="leverancier_id" value="0"/>
                                </div>
                                <div class="col col-md-12">
                                    <div class="form-group error">
                                        {{ Form::label('naam', 'Naam:', 'class="control-label"') }}
                                        {{ Form::text('naam', null, ["class" => 'form-control', 'required' => '' ]) }}
                                    </div>
                                </div>
                                <div class="col col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('factuuradres', 'Adres:', 'class="control-label"') }}
                                        {{ Form::text('factuuradres', null,  ["class" => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                                <div class="col col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('factuurpostcode', 'Postcode:', 'class="control-label"') }} 
                                        {{ Form::text('factuurpostcode', null, ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                                <div class="col col-md-8">
                                    <div class="form-group">
                                        {{ Form::label('factuurplaats', 'Plaats:', 'class="control-label"') }} 
                                        {{ Form::text('factuurplaats', null, ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                                
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('email', 'E-mail adres:', 'class="control-label"') }}
                                        {{ Form::text('email', null, ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('website', 'Website:', 'class="control-label"') }} 
                                        {{ Form::text('website', null, ['class' => 'form-control', 'required' => '']) }}
                                    </div>                    
                                </div>            
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('telefoon', 'Telefoon:', 'class="control-label"') }}
                                        {{ Form::text('telefoon', null,  ["class" => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('mobiel', 'Mobiel:', 'class="control-label"') }}
                                        {{ Form::text('mobiel', null,  ["class" => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('bankrekening', 'Bankrekening:', 'class="control-label"') }} 
                                        {{ Form::text('bankrekening', null, ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('banknaam', 'Banknaam:', 'class="control-label"') }}
                                        {{ Form::text('banknaam', null, ['class' => 'form-control', 'required' => '']) }}
                                    </div>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- modal body -->
                
                <div class="modal-footer">
                    <div class="col col-md-12">
                        <button type="button" class="btn btn-primary" id="btn-cancel">Annuleren</button>
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">Opslaan</button>
                    </div>
                </div><!-- modal footer -->
            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal -->

@endsection

@section('scripts')

    <script type="text/javascript">

            var url = "/leverancier";

            //Cancel button
            $('#btn-cancel').click(function(){
                $('#myModal').modal('hide');
            });


            //display modal form for biersoort editing
            $('#leveranciertable').on('click','.open-modal', function(){
                var leverancier_id = $(this).val();
                var image = '';
                $.get(url + '/' + leverancier_id, function (data) {
                    //success data
                    console.log(data);
                    $('#myModalLabel').text("Bewerk leverancier");
                    $('#leverancier_id').val(data.id);
                    $('#naam').val(data.naam);
                    $('#factuurnaam').val(data.factuurnaam);
                    $('#factuuradres').val(data.factuuradres);
                    $('#factuurpostcode').val(data.factuurpostcode);
                    $('#factuurplaats').val(data.factuurplaats);
                    $('#website').val(data.website);
                    $('#email').val(data.email);
                    $('#telefoon').val(data.telefoon);
                    $('#mobiel').val(data.mobiel);
                    $('#bankrekening').val(data.bankrekening);
                    $('#banknaam').val(data.banknaam);
                    $("#email_link").attr("href", "mailto:" + data.email );
                    $('#btn-save').val("update");
                    $('#myModal').modal('show');
                }) 
            });


            //delete biersoort and remove from table
            $('#leveranciertable').on('click','.delete-leverancier', function(){

                var leverancier_id = $(this).val();
                
                swal({
                  title: 'Leverancier verwijderen?',
                  text: "Weet u het zeker? Deze aktie kan niet ongedaan worden gemaakt!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#d33',
                  cancelButtonColor: '#3085d6',
                  confirmButtonText: 'Verwijder'
                }).then(function () {
                    //Delete leverancier
                    $.ajax({
                        type: "DELETE",
                        url: url + '/' + leverancier_id,
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        success: function (data) {
                            //remove row from table
                            $("#leverancier" + leverancier_id).remove();
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                })
                .catch(swal.noop)
            });


            //display modal form for creating new leverancier
            $('#btn-add').click(function(){
                $('#btn-save').val("add");
                $('#myModalLabel').text("Nieuwe leverancier");
                $('#naam').val("");
                $('#factuurnaam').val("");
                $('#factuuradres').val("");
                $('#factuurpostcode').val("");
                $('#factuurplaats').val("");
                $('#email').val("");
                $('#telefoon').val("");
                $('#mobiel').val("");
                $('#website').val("");
                $('#bankrekening').val("");
                $('#banknaam').val("");
                $('#myModal').modal('show');
            });

            //create new biersoort / update existing biersoort
            $("#btn-save").click(function (e) {
                
                e.preventDefault();

                // var form = document.forms.namedItem('uploadForm');
                // var formdata = new FormData(form);                
                // console.log(formdata);
                
                $('#ajaxloader').show();

                var formData = {
                    naam: $('#naam').val(),
                    factuuradres: $('#factuuradres').val(),
                    factuurpostcode: $('#factuurpostcode').val(),
                    factuurplaats: $('#factuurplaats').val(),
                    email: $('#email').val(),
                    website: $('#website').val(),
                    telefoon: $('#telefoon').val(),
                    mobiel: $('#mobiel').val(),
                    bankrekening: $('#bankrekening').val(),
                    banknaam: $('#banknaam').val(),
                };

                //determine the http action [add=POST], [update=PUT]
                var state = $('#btn-save').val();
                var type = "POST"; //for creating new resource
                var leverancier_id = $('#leverancier_id').val();
                var my_url = url;

                if (state == "update"){
                    type = "PUT"; //for updating existing resource
                    my_url = my_url + '/' + leverancier_id;
                }
               
                $.ajax({
                    type: type,
                    url: my_url,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    success: function (data) {
                        var levrow = '<tr id=leverancier' + data.id + '">';
                        levrow += '<td>' + data.naam + '</td>';
                        // levrow += '<td>' + data.tav + '</td>';
                        levrow += '<td>' + data.factuuradres + '</td>'
                        levrow += '<td>' + data.factuurpostcode + '</td>'
                        levrow += '<td>' + data.factuurplaats + '</td>'
                        levrow += '<td class="hidden-xs"><a href="mailto:' + data.email + '">' + data.email + '</a></td>'
                        levrow += '<td class="text-right">';
                        levrow += '<a href="/brief?lev=' + data.id + '" class="btn btn-success btn-xs but-spacing"><span class="glyphicon glyphicon-envelope"></span>Brief</a>';
                        levrow += '<button class="btn btn-warning btn-xs btn-detail open-modal" value="' + data.id + '"><span class="glyphicon glyphicon-edit"></span>Bewerk</button>';
                        levrow += '<button class="btn btn-danger btn-xs btn-delete delete-leverancier" value="' + data.id + '"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>';
                        levrow += '</td>';
                        levrow += '</tr>';

                        if (state == "add"){ //if user added a new record
                            $('#leverancier_tablebody').prepend(levrow);
                        }else{ //if user updated an existing record
                            $("#leverancier" + data.id).replaceWith(levrow);
                        }

                        $('#ajaxloader').hide();
                        

                    },
                    error: function (data) {
                        console.log('Error in postPOST/PUT (leverancierAJAX):', data);
                    }
                });
                $('#myModal').modal('hide');
            });

    </script>


    <script type="text/javascript">
        $(document).ready(function(){

            $('#leveranciertable').DataTable({
                "responsive": true,
                // "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Alle"]],
                // "pageLength": -1, //Default All
                "bPaginate": false,
                "searching": true,
                "info":     false,
                "processing": true,
                "order": [[ 0, 'asc' ]],
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
                        orderable: true
                    }, {
                        targets: [ 4 ],
                        orderable: true
                    }, {
                        targets: [ 5 ],
                        orderable: false
                    }
                ],
            });

        });

    </script>

    {!! Html::script('js/parsley.js') !!}

@endsection