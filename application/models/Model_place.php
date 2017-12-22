<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_place extends CI_Model {

    function __construct()
    {
        parent::__construct();
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

    function post($plcId, $plcName, $plcAddress, $plcLat, $plcLon, $plcPrice, $plcWkPrice, $plcUsrIdOwner)
    {
        $data = array(
            "plcId" =>$plcId,
            "plcName" =>$plcName,
            "plcAddress" =>$plcAddress,
            "plcLat" =>$plcLat,
            "plcLon" =>$plcLon,
            "plcPrice" =>$plcPrice,
            "plcWkPrice" =>$plcWkPrice,
            "plcUsrIdOwner" =>$plcUsrIdOwner,
        );

        $this->db->insert($this->table, $data);
    }


    function delete($id)
    {
        $this->db->where_in("plcId", $id)
            ->delete($this->table);
    }

}

