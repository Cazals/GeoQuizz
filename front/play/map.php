<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../importScript.html' ?>
    <title>GeoQuizz</title>
</head>
<script>
    // Note: This example requires that you consent to location sharing when
    // prompted by your browser. If you see the error "The Geolocation service
    // failed.", it means you probably did not give permission for the browser to
    // locate you.

    function initMap() {
        var pos;
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                myPosition.setPosition(pos);
                map.setCenter(pos);


            }, function () {
                handleLocationError(true, myPosition, map.getCenter());
            });
        } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, myPosition, map.getCenter());
        }

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            disableDefaultUI: true
        });
        //Marker for current position
        var myPosition = new google.maps.Marker({
            map: map,
            title: 'My position',
            animation: google.maps.Animation.DROP
        });
        var placeIcon = {
            url: "../ressources/home-shape.png",
            scaledSize: new google.maps.Size(40, 40) // scaled size
        };

        var contentString = '' + '<style>' +
            '.demo-card-wide > .port { background: url("../ressources/port.jpg") center / cover' +
            '}</style>' +
            '<div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col-phone">' +
            '<div class="mdl-card__title port">' +
            '<h2 class="mdl-card__title-text">Port</h2>' +
            '</div>' +
            '<div class="mdl-card__supporting-text">' +
            ' Ceci est le port de la ville. <br/>' +
            'C\'est un endroit très touristique' +
            '</div>' +
            '<div class="mdl-card__actions mdl-card--border">' +
            '<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Acheter pour 100 pts</a>' +
            '</div>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        var places = new google.maps.Marker({
            map: map,
            title: 'Port',
            icon: placeIcon,

            position: {
                lat: 45.778447,
                lng: 4.809514
            }
        });

        //INFOWINDOW for each places
        places.addListener('click', function () {
            infowindow.open(map, places);
        });

    }


    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The Geolocation service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }
</script>

<body>
<div class="layoutHolder">
    <?php include_once "../shared/navbar.php" ?>
    <main class="mdl-layout__content">
        <div class="mdl-grid">
            <div class="page-content">
                <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div id="map" class="mdl-cell--4-col-phone"></div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiqLa_cLhGPKGRxi4oW2DvyqM8hMPiu2Q&callback=initMap"
                            async defer>
                    </script>
                </div>
            </div>
        </div>
    </main>
</div>
</body>

</html>