    <!-- must be contain in a div ... it should not be directly inside the body -->
    <!-- This is the layout where you should put contents in main div -->
    <div class="mdl-layout mdl-js-layout">
        <!-- NAVBAR on Laptop -->
        <header class="mdl-layout__header">
            <div class="mdl-layout-icon"></div>
            <div class="mdl-layout__header-row">
                <span class="mdl-layout__title">GeoQuizz</span>
                <!--Align header links to the right-->
                <div class="mdl-layout-spacer">
                </div>
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link" href="../play/map.php">Play</a>
                    <a class="mdl-navigation__link" href="../players/myProfile.php">Player</a>
                    <a class="mdl-navigation__link" href="../places/places.php">Places</a>
                    <a class="mdl-navigation__link" href="../stats/ranking.php">Statistics</a>
                </nav>
        </header>
        <!-- End of NAVBAR on laptop -->
        <!-- NAVBAR on Phone -->
        <div class="mdl-layout__drawer">
            <span class="mdl-layout__title">GeoQuizz
                <a href="../login.php">
                    <button class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons logout">power_settings_new</i>
                    </button>
                </a>
            </span>
            <nav class="mdl-navigation">
                <a class="mdl-navigation__link" href="../play/map.php">Play</a>
                <a class="mdl-navigation__link" href="../players/myProfile.php">Player</a>
                <a class="mdl-navigation__link" href="../places/places.php">Places</a>
                <a class="mdl-navigation__link" href="../stats/ranking.php">Statistics</a>
            </nav>
        </div>
        <!-- End of NAVBAR on Phone -->