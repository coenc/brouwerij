@extends('main')

@section('css')
    <style>
        #loginstatus{
            /*visibility: hidden;*/
        }
    </style>
@endsection

@section('content')

@section('title', 'BIS')

<div class="container">

    <div class="row">
        <div class="col-md-6 col-md-offset-1">
            <div class="panel panel-primary">
                
                <div class="panel-heading text-center">
                    <h4>Brouwerij Informatie Systeem {{ $appversion }}</h4>
                </div>

                <div class="row" style="margin-top:20px">
                    @if(Auth::check())
                        <div class="col-md-6 col-xs-6 col-sm-4" id="logo_row"> 
                            <div class="well" id="logo_well">
                                <div class="text-center">
                                    <sup>{{$groupname}}</sup>
                                </div>
                                <img id="group_logo" class="img-responsive" src="/images/logos/{{$grouplogo}}"/>
                            </div>
                        </div>
                    @else
                        <div class="col-md-8 col-xs-6 col-sm-4" id="logo_row"> 
                            <div class="well" id="logo_well">
                                <div class="text-center">
                                    <sup>BIS</sup>
                                </div>
                                <img id="group_logo" class="img-responsive" src="/images/logos/bislogo.png"/>
                            </div>
                        </div>

                    @endif

                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1" style="margin-bottom: 10px">
                        @if(!Auth::check())                       
                            <div class="text-center">U bent uitgelogd</div>
                            <div>
                                <a href="#" class="btn btn-primary btn-block" role="button" id="loginlink">LOGIN</a>
                            </div>
                        @else
                            <div  class="text-center">
                                <div>U bent ingelogd</div>
                                <a href="/auth/logout" class="btn btn-primary btn-block" role="button" id="logoutlink">LOGOUT</a>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-md-12 text-right"> 
                    <a id="about_button" type="button">About this web application</a>
                </div>

            </div>
        </div>
    </div>

    <!-- modal form for login -->
    @if(!Auth::check())
    <div class="modal fade bd-example-modal-lg" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Inloggen</h4>
                </div><!-- modal header -->
                
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        <div class="panel-body">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-mail adres</label>
                               
                                <div class="col-md-6">
                                    {{-- <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus> --}}
                                    <input id="email" type="email" class="form-control" name="email" value="guest@bis.nl" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Wachtwoord</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" value="qazwsx" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}> Onthoud mij op deze computer
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <div class="col col-md-12">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        
                            <div class="col-md-4 ">
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Wachtwoord vergeten?
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a class="btn btn-link" href="{{ url('/auth/register') }}">
                                    Registreren
                                </a>
                            </div>
                        </div>
                    </div><!-- modal footer -->
                </form>

            </div>
        </div>
    </div> <!-- end modal loginform -->
    @endif


    <!-- modal form About -->
    <div class="modal fade bd-example-modal-lg" id="modalAbout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h3 class="modal-title" id="myModalLabel">About this web application</h3>
                </div><!-- modal header -->

                <div class="modal-body">
                    <div class="row">
                        <div class="col col-md-12">
                            @include('about_this_webapplication')
                        </div>
                    </div>
                </div><!-- end modal body -->
                
                <div class="modal-footer">
                    <div class="col col-md-12">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                </div><!-- modal footer -->

            </div><!-- end modal content -->
        </div><!-- end modal dialog -->
    </div><!-- end modal form -->


</div>

@endsection

@section('scripts')

    <script>

        $("#loginlink").click(function (e) {
            $('#modalLogin').modal('show');
        });

        $("#about_button").click(function (e) {
            $('#modalAbout').modal('show');
        });

        $(document).ready(function(){

            var jquery_version = jQuery().jquery;
            
            $('#jquery_version').html('jQuery v.' + jquery_version);

            $('#screen').html('Screen size ' + screen.width + 'x' + screen.height);

            $('#modalLogin').modal('show');
            
        });

    </script>

@endsection

