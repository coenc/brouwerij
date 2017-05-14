@extends('main')

@section('title', 'Brouwerijen in Nederland')

@section('content')

    <style>
      #map {
        width: 100%;
        height: 800px;
        background-color: grey;
      }
      #infowindow{
      	width: 100%;
      	color: black;
      }
    </style>

    <div class = 'row'>
        <div class="cont col-md-11 col-md-offset-1">
			<!-- GoogleMaps  -->
			<div id="map"></div>
			<!-- /GoogleMaps -->
        </div>
    </div>

@endsection


@section('scripts')

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP4NJgNqzDrF5QULb-PAxWEwCkNoP0H_I&libraries=places" async defer></script>
    <script type="text/javascript" src="js/googlemaps.js"></script>

@endsection