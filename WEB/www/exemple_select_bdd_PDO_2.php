<?php
header("Content-Type:application/json");
// ***********
// EXEMPLE CODE ENVOI REQUETE DE TYPE SELECT
// utilisation de PDO 
// on se base ici sur une table "Produit" fictive
// ***********
    
if(isset($_GET['ville'])){
    $ville=$_GET['ville'];
}

//var_dump($ville);

// ---------------------------------------------
// connexion BDD (ici : Mysql)
    
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

} catch (PDOException $e) {
    echo "Erreur a la requete Select : " . $e->getMessage() . "<br/>";
    die();
}


$json = json_encode($stmt->fetchAll());


echo $json;