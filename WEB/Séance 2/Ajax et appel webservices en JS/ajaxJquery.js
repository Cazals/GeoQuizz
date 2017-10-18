function callbackSucces(donnees) {
	// je récupere le résultat de l'appel webservices
	console.log(donnees)
		
}

// appel web service type post
$.ajax({
			url: "http://monsite.com/service.php?param=4",
			type: "GET",
			dataType: "json", // optionnel : format que je souhaite en réponse. si pas le cas je partirai en erreur!
			success: callbackSucces, // fonction de callback
			error: function(data) {
				console.log("Erreur Ajax :" + data);
			}
});