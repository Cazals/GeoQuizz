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
        $this->db->select("plcId, plcName, plcAddress,plcLat, plcLon, plcPrice, plcWkPrice,plcUsrIdOwner")
            ->from($this->table)
            ->where("plcId", $id)
            ->limit(1);

        return $this->db->get();
    }

    function post($plcName, $plcAddress, $plcLat, $plcLon, $plcPrice, $plcWkPrice)
    {
        $data = array(
            "plcName" =>$plcName,
            "plcAddress" =>$plcAddress,
            "plcLat" =>$plcLat,
            "plcLon" =>$plcLon,
            "plcPrice" =>$plcPrice,
            "plcWkPrice" =>$plcWkPrice,
        );
        $this->db->insert($this->table, $data);
        echo json_encode($data);
    }

    function patch($plcId,$plcName,$plcAddress,$plcLat,$plcLon,$plcPrice,$plcWkPrice,$plcUsrIdOwner)
    {
        $con=mysqli_connect("localhost","root","root","geoquizz");
        $this->db->query("UPDATE gqplace SET plcName='".mysqli_real_escape_string($con,$plcName)."', 
                          plcAddress='".mysqli_real_escape_string($con,$plcAddress)."', plcLat=".$plcLat.", 
                          plcLon=".$plcLon.", plcPrice=".$plcPrice.", 
                          plcWkPrice=".$plcWkPrice.", plcUsrIdOwner=".intval($plcUsrIdOwner)."
                          WHERE plcId=".$plcId);
    }

    function delete($id)
    {
        $this->db->where_in("plcId", $id)
            ->delete($this->table);
    }
}

