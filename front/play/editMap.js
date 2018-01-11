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
    var idPlayer = Cookies.get('usrId');
    var json = {"usrId": idPlayer, "plcLat": pos.lat, "plcLon": pos.lng};
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

function creer_vignette_lieux_data(plcId, plcName, plcAddress, plcLat, plcLon, plcPrice, plcUsrIdOwner, code, plcImgUrl) {
    var myPlace = {
        plcId: plcId,
        plcName: plcName,
        plcAddress: plcAddress,
        plcLat: plcLat,
        plcLon: plcLon,
        plcPrice: plcPrice,
        plcUsrIdOwner: plcUsrIdOwner,
        plcCode: code,
        plcImgUrl: plcImgUrl
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
    var plcImgUrl;
    if (lieux != null) {
        plcId = lieux.plcId;
        plcName = lieux.plcName;
        plcAddress = lieux.plcAddress;
        plcLat = lieux.plcLat;
        plcLon = lieux.plcLon;
        plcPrice = lieux.plcPrice;
        plcUsrIdOwner = lieux.plcUsrIdOwner;
        plcCode = lieux.code;
        plcImgUrl = lieux.plcImgUrl;
    }
    var urlIcon;

    var cardWideInfo = jQuery('<div/>', {}).appendTo($('#ma_grille_de_lieux'));
    cardWideInfo.addClass('demo-card-wide mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col-phone');
    var cardTitle = jQuery('<div/>', {}).appendTo($(cardWideInfo));
    cardTitle.addClass('mdl-card__title style');
    cardTitle.css("background", "url(" + plcImgUrl + ") center / cover");
    var cardTitleText = jQuery('<h2/>', {text: plcName}).appendTo($(cardTitle));
    cardTitleText.addClass('mdl-card__title-text');
    var cardSupportingText = jQuery('<div/>', {text: plcAddress}).appendTo($(cardWideInfo));
    cardSupportingText.addClass('mdl-card__supporting-text');
    var cardAction = jQuery('<div/>', {}).appendTo($(cardWideInfo));
    cardAction.addClass = ('mdl-card__actions mdl-card--border');

    switch (parseInt(plcCode)) {

        case 1:
            var buttonTransaction1 = jQuery('<a/>', {text: "Sell for : " + (parseInt(plcPrice) * 3 / 4) + " pts"}).appendTo($(cardAction));
            buttonTransaction1.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect');
            //buttonTransaction.currentTarget(vendre)
            urlIcon = "../ressources/home-bought.png";
            buttonTransaction1.attr("idLieux", plcId);
            buttonTransaction1.attr("prixLieux", plcPrice);
            buttonTransaction1.on('click', function (e) {
                vendre_lieux(e.currentTarget);
            });
            break;

        case 2:
            if (plcUsrIdOwner === null) {
                urlIcon = "../ressources/home-free.png";
            }
            else {
                var info = jQuery('<div/>', {text: "Place owner: " + (plcUsrIdOwner)}).appendTo($(cardAction));
                info.addClass('mdl-card__supporting-text');
                urlIcon = "../ressources/home-owned.png";

            }
            break;

        case 3:
            var buttonTransaction3 = jQuery('<a/>', {text: "Buy for : " + parseInt(plcPrice) + " pts"}).appendTo($(cardAction));
            buttonTransaction3.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect');
            urlIcon = "../ressources/home-free.png";
            buttonTransaction3.attr("idLieux", plcId);
            buttonTransaction3.attr("prixLieux", plcPrice);
            buttonTransaction3.on('click', function (e) {
                acheter_lieux(e.currentTarget);
            });
            break;

        case 4:
            var info = jQuery('<p/>', {text: "Place owner: " + (plcUsrIdOwner)}).appendTo($(cardAction));
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

    var infowindow = new google.maps.InfoWindow({
        content: cardWideInfo[0]
    });
}
    function vendre_lieux(bouton) {
        var idLieux = bouton.getAttribute("idLieux");
        var prixLieux = bouton.getAttribute("prixLieux");
        var idPlayer = Cookies.get('usrId');
        $.ajax(
            {
                // Your server script to process the upload
                url: '/GeoQuizz/api/user/' + idPlayer,
                type: 'GET',

                // Tell jQuery not to process data or worry about content-type
                // You must include these options!
                cache: false,
                contentType: false,
                processData: false,

                // Custom XMLHttpRequest
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();

                    myXhr.addEventListener('readystatechange', function () {
                        if (myXhr.readyState == XMLHttpRequest.DONE && myXhr.status == 200) {
                            console.log(myXhr.responseText);
                            var resultat = JSON.parse(myXhr.responseText);

                            for (var i = 0; i < resultat.length; i++) {
                                var player = resultat[i];
                                sellPlace(player);
                            }
                        }
                    });
                    return myXhr;
                }
            });

        function sellPlace(player) {
            var usrId = player.usrId;

            var json ={"transType":3,"transPoints":parseInt(prixLieux),"transUsrIdBuyer":usrId,"transUsrIdSeller":null ,"transPlaceId":parseInt(idLieux) };
            $.ajax(
                {
                    // Your server script to process the upload
                    //TODO MODIFY
                    url: '/GeoQuizz/api/transaction',
                    type: "POST",
                    data: "[" + JSON.stringify(json) + "]",
                    contentType: 'application/json',
                    dataType: 'json',

                    // Custom XMLHttpRequest
                    xhr: function () {
                        var myXhr = $.ajaxSettings.xhr();

                        myXhr.addEventListener('readystatechange', function () {
                            if (myXhr.readyState == XMLHttpRequest.DONE && myXhr.status == 200) {
                                console.log(myXhr.responseText);
                                var resultat = JSON.parse(myXhr.responseText);
                                var message = resultat.msg;
                              //  snackbar(message);
                            }
                        });
                        return myXhr;
                    }
                });
        }

      /*  function snackbar(message){
            var demoToast = jQuery('<div/>', {});
                demoToast.addClass("mdl-js-snackbar mdl-snackbar");
                demoToast.attr("id", "demo-toast-example");

            var mdlSnack = jQuery('<div/>', {}).appendTo(demoToast);
            mdlSnack.addClass("mdl-snackbar__text");

            var mdlSnackAction = jQuery('<button/>', {}).appendTo(demoToast);
            mdlSnackAction.addClass("mdl-snackbar__action");
            mdlSnackAction.attr("type", "button");

            var snackbarContainer = document.querySelector('#demo-toast-example');
            var data = {message: message};
            snackbarContainer.MaterialSnackbar.showSnackbar(data);
        }*/
    }

function acheter_lieux(bouton) {
    var idLieux = bouton.getAttribute("idLieux");
    var prixLieux = bouton.getAttribute("prixLieux");
    var idPlayer = Cookies.get('usrId');
    $.ajax(
        {
            // Your server script to process the upload
            url: '/GeoQuizz/api/user/' + idPlayer,
            type: 'GET',

            // Tell jQuery not to process data or worry about content-type
            // You must include these options!
            cache: false,
            contentType: false,
            processData: false,

            // Custom XMLHttpRequest
            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();

                myXhr.addEventListener('readystatechange', function () {
                    if (myXhr.readyState == XMLHttpRequest.DONE && myXhr.status == 200) {
                        console.log(myXhr.responseText);
                        var resultat = JSON.parse(myXhr.responseText);

                        for (var i = 0; i < resultat.length; i++) {
                            var player = resultat[i];
                            buyPlace(player);
                        }
                    }
                });
                return myXhr;
            }
        });

    function buyPlace(playerId) {
        var usrId = playerId.usrId;

        var json ={"transType":1,"transPoints":parseInt(prixLieux),"transUsrIdBuyer":usrId,"transUsrIdSeller":null ,"transPlaceId":parseInt(idLieux) };
        $.ajax(
            {

                url: '/GeoQuizz/api/transaction',
                type: "POST",
                data: "[" + JSON.stringify(json) + "]",
                contentType: 'application/json',
                dataType: 'json',

                // Custom XMLHttpRequest
                xhr: function () {
                    var myXhr = $.ajaxSettings.xhr();

                    myXhr.addEventListener('readystatechange', function () {
                        if (myXhr.readyState == XMLHttpRequest.DONE && myXhr.status == 200) {
                            console.log(myXhr.responseText);
                            var resultat = JSON.parse(myXhr.responseText);
                            var message = resultat.msg;
                        }
                    });
                    return myXhr;
                }
            });
    }

}