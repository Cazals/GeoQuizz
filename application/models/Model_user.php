<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_user extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->table = "gquser";
    }

    function get_all()
    {
        return $this->db->get($this->table);
    }

    function get_one($id)
    {
        $this->db->select("UsrId,UsrLogin,UsrEmail,UsrFirstName,UsrLastName,UsrAddress,UsrPassword,UsrPointsBalance,UsrRegisterDate,UsrLastConnexionDate,StatusId")
            ->from($this->table)
            ->where("UsrId", $id)
            ->limit(1);

        return $this->db->get();
    }

    function post($UsrLogin,$UsrEmail,$UsrFirstName,$UsrLastName,$UsrAddress,$UsrPassword,$UsrPointsBalance,$UsrRegisterDate,$UsrLastConnexionDate,$StatusId)
    {
        $data = array(
            "UsrLogin" =>$UsrLogin,
            "UsrEmail" =>$UsrEmail,
            "UsrFirstName" =>$UsrFirstName,
            "UsrLastName" =>$UsrLastName,
            "UsrAddress" =>$UsrAddress,
            "UsrPassword" =>$UsrPassword,
            "UsrPointsBalance" =>$UsrPointsBalance,
            "UsrRegisterDate" =>$UsrRegisterDate,
            "UsrLastConnexionDate" =>$UsrLastConnexionDate,
            "StatusId" =>$StatusId,
        );

        $this->db->insert($this->table, $data);
    }

    function put($id, $title)
    {
        $data = array(
            "title" => $title
        );

        $this->db->where("id", $id)
            ->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where_in("id", $id)
            ->delete($this->table);
    }

}

/* End of file Model_product.php */
/* Location: ./application/models/Model_product.php */