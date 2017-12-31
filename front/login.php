<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './importScript.html' ?>
    <title>GeoQuizz</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-color--grey-100">
    <main class="mdl-layout__content">
        <div class="mdl-card mdl-shadow--6dp mdl-cell--12-col">
            <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                <img class = "logo " src="ressources/geoQuizz.png"/>
            </div>
            <div class="mdl-card__supporting-text">
                <script type="text/javascript">
                    var formData = JSON.stringify($("#login").serializeArray())
                    </script>
                <form id="login" action="localhost:8080\GeoQuizz\api\login\" method="POST">
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="username" />
                        <label class="mdl-textfield__label" for="username">Username</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="password" id="userpass" />
                        <label class="mdl-textfield__label" for="userpass">Password</label>
                    </div>
                </form>
            </div>
            <div class="mdl-card__actions mdl-card--border">
                <a href="play/map.php"><button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Log in</button></a>
            </div>
        </div>
    </main>
</div>
</body>
</html>