load_places();

function load_places() {

    $.ajax(
        {
            // Your server script to process the upload
            url: '/GeoQuizz/api/place/',
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
                            var place = resultat[i];
                            create_places(place);
                        }
                    }
                });
                return myXhr;
            }
        });
}

//FAB display form
$('#b_add').on('click', function () {
    $('#mon_formulaire_ajout_lieux').fadeIn(500);
});

//After click on form
$('#bouton_enregistrer_lieux').on('click', function () {
    var plcName = $('#c_plcName').val();
    // no id because its created directly from DB
    var plcAddress = $('#c_plcAddress').val();
    var plcLat = $('#c_plcLat').val();
    var plcLon = $('#c_plcLon').val();
    var plcPrice = $('#c_plcPrice').val();
    var plcWkPrice = $('#c_plcWkPrice').val();
    var plcImgUrl = $('#c_plcImgUrl').val();

    $('#mon_formulaire_ajout_lieux').fadeOut(500);

    //procéder à l'appel Ajajx pour ajouter sur le serveur le joueur , et on récupère le retour du serveur qui est en fait notre jeur créé en json (on avait deja toute le sinfos sauf l'ID

    $.ajax(
        {
            // Your server script to process the upload
            url: '/GeoQuizz/api/place?'+'plcName='+plcName+'plcAddress='+plcAddress+'plcLat='+plcLat+'plcLon='+plcLon+'plcPrice='+plcPrice+'plcWkPrice='+plcWkPrice+'plcImgUrl='+plcImgUrl,
            type: 'POST',
            contentType: false,

            xhr: function () {
                var myXhr = $.ajaxSettings.xhr();

                myXhr.addEventListener('readystatechange', function () {
                    if (myXhr.readyState == XMLHttpRequest.DONE && myXhr.status == 200) {
                        var resultat = JSON.parse(myXhr.responseText);

                        for (var i = 0; i < resultat.length; i++) {
                            var place = resultat[i];
                            create_places(place);
                        }
                    }
                });
                return myXhr;
            }
        });
});

function creer_vignette_joueur_lieux(place) {
    create_places(place);
}

function create_places(place) {

    var plcName;
    var plcId;
    var plcAddress;
    var plcLat;
    var plcLon;
    var plcPrice;
    var plcWkPrice;
    var plcUsrIdOwner;
    var plcImgUrl;
    if (place != null) {
        plcName = place.plcName;
        plcId = place.plcId;
        plcAddress = place.plcAddress;
        plcLat = place.plcLat;
        plcLon = place.plcLon;
        plcPrice = place.plcPrice;
        plcWkPrice = place.plcWkPrice;
        plcUsrIdOwner = place.plcUsrIdOwner;
        plcImgUrl = place.plcImgUrl;
    }

    //on procède a la création de la vignette

    var vignette_lieux = jQuery('<div/>', {}).appendTo($('#placeGrid'));
    vignette_lieux.addClass('demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col');

    var titre_vignette_lieux = jQuery('<div/>', {}).appendTo(vignette_lieux);
    titre_vignette_lieux.addClass('mdl-card__title mdl-card--expand');

    titre_vignette_lieux.css("background", "url(" + plcImgUrl + ") center / cover");
    var titre_vignette_lieux_text = jQuery('<h2/>', {
        text: plcName
    }).appendTo(titre_vignette_lieux);
    titre_vignette_lieux_text.addClass('mdl-card__title-text');

    var texte_vignette_lieux = jQuery('<div/>', {
        text: plcAddress + ' position: (' + plcLon + ', ' + plcLat + ')'
    }).appendTo(vignette_lieux);
    texte_vignette_lieux.addClass('mdl-card__supporting-text');

    var boutons_vignette_lieux = jQuery('<div/>', {}).appendTo(vignette_lieux);
    boutons_vignette_lieux.addClass('mdl-card__actions mdl-card--border');

    var bouton_modify_vignette_lieux = jQuery('<a/>', {
        text: "Modify"
    }).appendTo(boutons_vignette_lieux);
    bouton_modify_vignette_lieux.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect modifyPlaceButton');
    bouton_modify_vignette_lieux.attr('plcId', plcId);

    var bouton_del_vignette_lieux = jQuery('<a/>', {
        text: "Delete"
    }).appendTo(boutons_vignette_lieux);
    bouton_del_vignette_lieux.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect deletePlaceButton');
    bouton_del_vignette_lieux.attr('plcId', plcId);
    bouton_del_vignette_lieux.on('click', function (e) {
        supprimer_vignette_place(e.currentTarget);
    })

}


//fonction de suppresssion du lieux
$('.deletePlaceButton').on('click', function (e) {
    supprimer_vignette(e.currentTarget);

});

function supprimer_vignette_place(vignette) {
    var id_place = vignette.getAttribute("plcId");
    $($($(vignette).parent()).parent()).fadeOut(500);



    $.ajax(
        {
            // Your server script to process the upload
            url: 'GeoQuizz/api/place/' + id_place,
            type: 'DELETE',

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
                        var resultat = JSON.parse(myXhr.responseText);
                    }
                });
                return myXhr;
            },
        });

};