<html>
<head>
    <?php include '../importScript.html' ?>
</head>
<body>
<div class="layoutHolder">
    <?php include_once '../shared/navbar.php' ?>
    <!-- Start your content here !! you dumb -->
    <main class="mdl-layout__content">
        <div class="mdl-grid">
            <?php for ($i = 0; $i < 5; $i++) {
                echo '<div class="demo-card-square mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col">
                <div class="mdl-card__title mdl-card--expand">
                    <h2 class="mdl-card__title-text">Pseudo</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Aenan convallis.
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Modify
                    </a>
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Delete
                    </a>
                </div>
            </div>';
            } ?>
        </div>
        <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
            <i class="material-icons">add</i>
        </button>
    </main>
</div>


</body>
</html>
