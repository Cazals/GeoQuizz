<?php
header("Content-Type:application/json");




echo "<head>
  <title>Bootstrap Example</title>
  <meta charset=\"utf-8\">
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\">
  <script src=\"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js\"></script>
  <script src=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js\"></script>
</head>
";

$pdo="";
$user="root";
$pass="root";
try {
    $pdo = new PDO('mysql:host=localhost;dbname=jcdecaux;charset=UTF8', $user, $pass);
} catch (PDOException $e) {
    echo "Erreur a la connexion BDD: " . $e->getMessage() . "<br/>";
    die();
}


// ---------------------------------------------
// construction et execution de la requete ...
// exemple requete Select
try {

    //$prix=12.9;
    //$stock=10;

    $query="SELECT *
            FROM stations
            ";

    //$tabvaleurs=array($prix, $stock);

    $stmt = $pdo->prepare($query);
    $stmt->execute();
    //$stmt->execute($tabvaleurs);



//$tab = array(
  //  '1' => 'toto',
    //'2' => array(
      //  '1' => 'ttttt'
  //  )
//);

//foreach ($tab as $k"")

echo "<body>
<div class=\"jumbotron text-center\">
  <h1>Les vélibs de paris</h1>
  <p>Youhou c'est la fête!</p> 
</div>
  
<div class=\"container\">
  <div class=\"row\">";

while ($ligne = $stmt->fetch()) {
    echo "<div class=\"col-sm-4\">";
    echo "<div class=\"col-sm-12\"> <img src=\" ";
    echo "http://media.rtl.fr/cache/sMsSTndUlztrBQF9GFJFDA/880v587-0/online/image/2010/1220/7644428956_une-station-de-velib-a-paris.jpg";
    echo "\" alt=\"\" />";
    echo "<div class=\"col-sm-12\">";
    echo "<h3>Adresse</h3>";
    echo "<p>";
    echo $ligne['adresse'];
    echo "</p>";
    echo "<h1>Nb Vélos dispo</h1>";
    echo "<p>";
    echo $ligne['available_bikes'];
    echo "</p>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

echo "</div>
</div>
</body>
</html>
"