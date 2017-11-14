<!DOCTYPE html>
<html lang="en">
<head>

    <title>GeoQuizz</title>
</head>
<script>


    var myLatLng = {
        lat: 48.857031,
        lng: 2.346371
    };

    var styledMap = null;
    //TODO fix time for nightmode
    var h = new Date().getHours();
    if (h > 17){
        styledMap = [
            {elementType: 'geometry', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.stroke', stylers: [{color: '#242f3e'}]},
            {elementType: 'labels.text.fill', stylers: [{color: '#746855'}]},
            {
                featureType: 'administrative.locality',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'poi',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'geometry',
                stylers: [{color: '#263c3f'}]
            },
            {
                featureType: 'poi.park',
                elementType: 'labels.text.fill',
                stylers: [{color: '#6b9a76'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry',
                stylers: [{color: '#38414e'}]
            },
            {
                featureType: 'road',
                elementType: 'geometry.stroke',
                stylers: [{color: '#212a37'}]
            },
            {
                featureType: 'road',
                elementType: 'labels.text.fill',
                stylers: [{color: '#9ca5b3'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry',
                stylers: [{color: '#746855'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'geometry.stroke',
                stylers: [{color: '#1f2835'}]
            },
            {
                featureType: 'road.highway',
                elementType: 'labels.text.fill',
                stylers: [{color: '#f3d19c'}]
            },
            {
                featureType: 'transit',
                elementType: 'geometry',
                stylers: [{color: '#2f3948'}]
            },
            {
                featureType: 'transit.station',
                elementType: 'labels.text.fill',
                stylers: [{color: '#d59563'}]
            },
            {
                featureType: 'water',
                elementType: 'geometry',
                stylers: [{color: '#17263c'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.fill',
                stylers: [{color: '#515c6d'}]
            },
            {
                featureType: 'water',
                elementType: 'labels.text.stroke',
                stylers: [{color: '#17263c'}]
            }
        ]
    }

    function initMap() {
        var paris = {lat: 48.857031, lng: 2.346371};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: paris,
            styles: styledMap,
            disableDefaultUI: true


        });


        var marker = new google.maps.Marker({
            position: paris,
            map: map
        });
    }

</script>

<body>

<div class="mdl-layout mdl-js-layout">
    <header class="mdl-layout__header">
        <div class="mdl-layout-icon"></div>
        <div class="mdl-layout__header-row">
            <span class="mdl-layout__title">GeoQuizz</span>
            <div class="mdl-layout-spacer"></div>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout__title">GeoQuizz</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="#">Profile</a>
            <a class="mdl-navigation__link" href="#">Places</a>
            <a class="mdl-navigation__link" href="./stats/rank/ranking.php">Stats</a>
        </nav>
    </div>
    <main class="mdl-layout__content">
        <div>
            <div class="page-content">
                <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div id="map"></div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiqLa_cLhGPKGRxi4oW2DvyqM8hMPiu2Q&callback=initMap"
                            async defer></script>
                </div>
            </div>
        </div>
    </main>
</div>
</body>

</html>