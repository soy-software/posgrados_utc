var map;
    var geocoder;
    var marker;
    var infowindow;
    var lat=parseFloat($('#lat').val());
    var lng=parseFloat($('#lng').val());

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat: lat, lng: lng}
        });
        geocoder = new google.maps.Geocoder;
        infowindow = new google.maps.InfoWindow;
        geocodeLatLng(geocoder, map, infowindow);
        google.maps.event.addListener(map, 'click', function() {
          infowindow.close();
        });
        
    }

      
    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                marker.formatted_address = responses[0].formatted_address;
                
            } else {
                marker.formatted_address = 'No se puede determinar la dirección en esta ubicación.';
                
            }
            infowindow.setContent(marker.formatted_address+"<br>Coordenadas: "+marker.getPosition().toUrlValue(6));
            infowindow.open(map, marker);
            
            
            $('#lat').val(marker.getPosition().lat())
            $('#lng').val(marker.getPosition().lng())
            $('#dir').val(marker.formatted_address);
        });
    }

    function geocodeLatLng(geocoder, map, infowindow) {
        var latlng = {lat: lat, lng: lng};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            
            if (marker) {
               marker.setMap(null);
               if (infowindow) infowindow.close();
            }
            
            if (results[0]) {
                map.setZoom(8);
                    marker = new google.maps.Marker({
                    position: latlng,
                    draggable: true,
                    map: map
                });
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);

                google.maps.event.addListener(marker, 'dragend', function() {
                    geocodePosition(marker.getPosition());
                });

                google.maps.event.addListener(marker, 'click', function() {
                    if (marker.formatted_address) {
                        infowindow.setContent(marker.formatted_address+"<br>Coordenadas: "+marker.getPosition());
                    } else  {
                        infowindow.setContent(results[0].formatted_address+"<br>Coordenadas: "+marker.getPosition());
                    }
                    infowindow.open(map, marker);
                });
                google.maps.event.trigger(marker, 'click');

            } else {
              console.log('No se han encontrado resultados');
            }
          } else {
            console.log('Geocoder falló debido a:' + status);
          }
        });
    }