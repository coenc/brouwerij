
    var map;
    var infowindow;
    // var mapCenter = {lat: 52, lng: 5};
    var geocoder = new google.maps.Geocoder();
    var marker = new google.maps.Marker;

    //Create map
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 52, lng: 5},
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
            // console.log(JSON.stringify(data));
            //Loop through results
            $.each(data, function(i,data) {

                //If lat/lon unknown then update in db
                // if (!data.lat || !data.lon) {
                //     console.log('lat and/or lon unknown');

                //     $.ajax({
                //         //type: 'GET',
                //         url: '/updatelatlon',
                //         dataType: 'json',
                //         headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                //         data: '{"id":' + data.id + '"lat":' + data.lat + ', "lon":' + data.lon +'}',
                //         success: function (data, result) {
                            
                //             console.log('RESULT:' + result);

                //         },
                //         error: function (data) {
                //             console.log('Error in updatelat/lon:', data);
                //         }
                //     });

                // }
                
                
                var query = encodeURI(data.adres + ' ' + data.plaats);
                var address = data.naam + '\n' + data.adres + '\n' + data.postcode + ' ' + data.plaats + '\n' + data.telefoon
                var infoWindow = '<div>'
                infoWindow += '<a href="//' + data.website + '" target="_blank"><strong>' + data.naam + '</strong><br>';
                infoWindow += data.adres + '<br>';
                infoWindow += data.postcode + ' ';
                infoWindow += data.plaats ;
                infoWindow += '</div></a>';

                geoCodeer(query, infoWindow, address, data.postcode);
                // waitSeconds(1);
            });
        },
        error: function (data) {
            console.log('Error in jsonbrouwerijen:', data);
        }
    });

    function geoCodeer(pQuery, pInfoWindow, pAddress, pPostcode){
        console.log('Query=' + pQuery);
        geocoder.geocode({'address': pQuery, 
                                componentRestrictions: 
                                {
                                    country: 'NL',
                                    postalCode: pPostcode
                                },
                                
                        }, function (results, status) {
            console.log('status:'+status);
            if (status == 'OK') {

                console.log('lat:'+results[0].geometry.location.lat());
                console.log('lng:'+results[0].geometry.location.lng());

                //Place marker
                var marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    icon: '/images/marker.png',
                    title: pAddress
                });
                
                //Create text annotation
                var myInfoWindowContent = pInfoWindow;
                var infowindow = new google.maps.InfoWindow({
                    content: myInfoWindowContent
                });
                
                infowindow.open(map,marker);
                return(results[0].geometry.location.lat());
            }else{
                console.log('Geocoding error: ' + status + ' voor adres ' + pAddress);
            }
        });
    }

    function waitSeconds(iMilliSeconds) {
        var counter= 0
            , start = new Date().getTime()
            , end = 0;
        while (counter < iMilliSeconds) {
            end = new Date().getTime();
            counter = end - start;
        }
    }

