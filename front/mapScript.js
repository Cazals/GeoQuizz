// Using the function to create multiple markers

    var infowindow = new google.maps.InfoWindow({maxWidth: 300});
    function geocodeLatLng(location,title,body) {
        var geocoder = new google.maps.Geocoder;
        var input = location;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    var marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });

                    marker.addListener('click', function() {
                        infowindow.setContent("<h3>" + title + "</h3>" + "<p>" + body + "</p>");
                        infowindow.open(map, marker);
                    });

                } else {
                    window.alert('No results found');
                }
            } else {
                window.alert('Geocoder failed due to: ' + status);
            }
        });

}