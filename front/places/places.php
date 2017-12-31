<html>
<head>
    <?php include '../importScript.html' ?>
</head>
<body>
<div class="layoutHolder">
<?php include_once '../shared/navbar.php'?>
        <!-- Start your content here !! you dumb -->
        <main class="mdl-layout__content">
            <div class = "mdl-grid">
            <?php for($i=0; $i<5; $i++) {
                echo '<div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col-phone">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Name of that place</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    This is  the description of one of the place that you owned.Here you can sell it or even see how many points you have earned with it
                </div>
                <div class="mdl-card__actions mdl-card--border">
                    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                        Sell this place
                    </a>
                </div>
                <div class="mdl-card__menu">
                    <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                        <i class="material-icons">share</i>
                    </button>
                </div>
            </div>';}?>
            </div>
        </main>
</div>


</body>
</html>

<script>
    $(document).ready(function () {
        $('#navigation').load('shared/navbar.php');
        $('#footer').load('shared/footer.php');
        $('#importScript').load('../importScript.html');
    });
</script>
