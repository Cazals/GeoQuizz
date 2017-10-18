<script>
point = new google.maps.LatLng(47.5,49.4);
// je crée un marqueur
marker = new google.maps.Marker({ position:point , title:'mon point'});

// je positionne le marqueur sur une carte
// (on suppose ici que carte est une variable globale ?
// contenant la réf vers l'objet googlemap)
marker.setMap(carte);

// je centre la carte sur ce nouveau point
carte.panTo(point);

</script>