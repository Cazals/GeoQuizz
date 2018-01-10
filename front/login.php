<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './importScript.html' ?>
    <title>GeoQuizz</title>
</head>
<body>
<div class="mdl-layout mdl-js-layout mdl-color--grey-100">
    <main class="mdl-layout__content">
        <div class="mdl-grid">
            <div class="mdl-card mdl-shadow--6dp mdl-cell mdl-cell--12-col mdl-cell--4-col-phone">
                <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
                    <img class="logo " src="ressources/geoQuizz.png"/>
                </div>
                <div class="mdl-card__supporting-text">
                    <script type="text/javascript">
                        var formData = JSON.stringify($("#login").serializeArray())
                    </script>
                    <form id="login">
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="text" id="c_login"/>
                            <label class="mdl-textfield__label" for="username">Username</label>
                        </div>
                        <div class="mdl-textfield mdl-js-textfield">
                            <input class="mdl-textfield__input" type="password" id="c_password"/>
                            <label class="mdl-textfield__label" for="userpass">Password</label>
                        </div>
                    </form>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a href="play/map.php" id="bouton_login">
                        <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Log in
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>
<script src="editLogin.js"></script>
</body>
</html>