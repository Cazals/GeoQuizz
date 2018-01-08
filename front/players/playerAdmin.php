<html>
<head>
    <?php include '../importScript.html' ?>

</head>
<body>


<div class="layoutHolder">
    <?php include_once '../shared/navbar.php' ?>
    <!-- Start your content here !! you dumb -->
    <main class="mdl-layout__content">
        <div class="mdl-grid" id="ma_grille_de_joueurs">

            <div class="demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col" id="maDiv"
                 style="display: none">
                <div class="mdl-card__title mdl-card--expand">
                    <h2 class="mdl-card__title-text">Pseudo</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    Mon test Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenan convallis.
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="monBoutton2">
                        Modify
                    </a>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect bouton_supprimer"
                       id_joueur="4">
                        Bann
                    </a>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect bouton_supprimer"
                       id_joueur="4">
                        Delete
                    </a>
                </div>
            </div>
        </div>
        <button id="b_add"
                class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </button>
    </main>
</div>

<div id="mon_formulaire_ajout_joueur" class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--8-col" style="display:none;">
    <div class="mdl-card__supporting-text">
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="c_pseudo"/>
            <label class="mdl-textfield__label" for="c_pseudo">Login</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="email"  id="c_email"/>
            <label class="mdl-textfield__label" for="c_email">Email</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text"  id="c_firstName"/>
            <label class="mdl-textfield__label" for="c_firstName">FirstName</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text"  id="c_lastName"/>
            <label class="mdl-textfield__label" for="c_lastName">LastName</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="c_address"/>
            <label class="mdl-textfield__label" for="c_address">Adress</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="password" id="c_password"/>
            <label class="mdl-textfield__label" for="c_password">Password</label>
        </div>
            <input class="mdl-textfield__input" type="file" id="c_image">
        </div>
        <div class="mdl-card__actions mdl-card--border">
            <a id="bouton_enregistrer_joueur">
                <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                    Enregistrer
                </button>
            </a>
        </div>
    </div>
</div>

<script type="text/javascript" src="editPlayer.js"></script>

</body>
</html>
