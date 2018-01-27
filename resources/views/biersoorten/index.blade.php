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

        <div class="col-md-4 col-md-offset-1">

            <table id="biertabel" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="text-left">{{Lang::get('custom.code')}}</th>
                        <th class="text-left">{{Lang::get('custom.name')}}</th>
                        <th class="hidden-sm hidden-xs">{{Lang::get('custom.category')}}</th>
                        <th width="50px" class="text-center hidden-sm hidden-xs">{{Lang::get('custom.vastseizoen')}}</th>
                        <th class="text-center hidden-sm hidden-xs">Afbeelding</th>
                        <th class="text-right"><button id="btn-add" name="btn-add" class="btn btn-primary btn-xs but-spacing"><span class="glyphicon glyphicon-plus"></span>{{Lang::get('custom.new')}}</button></th>
                     </tr>
                 </thead>
                 
                 <tbody id="biersoortbody">
                    @foreach($biersoorten as $biersoort)
                        <tr id="biersoort{{$biersoort->id}}">
                            <td>{{ $biersoort->code }}</td>
                            <td>{{ $biersoort->omschrijving }}</td>
                            <td class="hidden-sm hidden-xs">{{ $biersoort->beercategory->omschrijving or ''}}</td>
                            <td class="text-center hidden-sm hidden-xs">{{ $biersoort->vastofseizoen }}</td>
                            <td class="text-center hidden-sm hidden-xs">
                                @if($biersoort->image)
                                <a class="fancybox" href="/images/biersoorten/{{$group_id or 'notfound.png'}}/{{ $biersoort->image or 'notfound.png' }}" id="fancyboximage">
                                    {{-- <img src="/images/biersoorten/{{$group_id}}/{{$biersoort->image or 'notfound.png'}}" id="imagepreview" width="100%" class="img-responsive"> --}}
                                    afbeelding
                                </a>
                                @else
                                    --
                                @endif

                            </td>
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
                    <img src= '/images/ajax-loader.gif'>
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
                                {{ Form::text('code', null, ["class" => 'form-control', 'required' => '', 'maxlength' => '3', 'autofocus' => '']) }}
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

                        <div id="beer_image" class="col col-md-2 col-xs-3 ">
                            <div class= "well" id="logo_well">
                                <a class="fancybox"  id="fancyboximage"><img src="" id="imagepreview" width="100%" class="img-responsive"/></a>
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
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('alcvolmin', 'Alcvol min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Minimaal alcohol volume"></span>
                                    {{ Form::text('alcvolmin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('alcvolmax', 'Alcvol max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Maximaal alcohol volume"></span>
                                    {{ Form::text('alcvolmax', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('ogmin', '°P/OG min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Graden Plato is het aantal grammen extract per 100 gram wort. Ook wel OG genoemd"></span>
                                    {{ Form::text('ogmin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('ogmax', '°P/OG max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Graden Plato is het aantal grammen extract per 100 gram wort. Ook wel OG genoemd"></span>
                                    {{ Form::text('ogmax', null, ["class" => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col col-md-12">
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('ebumin', 'EBU min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Minimale bitterheidsgraad van het bier"></span>
                                    {{ Form::text('ebumin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('ebumax', 'EBU max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="Maximale bitterheidsgraad van het bier"></span>
                                    {{ Form::text('ebumax', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('ebcmin', 'EBC min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="De kleurcode van het bier"></span>
                                    {{ Form::text('ebcmin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('ebcmax', 'EBC max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="De kleurcode van het bier"></span>
                                    {{ Form::text('ebcmax', null, ["class" => 'form-control']) }}
                                </div>
                            </div>
                            
                            <div class="col col-md-12">
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('fgmin', 'FG min:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="FG min"></span>
                                    {{ Form::text('fgmin', null, ["class" => 'form-control']) }}
                                </div>
                                <div class="form-group error col-md-2 col-sm-2 col-xs-6">
                                    {{ Form::label('fgmax', 'FG max:', ["class" => 'control-label']) }}
                                    <span class="glyphicon glyphicon glyphicon-question-sign tooltip-questionmark" data-toggle="tooltip" title="FG max"></span>
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
            $('#ajaxloader').hide();
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
                if(data.image===null || data.image===""){data.image = 'notfound.png'};
                $("#imagepreview").attr("src", "/images/biersoorten/" + data.group_id + '/' + data.image);
                $(".fancybox").attr("href", "/images/biersoorten/" + data.group_id + '/'+ data.image);
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
              html: "{{Lang::get('custom.not_undone')}}<br /><br />{{Lang::get('custom.areyousure')}}",
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
            $("image").val = '';
            $('#myModal').modal('show');
        });        
        
        
        //create new biersoort / update existing biersoort
        $(document).on('click','#btn-save', function(e){
            
            e.preventDefault();

            $('#ajaxloader').show();

            var form = document.forms.namedItem('uploadForm');
            // var form = $('form')[0];
            var formdata = new FormData(form);
            for (var [key, value] of formdata.entries()) { 
              console.log(key, value);
            }

            // Determine the http action [add=POST], [update=PUT]
            var state = $('#btn-save').val();
            var biersoort_id = $('#biersoort_id').val();
            var my_url = url;
            var type = "POST"; //for creating new resource
            if (state == "update"){
                type = "PUT"; //for updating existing resource
                // formdata.append("updateaction", "1")
                my_url = my_url + '/' + biersoort_id;
            }

            $.ajax({
                type: type,
                url: my_url,
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                data: formdata,
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData: false,       // To send DOMDocument or non processed data file it is set to false
                success: function (data) {

                    var bierrow = '<tr id=biersoort' + data.id + '">';
                    bierrow += '<td>' + data.code + '</td>';
                    bierrow += '<td>' + data.omschrijving + '</td>';
                    bierrow += '<td class="hidden-sm hidden-xs">' + $('#beercategory_id').find('option:selected').text() + '</td>'
                    bierrow += '<td class="text-center hidden-sm hidden-xs">' + $('#vastofseizoen').val() + '</td>'
                    bierrow += '<td class="text-center hidden-sm hidden-xs"><a class="fancybox" href="/images/biersoorten/' + data.group_id + '/' + data.image + '" id="fancyboximage">afbeelding</a></td>';
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
                        //user added a new record, add table row
                        $('#biersoortbody').prepend(bierrow);
                    }else{ 
                        //user updated an existing record, update table row
                        document.getElementById('biersoort' + data.id).innerHTML = bierrow;
                    }

                },
                error: function (data) {
                    console.log('Error in postPOST/PUT (biersoort):', data);
                }
            });

            $('#ajaxloader').hide();
            $('#myModal').modal('hide');

        });


        function readURL(input) {
            if (input.files && input.files[0]) {
                $('#ajaxloader').show();
                var reader = new FileReader();
                reader.onload = function (e) {
                    var new_img = e.target.result;
                    $('#imagepreview').attr('src', new_img);
                    $(".fancybox").prop("href", new_img);
                };
                reader.readAsDataURL(input.files[0]);
                $('#ajaxloader').hide();
            }
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
                    }, {
                        targets: [ 5 ],
                        orderable: false
                    }
                ],
            });

        });

    </script>

@endsection