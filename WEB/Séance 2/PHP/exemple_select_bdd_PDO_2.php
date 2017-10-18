<?php
// ***********
// EXEMPLE CODE ENVOI REQUETE DE TYPE SELECT
// utilisation de PDO 
// on se base ici sur une table "Produit" fictive
// ***********
    

// ---------------------------------------------
// connexion BDD (ici : Mysql)
    
$pdo="";
$user="toto";
$pass="tutu";
try {
    $pdo = new PDO('mysql:host=localhost;dbname=test', $user, $pass);
} catch (PDOException $e) {
  echo "Erreur a la connexion BDD: " . $e->getMessage() . "<br/>";
    die();
}


// ---------------------------------------------
// construction et execution de la requete ...
// exemple requete Select
try {
    
    $prix=12.9;
    $stock=10;
    
    $query="SELECT *
            FROM produits
            WHERE prix>? and quantite>?
            ";

    $tabvaleurs=array($prix, $stock);

	$stmt = $pdo->prepare($query);
	$stmt->execute($tabvaleurs);

} catch (PDOException $e) {
    echo "Erreur a la requete Select : " . $e->getMessage() . "<br/>";
    die();
}




// ---------------------------------------------
// Exemple de traitement des résultats
// ici par ex: je construis un liste à puces
// avec les produits.
echo "<html><body>";
echo "<ul>";

while ($ligne = $stmt->fetch()) {
	echo "<li>";
	echo $ligne['ref_produit'];
	echo " - ";
	echo $ligne['nom_produit'];
	echo " - ";
	echo $ligne['prix_produit'];
	echo "</li>";
} 

echo "</ul>";
echo "</body></html>";



?>