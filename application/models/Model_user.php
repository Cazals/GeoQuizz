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
        $this->db->select("usrId,usrLogin,usrEmail,usrFirstName,usrLastName,usrAddress,usrPassword,usrPointsBalance,usrRegisterDate,usrLastConnectionDate,usrStsId,usrImgUrl")
            ->from($this->table)
            ->where("usrId", $id)
            ->limit(1);

        return $this->db->get();
    }

    function post($usrLogin,$usrEmail,$usrFirstName,$usrLastName,$usrAddress,$usrPassword,$usrPointsBalance,$usrStsId,$usrImgUrl)
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
            "usrImgUrl" =>$usrImgUrl,
        );
        $this->db->insert($this->table, $data);
        return array('code'=> 1, 'msg'=>'Ajout effectué avec succés');
    }

    function patch($usrId,$usrLogin,$usrEmail,$usrFirstName,$usrLastName,$usrAddress,$usrPassword,$usrPointsBalance,$usrStsId,$usrImgUrl)
    {
        $con=mysqli_connect("localhost","root","root","geoquizz");
        $this->db->query("UPDATE gquser SET usrLogin='".mysqli_real_escape_string($con,$usrLogin)."', usrEmail='".mysqli_real_escape_string($con,$usrEmail)."', 
                          usrFirstName='".mysqli_real_escape_string($con,$usrFirstName)."', usrLastName='".mysqli_real_escape_string($con,$usrLastName)."', 
                          usrAddress='".mysqli_real_escape_string($con,$usrAddress)."', usrPassword='".mysqli_real_escape_string($con,$usrPassword)."',
                          usrImgUrl='".mysqli_real_escape_string($con,$usrImgUrl)."',
                          usrPointsBalance=".intval($usrPointsBalance).", usrStsId=".intval($usrStsId)." 
                          WHERE usrId=".intval($usrId));

        return array('code'=> 1, 'msg'=>'Mise à jour effectué avec succés');
    }

    function delete($id)
    {
        $this->db->where_in("usrId", $id)
            ->delete($this->table);

        // Remove user from place's owner column
        $this->db->query("UPDATE gqplace SET plcUsrIdOwner=NULL
                              WHERE plcUsrIdOwner=".intval($id));

        return array('code'=> 1, 'msg'=>'Suppression effectué avec succés');
    }
}
