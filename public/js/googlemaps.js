
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

//Create map
map = new google.maps.Map(document.getElementById('map'), {
    center: mapCenter,
    zoom: 8,
    mapTypeId:  google.maps.MapTypeId.ROADMAP
                //google.maps.MapTypeId.SATELLITE
                //google.maps.MapTypeId.HYBRID
                //google.maps.MapTypeId.TERRAIN
    });

    
    //AJAX call to get brouwerijen in Nederland
    $.ajax({
        type: 'GET',
        url: '/brouwerijenjson',
        dataType: 'json',
        success: function (data) {
            
            //Loop through results of AJAX call
            for(var i in data)
            {
                var naam = data[i].naam;
                var adres = data[i].adres;
                var postcode = data[i].postcode;
                var plaats = data[i].plaats;
                var lat = data[i].lat;
                var lon = data[i].lon;

                console.log(naam + ' ' + adres + ' ' + postcode + ' ' + plaats + ' ' + data[i].lat + ' ' + data[i].lon);

                var geocoder = geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'address':  postcode + '%20' + plaats }, function (results, status) {
                    //console.log(results[0].geometry.location);
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            console.log('xxx' + results[0].geometry.location);
                        }
                    }
                    else
                    {
                        console.log('No geocode data found');
                    }
                });

                // Create markers for each brouwerij
                var marker = new google.maps.Marker({
                    position: {lat: lat, lng: lon},
                    map: map,
                    icon: '/images/marker.png',
                    title: naam + '\n' + adres + '\n' + postcode + ' ' + plaats
                });

                //Create text annotation
                var myInfoWindowContent = '<div id="infowindow"><strong>' + naam + '</strong><br>' + adres + '<br>' + postcode + ' ' + plaats + '</div>';
                var infowindow = new google.maps.InfoWindow({
                    content: myInfoWindowContent
                });

                //Create the info window for the marker
                infowindow.open(map,marker);

            }


        },
        error: function (data) {
            console.log('Error in jsonbrouwerijen:', data);
        }
    });

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
