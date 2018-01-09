<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Model_walk extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "gqplace";
    }
    function post($plcLat, $plcLon,$usrId)
    {
        // 1    Selecting player's owned places
        $owned=$this->db->query("SELECT 1 as code,plcId,plcName,plcAddress,plcLat,plcLon,plcUsrIdOwner 
                                 FROM gqplace WHERE plcUsrIdOwner=".intval($usrId));
        if(!empty($owned->result())){
            $arrayResult=json_encode($owned->result());
        }
        //  2   Selecting nearby places, not owned by the player, where the player is not in
        $nearby=$this->db->query("SELECT 2 as code,plcId,plcName,plcAddress,plcLat,plcLon, (6366*acos(cos(radians(".$plcLat."))*cos(radians(plcLat))*cos(radians(plcLon)-
                         radians(".$plcLon."))+sin(radians(".$plcLat."))*sin(radians(plcLat)))) AS distance,plcUsrIdOwner  
                         FROM gqplace HAVING distance<=30 AND distance>0.05 AND ( plcUsrIdOwner<>".intval($usrId)." OR plcUsrIdOwner IS NULL) ORDER by distance ASC");
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
        $visitedfree=$this->db->query("SELECT 3 as code,plcId,plcName,plcAddress,plcLat,plcLon, (6366*acos(cos(radians(".$plcLat."))*cos(radians(plcLat))*cos(radians(plcLon)-
                         radians(".$plcLon."))+sin(radians(".$plcLat."))*sin(radians(plcLat)))) AS distance,plcUsrIdOwner  
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
        $visitedowned=$this->db->query("SELECT 4 as code,plcId,plcName,plcAddress,plcLat,plcLon, (6366*acos(cos(radians(".$plcLat."))*cos(radians(plcLat))*cos(radians(plcLon)-
                         radians(".$plcLon."))+sin(radians(".$plcLat."))*sin(radians(plcLat)))) AS distance,plcUsrIdOwner,plcWkPrice
                         FROM gqplace HAVING distance<=0.05 AND plcUsrIdOwner<>".intval($usrId)." ORDER by distance ASC");
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
            $rowvisited=$visitedowned->row_array();
            if (isset($rowvisited))
            {
                $volastvisit=$this->db->query("SELECT * FROM gqwalk WHERE wkUsrIdOwner=".intval($rowvisited['plcUsrIdOwner'])."
                                               AND wkUsrIdWalker=".intval($usrId)."
                                               AND wkDateWalk>DATE_SUB(NOW(), INTERVAL 30 MINUTE)
                                               AND wkDateWalk<NOW()");
                if(empty($volastvisit->result())){ // Add walking points and walk datas
                    $this->db->query("UPDATE gquser SET usrPointsBalance=usrPointsBalance+".intval($rowvisited['plcWkPrice']).
                                     " WHERE usrId=".intval($rowvisited['plcUsrIdOwner']));

                    $this->db->query("INSERT INTO gqwalk (wkDateWalk,wkUsrIdOwner,wkUsrIdWalker,wkPlaceId) 
                                      VALUES (NOW(),".intval($rowvisited['plcUsrIdOwner']).",".intval($usrId)."
                                      ,".intval($rowvisited['plcId']).")");
                }
                //echo json_encode($volastvisit->result());
            }
        }
        return $arrayResult;
    }
}
// ----
// explications :
// ----
// dans la formule :
// "latitude" et "longitude" sont les noms des champs de la table en BDD (à adapter selon votre cas)
// $plcLatitude_ref/$plcLongitude_ref représentent les coordonnées du point de référence autour duquel on cherche
// $rayon est la taille du rayon exprimée en Kilometres
// le "ORDER By distance ASC" sert à classer les points trouvés du plus près au plus éloigné du point de référence.