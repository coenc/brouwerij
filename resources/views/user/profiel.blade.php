@extends('main')

@section('title', 'Mijn profiel')

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

        <div class="col-md-10 col-md-offset-1">
            
            {!! Form::model($group, ['files' => true, 'data-parsley-validate' => '', 'id'=>'uploadForm']) !!} 

                <div class="col-md-5">
                        
                        <div class="form-group error col-md-12">
                            {{ Form::label('groupnaam', 'Naam', 'class="control-label"') }}
                            {{ Form::text('groupname', null, ["class" => 'form-control', 'required' => '', 'maxlength' => '100', ]) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{ Form::label('adres', 'Adres', 'class="control-label"') }}
                            {{ Form::text('adres', null,  ["class" => 'form-control']) }}
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            {{ Form::label('postcode', 'Postcode', 'class="control-label"') }}
                            {{ Form::text('postcode', null,  ["class" => 'form-control']) }}
                        </div>
                        <div class="form-group col-sm-8 col-md-8">
                            {{ Form::label('woonplaats', 'Woonplaats', 'class="control-label"') }}
                            {{ Form::text('woonplaats', null,  ["class" => 'form-control', 'rows'=> '5']) }}
                        </div>
                        <div class="form-group col-md-12">
                            {{ Form::label('email', 'Email', 'class="control-label"') }}
                            {{ Form::text('email', null,  ["class" => 'form-control', 'rows'=> '5']) }}
                        </div>

                </div>

                <div class="col-md-5">

                    <div class= "well" id="logo_well" style="width:50%; margin-top: 24px">
                        <a class="fancybox" href="/images/logos/{{ $group->logo or 'bislogo.gif' }}" id="fancyboximage">
                            <img src="/images/logos/{{$group->logo or 'notfound.png'}}" id="imagepreview"    class="img-responsive">
                        </a>
                    </div>
                    <div>
                        
                        {{Form::file('image', ['id' => 'image', 'onchange' => 'readURL(this);'])}}
                    </div> 
                </div>
                <br>
                <div class="form-group">
                    <div class="col-md-12" style="margin:15px">
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')
    
    <script type="text/javascript" src="/js/jquery.fancybox.js"></script>

    <script type="text/javascript">

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
        });

    </script>

@endsection