@extends('main')

@section('title', 'Brouwerijen in Nederland')

@section('content')

    <style>
      #map {
        width: 100%;
        height: 800px;
        background-color: grey;
      }
    </style>

    <div class = 'row'>
        <div class="col-md-11 col-md-offset-1">

			<!-- Content -->
	        <div data-role="content">
	            
	            <!-- GoogleMaps  -->
	            {{-- <div id="hourglass"><img src="css/images/ajax-loader.gif"></div> --}}
	            <div>
	                <div id="lat" style="position:relative;"></div>
	                <div id="lon" style="position:relative;"></div>
	            </div>
	            <div id="map"></div>
	            <!-- /GoogleMaps -->
	            
	        </div>
	        <!-- /Content -->

        </div>
    </div>

@endsection


@section('scripts')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP4NJgNqzDrF5QULb-PAxWEwCkNoP0H_I&libraries=places" async defer></script>
    <script type="text/javascript" src="js/googlemaps.js"></script>

@endsection