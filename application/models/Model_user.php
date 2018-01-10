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

    function post($usrLogin,$usrEmail,$usrFirstName,$usrLastName,$usrAddress,$usrPassword,$usrPointsBalance,$usrStsId)
    {
        date_default_timezone_set('Europe/Paris');
        $data = array(
            "usrLogin" =>$usrLogin,
            "usrEmail" =>$usrEmail,
            "usrFirstName" =>$usrFirstName,
            "usrLastName" =>$usrLastName,
            "usrAddress" =>$usrAddress,
            "usrPassword" =>$usrPassword,
            "usrPointsBalance" =>$usrPointsBalance,
            "usrRegisterDate" =>date("Y-m-d H:i:s"),
            "usrLastConnectionDate" =>date("Y-m-d H:i:s"),
            "usrStsId" =>$usrStsId,
        );
        $this->db->insert($this->table, $data);
    }

    function patch($usrId,$usrLogin,$usrEmail,$usrFirstName,$usrLastName,$usrAddress,$usrPassword,$usrPointsBalance,$usrStsId)
    {
        $con=mysqli_connect("localhost","root","root","geoquizz");
        $this->db->query("UPDATE gquser SET usrLogin='".mysqli_real_escape_string($con,$usrLogin)."', usrEmail='".mysqli_real_escape_string($con,$usrEmail)."', 
                          usrFirstName='".mysqli_real_escape_string($con,$usrFirstName)."', usrLastName='".mysqli_real_escape_string($con,$usrLastName)."', 
                          usrAddress='".mysqli_real_escape_string($con,$usrAddress)."', usrPassword='".mysqli_real_escape_string($con,$usrPassword)."',
                          usrPointsBalance=".intval($usrPointsBalance).", usrStsId=".intval($usrStsId)." 
                          WHERE usrId=".intval($usrId));
    }

    function delete($id)
    {
        $this->db->where_in("usrId", $id)
            ->delete($this->table);
    }

}

/* End of file Model_product.php */
/* Location: ./application/models/Model_product.php */