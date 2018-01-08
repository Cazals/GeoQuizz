<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Model_walk extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "gqplace";
    }
    function post($lat, $lon,$rayon,$idplayer)
    {
        // 1    Selecting player's owned places
        $owned=$this->db->query("SELECT 1 as code,plcId,plcName,plcAddress,plcLat,plcLon,plcUsrIdOwner 
                              FROM gqplace WHERE plcUsrIdOwner=".intval($idplayer));
        if(!empty($owned->result())){
            $arrayResult=json_encode($owned->result());
        }
        //  2   Selecting nearby places, not owned by the player, where the player is not in
        $nearby=$this->db->query("SELECT 2 as code,plcId,plcName,plcAddress,plcLat,plcLon, (6366*acos(cos(radians(".$lat."))*cos(radians(plcLat))*cos(radians(plcLon)-
                         radians(".$lon."))+sin(radians(".$lat."))*sin(radians(plcLat)))) AS distance,plcUsrIdOwner  
                         FROM gqplace HAVING distance<=30 AND distance>0.05 AND ( plcUsrIdOwner<>".intval($idplayer)." OR plcUsrIdOwner IS NULL) ORDER by distance ASC");
        if(!empty($nearby->result())){
            if(!empty($arrayResult)){
                $tempArray = json_decode($arrayResult, true);
                array_push($tempArray, $nearby->result());
                $arrayResult=json_encode($tempArray);
                //$arrayResult=array( $arrayResult,$nearby->result());
            }
            else {
                $arrayResult=json_encode($nearby->result());
            }
        }
        //  3   Selecting place not owned by player, player at 50m from the place, place free no owner
        $visitedfree=$this->db->query("SELECT 3 as code,plcId,plcName,plcAddress,plcLat,plcLon, (6366*acos(cos(radians(".$lat."))*cos(radians(plcLat))*cos(radians(plcLon)-
                         radians(".$lon."))+sin(radians(".$lat."))*sin(radians(plcLat)))) AS distance,plcUsrIdOwner  
                         FROM gqplace HAVING distance<=0.05 AND plcUsrIdOwner IS NULL ORDER by distance ASC");
        if(!empty($visitedfree->result())){
            if(!empty($arrayResult)){
                $tempArray = json_decode($arrayResult, true);
                array_push($tempArray, $visitedfree->result());
                $arrayResult=json_encode($tempArray);
            }
            else {
                $arrayResult=json_encode($visitedfree->result());
            }
        }
        //  4  Selecting place not owned by player, player at 50m from the place, place owned by another player
        $visitedowned=$this->db->query("SELECT 4 as code,plcId,plcName,plcAddress,plcLat,plcLon, (6366*acos(cos(radians(".$lat."))*cos(radians(plcLat))*cos(radians(plcLon)-
                         radians(".$lon."))+sin(radians(".$lat."))*sin(radians(plcLat)))) AS distance,plcUsrIdOwner  
                         FROM gqplace HAVING distance<=0.05 AND plcUsrIdOwner<>".intval($idplayer)." ORDER by distance ASC");
        if(!empty($visitedowned->result())){
            if(!empty($arrayResult)){
                $tempArray = json_decode($arrayResult, true);
                array_push($tempArray, $visitedowned->result());
                $arrayResult=json_encode($tempArray);
            }
            else {
                $arrayResult=json_encode($visitedowned->result());
            }
            // Check if walk less than 30 min ago
            $rowvisited=$visitedowned->row(0);
            $volastvisit=$this->db->query("SELECT * FROM gqwalk WHERE wkUsrIdOwner=".$rowvisited->plcUsrIdOwner."
                                          AND wkDateWalk<DATE_SUB(NOW(), INTERVAL 30 MINUTE)");

            // Save transaction in the database

        }
        return $volastvisit;
        //return $arrayResult;
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