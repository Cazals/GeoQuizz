$('#b_add').on('click',function(){
    $('#mon_formulaire_ajout_joueur').fadeIn(500);
});
$('#monBoutton2').on('click',function(){$('#maDiv').hide()});

charger_joueur_depuis_serveur();
function charger_joueur_depuis_serveur(){
    //simiulation a jarter
    for(var i=0;i<5;i++) {
        creer_vignette_joueur_data("joueur " + i,i);
    }

    //Vrai appel
    $.ajax(
        {
            // Your server script to process the upload
            url: '/monserveur/get_joueurs',
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
                        var resultat = JSON.parse(myXhr.responseText);
                        for(var i=0;i<resultat.length;i++){
                            var unJoueur=resultat[i];
                            creer_vignette_joueur(unJoueur);
                        }

                    }
                });
                return myXhr;
            },
        });
}

$('#bouton_enregistrer_joueur').on('click',function(){
    var pseudo_joueur = $('#c_pseudo').val();
    $('#mon_formulaire_ajout_joueur').fadeOut(500);

    //ligne suivante a supprimer lorsque l'appel ajax marchera (des qu'on a un serveur)
    creer_vignette_joueur(null);

    //procéder à l'appel Ajajx pour ajouter sur le serveur le joueur , et on récupère le retour du serveur qui est en fait notre jeur créé en json (on avait deja toute le sinfos sauf l'ID
    var formData = new FormData();
    formData.append("pseudo_joueur", pseudo_joueur);

    $.ajax(
        {
            // Your server script to process the upload
            url: '/monserveur/ajouter_joueuer',
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
                        var resultat = JSON.parse(myXhr.responseText)
                        creer_vignette_joueur(resultat);
                    }
                });
                return myXhr;
            },
        });


});

function creer_vignette_joueur_data(pseudo,id)
{
    var monJoueur={pseudo:pseudo,id:id};
    creer_vignette_joueur(monJoueur)
}

function creer_vignette_joueur(un_joueur)
{
    var pseudo_joueur="toto"; //en réalité ca devrait etre un_joueur.pseudo;
    var id_joueur = "5";
    if(un_joueur != null){
        pseudo_joueur=un_joueur.pseudo;
        id_joueur=un_joueur.id;
    }


    //on procède a la cration de la vignette

    var vignette_joueur = jQuery('<div/>', {
    }).appendTo($('#ma_grille_de_joueurs'));
    vignette_joueur.addClass('demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col');

    var titre_vignette_joueur = jQuery('<div/>', {
    }).appendTo(vignette_joueur);
    titre_vignette_joueur.addClass('mdl-card__title mdl-card--expand');

    var titre_vignette_joueur2 = jQuery('<h2/>', {
        text:pseudo_joueur,
    }).appendTo(titre_vignette_joueur);
    titre_vignette_joueur2.addClass('mdl-card__title-text');

    var texte_vignette_joueur = jQuery('<div/>', {
        text : "description"
    }).appendTo(vignette_joueur);
    texte_vignette_joueur.addClass('mdl-card__supporting-text');

    var boutons_vignette_joueur = jQuery('<div/>', {
    }).appendTo(vignette_joueur);
    boutons_vignette_joueur.addClass('mdl-card__actions mdl-card--border');

    var bouton_modify_vignette_joueur = jQuery('<a/>', {
        text : "Modify"
    }).appendTo(boutons_vignette_joueur);
    bouton_modify_vignette_joueur.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect');

    var bouton_del_vignette_joueur = jQuery('<a/>', {
        text : "Delete"
    }).appendTo(boutons_vignette_joueur);
    bouton_del_vignette_joueur.addClass('mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect bouton_supprimer');
    bouton_del_vignette_joueur.attr('id_joueur',id_joueur);
    bouton_del_vignette_joueur.on('click',function(e){
        supprimer_vignette(e.currentTarget);
    })

}


//fonction de suppresssion du joueur
$('.bouton_supprimer').on('click',function(e) {
    supprimer_vignette(e.currentTarget);

});
function supprimer_vignette(vignette){
   var id_joueur=vignette.getAttribute("id_joueur");
   $($($(vignette).parent()).parent()).fadeOut(500);


   //procéder à l'appel Ajajx pour supprimer sur le serveur le joueur , on a son Id dans la var id_joueur
    var formData = new FormData();
    formData.append("id_joueur", id_joueur);

    $.ajax(
        {
            // Your server script to process the upload
            url: '/monserveur/delete_joueuer',
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
                        var resultat = JSON.parse(myXhr.responseText)
                        resultat_connection(resultat);
                    }
                });
                return myXhr;
            },
        });

};