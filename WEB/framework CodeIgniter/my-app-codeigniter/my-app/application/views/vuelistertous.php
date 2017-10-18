?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
</head>
<body>

<div id="container">
	<h1>Blablabla ..... </h1>

	<div>
		<p>Ceci est la vue de mon opération Lister.</p>
        
	</div>
    
    <div>
        <ul>
    <?php
        foreach ($resultat as $ligne)
        {
            echo "<li>".$ligne['id']." - ";
            echo $ligne['nom']." - ";
            echo $ligne['prix']."</li>";
        }
        
    ?>
            </ul>
    </div>

</div>

</body>
</html>