<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_place extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->table = "gqplace";
    }

    function get_all()
    {
        return $this->db->get($this->table);
    }

    function get_one($id)
    {
        $this->db->select("plcId, plcName, plcAddress,plcLat, plcLon, plcPrice, plcWkPrice,plcUsrIdOwner,plcImgUrl")
            ->from($this->table)
            ->where("plcId", $id)
            ->limit(1);

        return $this->db->get();
    }

    function post($plcName, $plcAddress, $plcLat, $plcLon, $plcPrice, $plcWkPrice,$plcImgUrl)
    {
        if (!$this->testCrossingPlace($plcLat,$plcLon,0)) {
            $data = array(
                "plcName" => $plcName,
                "plcAddress" => $plcAddress,
                "plcLat" => $plcLat,
                "plcLon" => $plcLon,
                "plcPrice" => $plcPrice,
                "plcWkPrice" => $plcWkPrice,
                "plcImgUrl" => $plcImgUrl,
            );
            $this->db->insert($this->table, $data);
            return array('code' => 1, 'msg' => 'Ajout effectué avec succés');
        }
        else {
            return array('code'=> 2, 'msg'=>'Erreur : Lieu trop proche d\'un lieu existant');
        }
    }

    function patch($plcId,$plcName,$plcAddress,$plcLat,$plcLon,$plcPrice,$plcWkPrice,$plcUsrIdOwner,$plcImgUrl)
    {
        if (!$this->testCrossingPlace($plcLat,$plcLon,$plcId))
        {
            $con=mysqli_connect("localhost","root","root","geoquizz");
            $this->db->query("UPDATE gqplace SET plcName='".mysqli_real_escape_string($con,$plcName)."', 
                          plcAddress='".mysqli_real_escape_string($con,$plcAddress)."', plcLat=".$plcLat.",
                          plcImgUrl='".mysqli_real_escape_string($con,$plcImgUrl)."',
                          plcLon=".$plcLon.", plcPrice=".$plcPrice.", 
                          plcWkPrice=".$plcWkPrice.", plcUsrIdOwner=".intval($plcUsrIdOwner)."
                          WHERE plcId=".$plcId);
            return array('code'=> 1, 'msg'=>'Mise à jour effectué avec succés');
        }
        else {
            return array('code'=> 2, 'msg'=>'Erreur : Lieu trop proche d\'un lieu existant');
        }

    }

    function delete($id)
    {
        // Giving back full place's points to owner
        $owner=$this->db->query("SELECT plcUsrIdOwner,plcPrice FROM gqplace WHERE plcId=".intval($id));
        if(!empty($owner->result())) {
            $rowowner=$owner->row_array();
            if (isset($rowowner))
            {
                $this->db->query("UPDATE gquser SET usrPointsBalance=usrPointsBalance+".intval($rowowner['plcPrice'])."
                              WHERE usrId=".intval($rowowner['plcUsrIdOwner']));
            }
        }

        // Deleting the place
        $this->db->where_in("plcId", $id)
            ->delete($this->table);
        return array('code'=> 1, 'msg'=>'Suppression effectué avec succés');
    }

    function testCrossingPlace($plcLat,$plcLon,$plcId){
        $crossingPlace=$this->db->query("SELECT plcId, (6366*acos(cos(radians(".$plcLat."))*cos(radians(plcLat))*cos(radians(plcLon)-
                                        radians(".$plcLon."))+sin(radians(".$plcLat."))*sin(radians(plcLat)))) AS distance
                                         FROM gqplace
                                         HAVING (plcId<>".$plcId." OR plcId IS NULL) AND distance<0.05");
        if(!empty($crossingPlace->result())) {
            return True;
        }
        else {
            return False;
        }
    }
}

