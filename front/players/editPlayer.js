charger_joueur_depuis_serveur();

function charger_joueur_depuis_serveur() {

    $.ajax(
        {
            // Your server script to process the upload
            url: '/GeoQuizz/api/user/',
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
                            var unJoueur = resultat[i];
                            creer_vignette_joueur(unJoueur);
                        }

                    }
                });
                return myXhr;
            }
        });
}

//FAB display form
$('#b_add').on('click', function () {
    $('#mon_formulaire_ajout_joueur').fadeIn(500);
});

//After click on form
$('#bouton_enregistrer_joueur').on('click', function () {
    var login = $('#c_pseudo').val();
    // no id because its created directly from DB
    var lastName = $('#c_lastName').val();
    var firstName = $('#c_firstName').val();
    var address = $('#c_address').val();
    var email = $('#c_email').val();
    var image = $('#c_image').val();
    var password = $('#c_password').val();

    $('#mon_formulaire_ajout_joueur').fadeOut(500);

    //procéder à l'appel Ajajx pour ajouter sur le serveur le joueur , et on récupère le retour du serveur qui est en fait notre jeur créé en json (on avait deja toute le sinfos sauf l'ID
    var formData = new FormData();
    formData
        .append("login", login);
        //.append("FirstName", firstName)
        //.append("LastName", lastName)
        //.append("Email", email)
        //.append("Image", image)
        //.append("Password", password)
        //.append("Address", address);

    $.ajax(
        {
            // Your server script to process the upload
            url: '/GeoQuizz/api/user/add',
            type: 'POST',

            data: formData,
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
                        creer_vignette_joueur_data(resultat.login, resultat.firstName, resultat.lastName, resultat.registerDate, resultat.address, resultat.points);
                    }
                });
                return myXhr;
            }
        });


});

function creer_vignette_joueur_data(login, FirstName, LastName, RegisterDate, Address, Points) {
    var myPlayer = {
        login: login,
        firstName: FirstName,
        lastName: LastName,
        registerDate: RegisterDate,
        address: Address,
        points: Points
    };

    creer_vignette_joueur(myPlayer);
}

function creer_vignette_joueur(player) {

    var login; //en réalité ca devrait etre player.pseudo;
    var idPlayer;
    var adress;
    var firstName;
    var lastName;
    var points;
    var registerDate;
    if (player != null) {
        login = player.FirstName;
        idPlayer = player.id;
        registerDate = player.RegisterDate;
        adress = player.Address;
        firstName = player.FirstName;
        lastName = player.LastNale;
        points = player.Points;
    }

    //on procède a la création de la vignette

    var vignette_joueur = jQuery('<div/>', {}).appendTo($('#ma_grille_de_joueurs'));
    vignette_joueur.addClass('demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col');

    var titre_vignette_joueur = jQuery('<div/>', {}).appendTo(vignette_joueur);
    titre_vignette_joueur.addClass('mdl-card__title mdl-card--expand');

    var titre_vignette_joueur2 = jQuery('<h2/>', {
        text: login
    }).appendTo(titre_vignette_joueur);
    titre_vignette_joueur2.addClass('mdl-card__title-text');

    var texte_vignette_joueur = jQuery('<div/>', {
        text: registerDate
    }).appendTo(vignette_joueur);
    texte_vignette_joueur.addClass('mdl-card__supporting-text');

    var boutons_vignette_joueur = jQuery('<div/>', {}).appendTo(vignette_joueur);
    boutons_vignette_joueur.addClass('mdl-card__actions mdl-card--border');

    var bouton_modify_vignette_joueur = jQuery('<a/>', {
        text: "Modify"
    }).appendTo(boutons_vignette_joueur);
    bouton_modify_vignette_joueur.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect bouton_modifier');

    var bouton_ban_vignette_joueur = jQuery('<a/>', {
        text: "Ban"
    }).appendTo(boutons_vignette_joueur);
    bouton_ban_vignette_joueur.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect bouton_bannir');
    bouton_ban_vignette_joueur.attr('id', idPlayer);
    bouton_ban_vignette_joueur.on('click', function (e) {
        bannir_joueur(e.currentTarget);
    });

    var bouton_del_vignette_joueur = jQuery('<a/>', {
        text: "Delete"
    }).appendTo(boutons_vignette_joueur);
    bouton_del_vignette_joueur.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect bouton_supprimer');
    bouton_del_vignette_joueur.attr('id', idPlayer);
    bouton_del_vignette_joueur.on('click', function (e) {
        supprimer_vignette(e.currentTarget);
    })

}


//fonction de suppresssion du joueur
$('.bouton_supprimer').on('click', function (e) {
    supprimer_vignette(e.currentTarget);

});

$('.bouton_bannir').on('click', function (e) {
    bannir_joueur(e.currentTarget);
});

function bannir_joueur(joueur) {
    var id_joueur = joueur.getAttribute("id_joueur");

    $.ajax(
        {
            // Your server script to process the upload
            url: 'GeoQuizz/api/user/ban/' + id_joueur,
            type: 'POST',

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
                        resultat_connection(resultat);
                    }
                });
                return myXhr;
            }
        });
}


function supprimer_vignette(vignette) {
    var id_joueur = vignette.getAttribute("id_joueur");
    $($($(vignette).parent()).parent()).fadeOut(500);


    //procéder à l'appel Ajajx pour supprimer sur le serveur le joueur , on a son Id dans la var id_joueur


    $.ajax(
        {
            // Your server script to process the upload
            url: 'GeoQuizz/api/user/delete/' + id_joueur,
            type: 'POST',

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
                        var resultat = JSON.parse(myXhr.responseText)
                        resultat_connection(resultat);
                    }
                });
                return myXhr;
            },
        });

};