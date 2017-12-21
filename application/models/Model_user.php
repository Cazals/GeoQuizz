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
        $this->db->select("usrId,usrLogin,usrEmail,usrFirstName,usrLastName,usrAddress,usrPassword,usrPointsBalance,usrRegisterDate,usrLastConnectionDate,usrStsId")
            ->from($this->table)
            ->where("usrId", $id)
            ->limit(1);

        return $this->db->get();
    }

    function post($UsrLogin,$UsrEmail,$UsrFirstName,$UsrLastName,$UsrAddress,$UsrPassword,$UsrPointsBalance,$UsrRegisterDate,$UsrLastConnectionDate,$StatusId)
    {
        $data = array(
            "usrLogin" =>$UsrLogin,
            "usrEmail" =>$UsrEmail,
            "usrFirstName" =>$UsrFirstName,
            "usrLastName" =>$UsrLastName,
            "usrAddress" =>$UsrAddress,
            "usrPassword" =>$UsrPassword,
            "usrPointsBalance" =>$UsrPointsBalance,
            "usrRegisterDate" =>$UsrRegisterDate,
            "usrLastConnectionDate" =>$UsrLastConnectionDate,
            "usrStsId" =>$StatusId,
        );

        $this->db->insert($this->table, $data);
    }

//    function put($id, $title)
//    {
//        $data = array(
//            "title" => $title
//        );
//
//        $this->db->where("id", $id)
//            ->update($this->table, $data);
//    }

    function delete($id)
    {
        $this->db->where_in("usrId", $id)
            ->delete($this->table);
    }

}

/* End of file Model_product.php */
/* Location: ./application/models/Model_product.php */