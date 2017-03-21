@extends('main')

@section('title', 'Producten')

@section('css')
    <!--Fancybox-->
    <link rel="stylesheet" href="/css/jquery.fancybox.css" type="text/css" media="screen" />
    <!--
    <link rel="stylesheet" href="/css/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="/css/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
    -->
@endsection

@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class = 'row'>
        <div class="col-md-8 col-md-offset-1">

            <table id="biertabel" class="table table-striped table-hover">
            {{-- <table id="biertabel" class="display" cellspacing="0" width="100%"> --}}
                <thead>
                    <tr>
                        <th class="text-left">{{Lang::get('custom.code')}}</th>
                        <th>{{Lang::get('custom.name')}}</th>
                        <th>{{Lang::get('custom.category')}}</th>
                        <th>{{Lang::get('custom.vastseizoen')}}</th>
                        <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>{{Lang::get('custom.new')}}</button></th>
                     </tr>
                 </thead>
                 
                 <tbody id="biersoortbody">
                    @foreach($biersoorten as $biersoort)
                        <tr id="biersoort{{$biersoort->id}}">
                            <td>{{ $biersoort->code }}</td>
                            <td>{{ $biersoort->omschrijving }}</td>
                            <td>{{ $biersoort->beercategory->omschrijving or ''}}</td>
                            <td class="text-center">{{ $biersoort->vastofseizoen }}</td>
                            {{-- <td class="text-center">&euro; {{ $biersoort->accijnstarif->tariefperhl or ''}}</td> --}}
                            <td class="text-right">
                                <div class="input-group">                    
                                    <div class="input-group-btn">
                                        <button class="btn btn-warning btn-xs btn-detail but-spacing open-modal" value="{{$biersoort->id}}"><span class="glyphicon glyphicon-edit"></span>{{Lang::get('custom.edit')}}</button> 
                                        <button class="btn btn-danger btn-xs btn-delete but-spacing delete-biersoort" value="{{$biersoort->id}}"><span class="glyphicon glyphicon-remove"></span>{{Lang::get('custom.delete')}}</button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div id="ajaxloader">
                    <img src= 'images/ajax-loader.gif'>
                    <div>Bier opslaan</div>
                </div>

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bewerk product</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <div class="row">
                        
                        {!! Form::model($biersoorten, ['files' => true, 'data-parsley-validate' => '', 'id'=>'uploadForm'])  !!} 
                        
                        <div class="col col-md-8 col-xs-8">
                            
                            <div class="form-group">
                                <input type="hidden" id="biersoort_id" name="biersoort_id" value="0"/>
                            </div>
                            <div class="form-group error col-md-3">
                                {{ Form::label('code', 'Code:', 'class="control-label"') }}
                                {{ Form::text('code', null, ["class" => 'form-control', 'required' => '', 'maxlength' => '3', ]) }}
                            </div>
                            <div class="form-group col-md-9">
                                {{ Form::label('omschrijving', 'Naam:', 'class="control-label"') }}
                                {{ Form::text('omschrijving', null,  ["class" => 'form-control', 'required' => '']) }}
                            </div>
                            <div class="form-group col-md-12">
                                {{ Form::label('toelichting', 'Toelichting:', 'class="control-label"') }}
                                {{ Form::textarea('toelichting', null,  ["class" => 'form-control', 'rows'=> '5' ,'required' => '']) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('beercategory_id', 'Categorie:', 'class="control-label"') }} 
                                {{ Form::select('beercategory_id', $biercategorieen, null, ['class' => 'form-control', 'required' => '']) }}
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('vastofseizoen', 'Vast/Seizoen:', 'class="control-label"') }}
                                {{-- {{ Form::select('vastofseizoen', $vastofseizoen_dropdown, null, ['class' => 'form-control', 'required' => '']) }} --}}
                                <select id="vastofseizoen" name="vastofseizoen" class="form-control">
                                    <option value='V'>Vast</option>
                                    <option value='S'>Seizoen</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                {{ Form::label('accijnstarif_id', 'Accijnstarief:', 'class="control-label"') }}
                                {{ Form::select('accijnstarif_id', $accijnstarieven, null, ['class' => 'form-control', 'required' => '']) }}
                            </div>
                        </div>

                        <div id="beer_image" class="col col-md-3 col-xs-3 ">
                            <div class= "well" id="logo_well">
                                <a class="fancybox" href="/images/biersoorten/{{ $biersoort->image or 'notfound.png' }}" id="fancyboximage">
                                    <img src="/images/biersoorten/{{$biersoort->image or 'notfound.png'}}" id="imagepreview" width="100%" class="img-responsive">
                                </a>
                            </div>
                            <div>
                                <input type='file' name='image' id='image' onchange="readURL(this);" />
                                <div style="font-size: 11px">{{Lang::get('custom.maximum')}} {{$maxfilesize}}b</div>
                            </div>                            
                            
                        </div>

                    </div>
                    <hr>
                    <div class="row">

                        <div class="show_beerdetails">
                            <span class="glyphicon glyphicon glyphicon-collapse-down" style="display:block;margin-left:10px"></span>
                        </div>

                        <div id="beerdetails" style="display:none;">
                            
                            <div class="col col-md-12">
                                <div class="form-group error col-md-3 col-sm-3">
                                    
                                    {{ Form::label('alcvolmin', 'Alcvol min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Minimaal alcohol volume"></span>
                                    {{ Form::text('alcvolmin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('alcvolmax', 'Alcvol max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Maximaal alcohol volume"></span>
                                    {{ Form::text('alcvolmax', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('ogmin', '°P/OG min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Graden Plato is het aantal grammen extract per 100 gram wort. Ook wel OG genoemd"></span>
                                    {{ Form::text('ogmin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('ogmax', '°P/OG max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Graden Plato is het aantal grammen extract per 100 gram wort. Ook wel OG genoemd"></span>
                                    {{ Form::text('ogmax', null, ["class" => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col col-md-12">
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('ebumin', 'EBU min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Minimale bitterheidsgraad van het bier"></span>
                                    {{ Form::text('ebumin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('ebumax', 'EBU max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Maximale bitterheidsgraad van het bier"></span>
                                    {{ Form::text('ebumax', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('ebcmin', 'EBC min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="De kleurcode van het bier"></span>
                                    {{ Form::text('ebcmin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('ebcmax', 'EBC max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="De kleurcode van het bier"></span>
                                    {{ Form::text('ebcmax', null, ["class" => 'form-control']) }}
                                </div>
                            </div>                                    

                            <div class="col col-md-12">
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('fgmin', 'FG min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Hoera hoera!!!"></span>
                                    {{ Form::text('fgmin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-3 col-sm-3">
                                    {{ Form::label('fgmax', 'FG max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Hoera hoera!!!"></span>
                                    {{ Form::text('fgmax', null, ["class" => 'form-control']) }}
                                </div>
                            </div>

                        </div>
                    </div>

                    {!! Form::close() !!}

                </div><!-- modal body -->
                
                <div class="modal-footer">
                    <div class="col col-md-12">
                        <button type="button" class="btn btn-primary" id="btn-cancel">{{Lang::get('custom.cancel')}}</button>
                        <button type="button" class="btn btn-primary" id="btn-save" value="add">{{Lang::get('custom.save')}}</button>
                    </div>
                </div><!-- modal footer -->

            </div><!-- modal content -->
        </div><!-- modal dialog -->
    </div><!-- modal -->

@endsection

@section('scripts')
    
    <script type="text/javascript" src="/js/jquery.fancybox.js"></script>

    <script type="text/javascript">

        $('.show_beerdetails').click(function(){
            $('#beerdetails').slideToggle(500);
        });

        var url = "/bier";
        
        //Cancel button
        $('#btn-cancel').click(function(){
            $('#myModal').modal('hide');
        });


        $('#biertabel').on('click','.open-modal', function(){
            var biersoort_id = $(this).val();
            console.log('biersoort_id:' + biersoort_id);
            var image = '';

            $('#beerdetails').hide();

            $.get(url + '/' + biersoort_id, function (data) {
                //success data
                console.log(data);
                $('#myModalLabel').text("Bewerk product");
                $('#code').val(data.code);
                $('#omschrijving').val(data.omschrijving);
                $('#toelichting').val(data.toelichting);
                $('#biersoort_id').val(data.id);
                $('#beercategory_id').val(data.beercategory_id);
                $('#accijnstarif_id').val(data.accijnstarif_id);
                $('#vastofseizoen').val(data.vastofseizoen);
                if(data.image===null){data.image = 'notfound.png'};
                // $('#image').val('');
                $("#imagepreview").attr("src", "/images/biersoorten/" + data.image);
                $("#fancyboximage").attr("href", "/images/biersoorten/" + data.image);
                $('#fgmin').val(data.fgmin);
                $('#fgmax').val(data.fgmax);
                $('#ogmin').val(data.ogmin);
                $('#ogmax').val(data.ogmax);
                $('#alcvolmin').val(data.alcvolmin);
                $('#alcvolmax').val(data.alcvolmax);
                $('#ebumin').val(data.ebumin);
                $('#ebumax').val(data.ebumax);
                $('#ebcmin').val(data.ebcmin);
                $('#ebcmax').val(data.ebcmax);

                $('#btn-save').val('update');                
                $('#myModal').modal('show');
            }) 
        });


        //delete biersoort and remove from table
        $('#biertabel').on('click','.btn-delete', function(){
            
            var biersoort_id = $(this).val();
            
            swal({
              title: '{{Lang::get('custom.delete_product')}}',
              text: "{{Lang::get('custom.areyousure')}} {{Lang::get('custom.not_undone')}}",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: '{{Lang::get('custom.delete')}}',
              
            }).then(function () {
                //AJAX call to delete biersoort
                $.ajax({
                    type: "DELETE",
                    url: url + '/' + biersoort_id,
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    success: function (data) {
                        //remove row from table
                        $("#biersoort" + biersoort_id).remove();
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
            $('#myModalLabel').text("Nieuw product");
            $('#code').val("");
            $('#omschrijving').val("");
            $('#toelichting').val("");
            $('#beercategory_id').val("");
            $('#accijnstarif_id').val("");
            $('#vastofseizoen').val("");
            $("#imagepreview").attr("src", "");
            $("#fancyboximage").attr("href", "");
            // $("#imagepreview").attr("src", "/images/biersoorten/notfound.png"); GEEFT FOUTJE BIJ NIEUWE INVOER !!!!!!!!!!!!!!!!!!!!!!!!!!!
            $('#myModal').modal('show');
        });        
        
        //////////////////////////////////////////////////////////////////////////////////////////////////
        //  
        //  https://abandon.ie/notebook/simple-file-uploads-using-jquery-ajax
        //
        //////////////////////////////////////////////////////////////////////////////////////////////////
        
        // Variable to store your files
        var files;

        // Add events
        $('input[type=file]').on('change', prepareUpload);

        // Grab the files and set them to our variable
        function prepareUpload(event)
        {
          files = event.target.files;
        }

        //create new biersoort / update existing biersoort
        // $("#btn-save").click(function (e) {
        $(document).on('click','#btn-save', function(e){
            
            // var form = document.forms.namedItem('uploadForm');
            // var form = $('form')[0];
            // var formdata = new FormData(form);
            // for (var [key, value] of formdata.entries()) { 
            //   console.log(key, value);
            // }
            
            // var filepath = $('input[type=file]').val();
            // var filename = $('input[type=file]').val().replace(/.*(\/|\\)/, '');
            // console.log('Filepath = ' + filepath);
            // console.log('Filename = ' + filename);

            // var fileUpload    = $("#image").get(0); 
            // var files         =  fileUpload.files; 
            // var mediafilename = ""; 
            // for (var i = 0; i < files.length; i++) { 
            //   mediafilename = files[i].name; 
            // } 
            // console.log('Mediailename = ' + mediafilename);

            var formData = {
                code: $('#code').val(),
                accijnstarif_id: $('#accijnstarif_id').val(),
                omschrijving: $('#omschrijving').val(),
                toelichting: $('#toelichting').val(),
                beercategory_id: $('#beercategory_id').val(),
                accijnstarif_id: $('#accijnstarif_id').val(),
                vastofseizoen: $('#vastofseizoen').val(),
                image: $('image').val(),
                fgmin: $('#fgmin').val(),
                fgmax: $('#fgmax').val(),
                ogmin: $('#ogmin').val(),
                ogmax: $('#ogmax').val(),
                alcvolmin: $('#alcvolmin').val(),
                alcvolmax: $('#alcvolmax').val(),
                ebumin: $('#ebumin').val(),
                ebumax: $('#ebumax').val(),
                ebcmin: $('#ebcmin').val(),
                ebcmax: $('#ebcmax').val(),
            };
            
            // console.info(formData);
            
            // Determine the http action [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var biersoort_id = $('#biersoort_id').val();
            var my_url = url;
            var type = "POST"; //for creating new resource
            if (state == "update"){
                type = "PUT"; //for updating existing resource
                my_url = my_url + '/' + biersoort_id;
            }

            $.ajax({
                type: type,
                url: my_url,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                cache: false,
                data: formData,
                dataType: 'json',
                success: function (data) {

                    var bierrow = '<tr id=biersoort' + data.id + '">';
                    bierrow += '<td>' + data.code + '</td>';
                    bierrow += '<td>' + data.omschrijving + '</td>';
                    bierrow += '<td>' + $('#beercategory_id').find('option:selected').text() + '</td>'
                    bierrow += '<td class="text-center">' + $('#vastofseizoen').val() + '</td>'
                    bierrow += '<td class="text-right">';
                    bierrow += '<div class="input-group">';
                    bierrow += '<div class="input-group-btn">';
                    bierrow += '<button class="btn btn-warning btn-xs btn-detail open-modal but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-edit"></span>Bewerk</button>';
                    bierrow += '<button class="btn btn-danger btn-xs btn-delete delete-biersoort but-spacing" value="' + data.id + '"><span class="glyphicon glyphicon-remove"></span>Verwijder</button>';
                    bierrow += '</div>';
                    bierrow += '</div>';
                    bierrow += '</td>';
                    bierrow += '</tr>';
                    
                    if (state == "add"){ 
                        //user added a new record
                        $('#biersoortbody').prepend(bierrow);

                        //Copy file: make second AJAX call for the image
                        copy_form_image(my_url);

                    }else{
                        //user updated an existing record
                        document.getElementById('biersoort' + data.id).innerHTML = bierrow;
                    }

                },
                error: function (data) {
                    console.log('Error in POST/PUT (biersoort):', data);
                }
            });

            $('#ajaxloader').hide();
            $('#myModal').modal('hide');

        });

        function copy_form_image(url){
            // e.stopPropagation(); // Stop stuff happening
            // e.preventDefault();
                        
            $('#ajaxloader').show();

            // Create a formdata object and add the files
            var data = new FormData();
            $.each(files, function(key, value)
            {
                data.append(key, value);
            });
            
            $.ajax({
                url: url + '?files',
                type: 'POST',
                data: data,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                cache: false,
                dataType: 'json',
                processData: false, // Don't process the files
                contentType: false, // Set content type to false as jQuery will tell the server its a query string request
                success: function(data, textStatus, jqXHR){
                    if(typeof data.error === 'undefined'){
                        // Success
                        // submitForm(event, data);
                    }else{
                        // Handle errors here
                        console.log('ERRORS: ' + data.error);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown){
                    // Handle errors here
                    console.log('ERRORS: ' + textStatus);
                    $('#ajaxloader').hide();
                }
            });
        }


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

            $('[data-toggle="tooltip"]').tooltip(); 

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
                "info":     false,
                "processing": true,
                "order": [[ 1, 'asc' ], [ 0, 'asc' ]],
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
                    }
                ],
            });

        });

    </script>

@endsection