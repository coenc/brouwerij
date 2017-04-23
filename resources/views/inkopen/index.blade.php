@extends('main')

@section('title', 'Inkoop grondstoffen')

@section('css')
    {{-- This is a single-line comment --}}
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

@endsection

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class = 'row'>
        <div class="col-md-10 col-md-offset-1">

            <table class="table table-striped table-hover" id="inkooptabel">
                <thead>
                <tr>
                    <th>Datum</th>
                    <th>Grondstof</th>
                    <th class="text-right">Prijs (&euro;/kg)</th>
                    <th class="text-right">Verbruikt (kg)</th>
                    <th></th>
                    <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>Nieuw</button></th>
                    
                 </tr>
                 </thead>
                 
                 <tbody id="grondstofsoortbody">
                    @foreach($inkoopgrondstoffen as $inkoopgrondstof)
                        <tr id="inkoop{{ $inkoopgrondstof->id }}" title="grondstof {{$inkoopgrondstof->grondstof->naam}}">
                            <td data-order="{{strtotime($inkoopgrondstof->datum)}}">{{date('d-m-Y', strtotime($inkoopgrondstof->datum))}}</td>
                            <td >{{$inkoopgrondstof->grondstof->naam}}</td>
                            <td class="text-right">&euro;{{ number_format($inkoopgrondstof->prijsexbtw, 2, ',', '.') }}</td>
                            <td data-order="{{$inkoopgrondstof->verbruiktkg}}" class="text-right">{{ number_format($inkoopgrondstof->verbruiktkg, 0, ',', '.') }}/{{ number_format($inkoopgrondstof->hoeveelheidkg, 0, ',', '.') }}</td>
                            <td width = "66px">
                                <div id='verbruiktotaal' title="Totaal ingekocht {{ number_format($inkoopgrondstof->hoeveelheidkg, 3, ',', '.') }} kg" style="position:absolute; width:55px;height:10px;margin-top:5px;background-color: green;"></div>
                                <div id='verbruik' title="Verbruikt {{ number_format($inkoopgrondstof->verbruiktkg, 3, ',', '.') }} kg" style="position:absolute; width: {{ (55 - ($inkoopgrondstof->hoeveelheidkg - $inkoopgrondstof->verbruiktkg) / $inkoopgrondstof->hoeveelheidkg * 55)}}px;height: 10px;margin-top:5px;background-color: red;"></div>
                            </td>
                            <td align="right">
                                <div class="input-group">                    
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="{{$inkoopgrondstof->id}}"><span class="glyphicon glyphicon-edit"></span><div class="buttontext">Bewerk</div></button> 
                                        <button class="btn btn-danger btn-xs btn-delete delete-inkoop but-spacing" value="{{$inkoopgrondstof->id}}"><span class="glyphicon glyphicon-remove"></span><div class="buttontext">Verwijder</div></button>
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
                    <div>Inkoop opslaan</div>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk Inkoop</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                <div class="row">
                    {!! Form::model($grondstoffen, ['data-parsley-validate' => '', 'id'=>'uploadForm', 'files' => false])  !!}    
                        
                        {{ csrf_field() }}

                        <div class="form-group">
                            <input type="hidden" id="inkoop_id" name="inkoop_id" value="0"/>
                        </div>

                        <div class="col col-md-6">
                            <div class="form-group error">
                                {{ Form::label('datum', 'Datum:', 'class="control-label"') }}
                                {{ Form::text('datum', null, ["id" => "datepicker", "class" => 'form-control', 'required' => '', 'maxlength' => '3', ]) }}
                            </div>
                        </div>

                        <div class="col col-md-6">
                        <div class="form-group">
                            {{ Form::label('grondstof_id', 'Grondstof:', 'class="control-label"') }} 
                            {{ Form::select('grondstof_id', $grondstof_dropdown, null, ['class' => 'form-control', 'required' => '']) }}
                        </div>
                        </div>

                        <div class="col col-md-6">
                        <div class="form-group">
                            {{ Form::label('hoeveelheidkg', 'Hoeveelheid (kg):', 'class="control-label"') }}
                            {{ Form::text('hoeveelheidkg', null,  ["class" => 'form-control', 'required' => '']) }}
                        </div>
                        </div>

                        <div class="col col-md-6">
                        <div class="form-group">
                            {{ Form::label('prijsexbtw', 'Prijs/kg ex. BTW:', 'class="control-label"') }}
                            {{ Form::text('prijsexbtw', null,  ["class" => 'form-control', 'required' => '']) }}
                        </div>
                        </div>
                    
                    {!! Form::close() !!}
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

@endsection


@section('scripts')

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
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
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
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    data: formData,
                    dataType: 'json',
                    success: function (data) {

                        console.log('AJAX call success: data=>>>');
                        console.log(data);

                        var inkooprow = '<tr biersoortid="' + data.id + '">';
                        inkooprow += '<td>' + data.datum + '</td>';
                        inkooprow += '<td>' + $('#grondstof_id').find('option:selected').text() + '</td>'
                        // inkooprow += '<td class="text-right">' + data.hoeveelheidkg + '</td>';
                        inkooprow += '<td class="text-right">&euro;' + data.prijsexbtw + '</td>';
                        inkooprow += '<td data-order="" class="text-right">0/' + data.hoeveelheidkg + '</td>';
                        inkooprow += '<td class="text-right"><div style="position:absolute; width:44px;height:10px;margin-top:5px;background-color: green;"></div></td>';

                        inkooprow += '<td class="text-right">';
                        inkooprow += '<button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-edit"></span>Bewerk</button>';
                        inkooprow += '<button class="btn btn-danger btn-xs btn-delete delete-inkoop but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>';
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

    <script type="text/javascript">
        $(document).ready(function(){

            $('#inkooptabel').DataTable({
                "responsive": true,
                // "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Alle"]],
                // "pageLength": -1, //Default All
                "bPaginate": false,
                "searching": true,
                "info":     false,
                "processing": true,
                "order": [[ 0, 'desc' ]],
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
                        orderable: false
                    }, {
                        targets: [ 5 ],
                        orderable: false
                    }
                ],
            });

        });

    </script>

@endsection