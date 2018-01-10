function getcurrentposition() {
// Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            window.pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            var myIcon = {
                url: "../ressources/position.png",
                scaledSize: new google.maps.Size(60, 60) // scaled size
            };

            //Marker for current position
            var myPosition = new google.maps.Marker({
                map: window.map,
                icon: myIcon,
                title: 'My position',
                animation: google.maps.Animation.DROP

            });



            myPosition.setPosition(window.pos);
            map.setCenter(window.pos);

            charger_lieux_depuis_serveur(window.pos);

        }, function () {
            handleLocationError(true, myPosition, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, myPosition, map.getCenter());
    }

}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Error: The Geolocation service failed.' :
        'Error: Your browser doesn\'t support geolocation.');
}

function initMap() {


    //on procède a la création de la vignette

    var pageContent = jQuery('<div/>', {}).appendTo($('#ma_grille_de_lieux'));
    pageContent.addClass("page-content");

    var cardWide = jQuery('<div/>', {}).appendTo($(pageContent));
    cardWide.addClass("demo-card-wide mdl-card mdl-shadow--2dp");

    var map = jQuery('<div/>', {}).appendTo($(cardWide));
    map.addClass("mdl-cell--4-col-phone");
    map.attr('id', 'map');


    window.map = new google.maps.Map(document.getElementById('map'), {
        zoom: 17,
        disableDefaultUI: true
    });
    getcurrentposition();
}

function charger_lieux_depuis_serveur(pos) {

    var json = {"usrId": 3, "plcLat": pos.lat, "plcLon": pos.lng};
    $.ajax(
        {
            // Your server script to process the upload
            url: '/GeoQuizz/api/walk/',
            type: "POST",
            data: "[" + JSON.stringify(json) + "]",
            contentType: 'application/json',
            dataType: 'json',

            // Custom XMLHttpRequest
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();

                myXhr.addEventListener('readystatechange', function () {
                    if (myXhr.readyState == XMLHttpRequest.DONE && myXhr.status == 200) {
                        var resultat = JSON.parse(myXhr.responseText);

                        for (var i = 0; i < resultat.length; i++) {
                            var lieuxVisible = resultat[i];
                            creer_vignette_lieux(lieuxVisible);
                        }
                    }
                });
                return myXhr;
            }
        });
}

function creer_vignette_lieux_data(plcId, plcName, plcAddress, plcLat, plcLon, plcPrice, plcUsrIdOwner, code) {
    var myPlace = {
        plcId: plcId,
        plcName: plcName,
        plcAddress: plcAddress,
        plcLat: plcLat,
        plcLon: plcLon,
        plcPrice: plcPrice,
        plcUsrIdOwner: plcUsrIdOwner,
        plcCode: code
    };

    creer_vignette_lieux(myPlace);
}

function creer_vignette_lieux(lieux) {

    var plcId; //en réalité ca devrait etre player.pseudo;
    var plcName;
    var plcAddress;
    var plcLat;
    var plcLon;
    var plcPrice;
    var plcUsrIdOwner;
    var plcCode;
    if (lieux != null) {
        plcId = lieux.plcId;
        plcName = lieux.plcName;
        plcAddress = lieux.plcAddress;
        plcLat = lieux.plcLat;
        plcLon = lieux.plcLon;
        plcPrice = lieux.plcPrice;
        plcUsrIdOwner = lieux.plcUsrIdOwner;
        plcCode = lieux.code;
    }

    var cardWideInfo = jQuery('<div/>', {});
    cardWideInfo.addClass('demo-card-wide mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col-phone');
    var cardTitle = jQuery('<div/>', {}).appendTo($(cardWideInfo));
    cardTitle.addClass('mdl-card__title port');
    var cardTitleText = jQuery('<h2/>', {text: plcName}).appendTo($(cardTitle));
    cardTitleText.addClass('mdl-card__title-text');
    var cardSupportingText = jQuery('<div/>', {text: plcAddress}).appendTo($(cardTitleText));
    cardSupportingText.addClass('mdl-card__supporting-text');
    var cardAction = jQuery('<div/>', {}).appendTo($(cardWideInfo));
    cardAction.addClass = ('mdl-card__actions mdl-card--border');

    var urlIcon;

    switch (parseInt(plcCode)) {
        case 1:
            var buttonTransaction1 = jQuery('<a/>', {text: "Sell for : " + ((plcPrice*3)/4) + "pts" }).appendTo($(cardAction));
            buttonTransaction1.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect');
            //buttonTransaction.currentTarget(vendre)
            urlIcon = "../ressources/home-bought.png";
            break;
        case 2:
            urlIcon = "../ressources/home-owned.png";
            break;
        case 3:
            var buttonTransaction3 = jQuery('<a/>', {text: "Buy for : " + plcPrice + "pts"}).appendTo($(cardAction));
            buttonTransaction3.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect');
            urlIcon = "../ressources/home-free.png";
            break;
        case 4:
            urlIcon = ("../ressources/home-owned.png");
            break;
        //buttonTransaction.currentTarget(vendre)
    }


    //SET ICON PLACE
    var placeIcon = {
        url: urlIcon,
        scaledSize: new google.maps.Size(40, 40) // scaled size
    };


    var places = new google.maps.Marker({
        map: window.map,
        title: plcName,
        icon: placeIcon,

        position: {
            lat: parseFloat(plcLat),
            lng: parseFloat(plcLon)
        }
    });

    //INFOWINDOW for each places
    places.addListener('click', function () {
        infowindow.open(window.map, places);
    });
    var styleInfoWindow = jQuery('<style/>', {text: ".demo-card-wide > .port{background: url('../ressources/port.jpg') center / cover}"});
    var infowindow = new google.maps.InfoWindow({
        content: cardWideInfo + styleInfoWindow
    });



}