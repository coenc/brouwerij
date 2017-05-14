
var map;
var infowindow;

var lat = 0;
var lng = 0;

navigator.geolocation.getCurrentPosition(onGeoSuccess, onGeoError);

function onGeoSuccess(position) {

var lat = position.coords.latitude;
var lon = position.coords.longitude;

var mapCenter = {lat: lat, lng: lon};
var myMarkerLocation = new google.maps.LatLng(lat, lon);
var marker = new google.maps.Marker;

//$('#lat').text('lat=' + lat + ', lon=' + lon);
//$('#lon').text('lat='+lon);

//Create map
map = new google.maps.Map(document.getElementById('map'), {
    center: mapCenter,
    zoom: 8,
    mapTypeId:  google.maps.MapTypeId.ROADMAP
                //google.maps.MapTypeId.SATELLITE
                //google.maps.MapTypeId.HYBRID
                //google.maps.MapTypeId.TERRAIN
});

//Place a marker on the map
var marker = new google.maps.Marker({
    position: {lat: lat, lng: lon},
    map: map,
    icon: '/images/marker.png',
    title: "Jouw locatie"
});

//Create text annotation
var myInfoWindowContent = '<div id="iw-container"><div class="iw-title">Hier ben je!!!</div><div id="iw-text0"></div><div id="iw-text1"></div><div id="iw-lat">lat</div><div id="iw-lon">lon</div></div>';

var infowindow = new google.maps.InfoWindow({
    content: myInfoWindowContent
});

//Create the info window for the marker
infowindow.open(map,marker);



//Get address
var latlng = new google.maps.LatLng(lat, lon);
var geocoder = geocoder = new google.maps.Geocoder();
geocoder.geocode({ 'latLng': latlng }, function (results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
        if (results[1]) {
            $('#iw-text0').text(results[0].formatted_address); //Less detailed address data
            $('#iw-text1').text(results[1].formatted_address); //Less detailed address data
            $('#iw-lat').text('Lat: ' + Math.round(lat*1000)/1000);
            $('#iw-lon').text('Lon: ' + Math.round(lon*1000)/1000);
        }
    }
});

}

function onGeoError(error) {
alert('errorcode: ' + error.code + '\n' + 'errormessage: ' + error.message + '\n');
}

function initMap() {
// 
};
