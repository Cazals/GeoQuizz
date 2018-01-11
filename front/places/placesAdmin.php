<html>
<head>
    <?php include '../importScript.html' ?>
</head>
<body>
<div class="layoutHolder">
    <?php include_once '../shared/navbar.php' ?>
    <!-- Start your content here !! you dumb -->
    <main class="mdl-layout__content">
        <div class="mdl-grid" id="placeGrid">
        </div>
        <button id="b_add"
                class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </button>
    </main>
</div>

<div id="mon_formulaire_ajout_lieux" class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--8-col" style="display:none;">
    <div class="mdl-card__supporting-text">
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="c_plcName"/>
            <label class="mdl-textfield__label" for="c_plcName">Name</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="c_plcPrice"/>
            <label class="mdl-textfield__label" for="c_plcPrice">Price</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="c_plcLat"/>
            <label class="mdl-textfield__label" for="c_plcLat">Latitude</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="c_plcLon"/>
            <label class="mdl-textfield__label" for="c_plcLon">Longitude</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="c_plcAddress"/>
            <label class="mdl-textfield__label" for="c_plcAddress">Address</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="text" id="c_plcWkPrice"/>
            <label class="mdl-textfield__label" for="c_plcWkPrice">WalkPrice</label>
        </div>
        <div class="mdl-textfield mdl-js-textfield">
            <input class="mdl-textfield__input" type="url" id="c_plcImgUrl"/>
            <label class="mdl-textfield__label" for="c_plcImgUrl">Image</label>
        </div>
    </div>
    <div class="mdl-card__actions mdl-card--border">
        <a id="bouton_enregistrer_lieux">
            <button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                Enregistrer
            </button>
        </a>
    </div>
</div>

<script type="text/javascript" src="editPlaces.js"></script>

</body>
</html>

