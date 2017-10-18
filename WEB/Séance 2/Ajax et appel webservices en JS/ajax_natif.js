function loadXMLDoc() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
           if (xmlhttp.status == 200) {
               document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
           }
           else if (xmlhttp.status == 400) {
              alert('erreur 400');
           }
           else {
               alert('autre erreur ...');
           }
        }
    };

    xmlhttp.open("GET", "http://monsite.com/service.php?param=4", true);
    xmlhttp.send();
}
