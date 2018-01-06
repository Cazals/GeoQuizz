<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_transaction extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->table = "gqtransaction";
    }

    function get_all()
    {
        return $this->db->get($this->table);
    }

    function get_one($id)
    {
        $this->db->select("transId,transDate,transType,transPoints,transUsrIdBuyer,transUsrIdSeller,transPlaceId")
            ->from($this->table)
            ->where("transId", $id)
            ->limit(1);

        return $this->db->get();
    }

    function post($transId,$transDate,$transType,$transPoints,$transUsrIdBuyer,$transUsrIdSeller,$transPlaceId)
    {
        $data = array(
            "transId"=>$transId,
            "transDate"=>$transDate,
            "transType"=>$transType,
            "transPoints"=>$transPoints,
            "transUsrIdBuyer"=>$transUsrIdBuyer,
            "transUsrIdSeller"=>$transUsrIdSeller,
            "transPlaceId"=>$transPlaceId
        );

        $this->db->insert($this->table, $data);
    }




    function delete($id)
    {
        $this->db->where_in("transId", $id)
            ->delete($this->table);
    }

}

/* End of file Model_product.php */
/* Location: ./application/models/Model_product.php */