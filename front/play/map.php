<!DOCTYPE html>
<html lang="en">
<head>
    <?php include '../importScript.html' ?>
    <title>GeoQuizz</title>
    <script type="text/javascript" src="../editLogin.js"></script>
</head>
<body>
<div class="layoutHolder">
    <?php include_once "../shared/navbar.php" ?>
    <main class="mdl-layout__content">
        <div class="mdl-grid" id="ma_grille_de_lieux">
            <script type="text/javascript" src="./editMap.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiqLa_cLhGPKGRxi4oW2DvyqM8hMPiu2Q&callback=initMap"
                    async defer>
            </script>
        </div>
    </main>
</div>

</body>
</html>