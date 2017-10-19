<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './importScript.html' ?>
    <meta charset="UTF-8">
    <title>RiddleCamp</title>
</head>
<script>


    var myLatLng = {
        lat: 52.078874,
        lng: 4.312620
    };

    function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            center: uluru
        });
        var marker = new google.maps.Marker({
            position: uluru,
            map: map
        });
    }

</script>

<body>
<div class="demo-card-wide mdl-card mdl-shadow--2dp">
    <div id="map"></div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiqLa_cLhGPKGRxi4oW2DvyqM8hMPiu2Q&callback=initMap"
            async defer></script>

</div>

</body>


</html>