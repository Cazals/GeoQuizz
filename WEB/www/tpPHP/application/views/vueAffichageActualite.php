<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Lister Tout</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body>

<div class="container-fluid">
	<h1>Super site php</h1>
    
    <div>
        <ul>
    <?php
    if($etat == "grille"){
        foreach ($resultat as $ligne)
        {
            echo "<div class='col-sm-4' style='background-color:lavender;min-height:300px'> <div>".$ligne['id'];
			echo "</div> <div>".$ligne['titre'];
			echo "</div> <img src='".$ligne['image']."' class='img-responsive' alt='Cinque Terre' style='min-height:200px;max-height:200px' >";
			echo "<div style='min-height:50px'>".$ligne['texte']."</div>";
			echo "<div>".$ligne['dateActualite']."</div>";
			echo "</div>";
        }
    }else{
        foreach ($resultat as $ligne)
        {
			echo "<div class='col-sm-12' style='background-color:lavender;min-height:300px'> <div>".$ligne['id'];
			echo "</div> <div>".$ligne['titre'];
			echo "</div> <img src='".$ligne['image']."' class='img-responsive' alt='Cinque Terre' style='min-height:200px;max-height:200px' >";
			echo "<div style='min-height:150px'>".$ligne['texte']."</div>";
			echo "<div>".$ligne['dateActualite']."</div>";
			echo "</div>";
        }
    }
        
    ?>
            </ul>
    </div>
    

</div>

</body>
</html>