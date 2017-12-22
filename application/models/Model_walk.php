<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_walk extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "gqplace";
    }


    function post($lat, $lon,$rayon)
    {

        $query=$this->db->query("SELECT *, (6366*acos(cos(radians(".$lat."))*cos(radians(plcLat))*cos(radians(plcLon)-
                         radians(".$lon."))+sin(radians(".$lat."))*sin(radians(plcLat)))) AS distance 
                         FROM gqplace HAVING distance<=".$rayon." ORDER by distance ASC");

        return $query->result();
    }
}





// ----
// explications :
// ----
// dans la formule :
// "latitude" et "longitude" sont les noms des champs de la table en BDD (à adapter selon votre cas)
// $latitude_ref/$longitude_ref représentent les coordonnées du point de référence autour duquel on cherche
// $rayon est la taille du rayon exprimée en Kilometres

// le "ORDER By distance ASC" sert à classer les points trouvés du plus près au plus éloigné du point de référence.