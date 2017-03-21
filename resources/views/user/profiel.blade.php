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
            
            {!! Form::model($group, ['files' => true, 'data-parsley-validate' => '', 'id'=>'uploadForm'])  !!} 

            <div class="col-md-5">    
                    
                    <div class="form-group error col-md-12">
                        {{ Form::label('groupnaam', 'Naam:', 'class="control-label"') }}
                        {{ Form::text('groupname', null, ["class" => 'form-control', 'required' => '', 'maxlength' => '300', ]) }}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('adres', 'Adres:', 'class="control-label"') }}
                        {{ Form::text('adres', null,  ["class" => 'form-control', 'required' => '']) }}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('woonplaats', 'Woonplaats:', 'class="control-label"') }}
                        {{ Form::text('woonplaats', null,  ["class" => 'form-control', 'rows'=> '5' ,'required' => '']) }}
                    </div>
                    <div class="form-group col-md-12">
                        {{ Form::label('email', 'Email:', 'class="control-label"') }}
                        {{ Form::text('email', null,  ["class" => 'form-control', 'rows'=> '5' ,'required' => '']) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('password', 'Wachtwoord:', 'class="control-label"') }}
                        {{ Form::password('password', ["class" => 'form-control', 'rows'=> '5' ,'required' => '']) }}
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>  

            </div>

            <div class="col-md-5">
                <div class= "well" id="logo_well">
                    <a class="fancybox" href="/images/logos/{{ $group->logo or 'notfound.png' }}" id="fancyboximage">
                        <img src="/images/logos/{{$group->logo or 'notfound.png'}}" id="imagepreview" width="100%" class="img-responsive">
                    </a>
                </div>
                <div>
                    <input type='file' name='image' id='image' onchange="readURL(this);" />
                </div> 
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')
    
    <script type="text/javascript" src="/js/jquery.fancybox.js"></script>

    <script type="text/javascript">

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