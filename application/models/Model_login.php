<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_login extends CI_Model {

	function __construct()
	{
		parent::__construct();
		$this->table = "gquser";
	}

//	function get_all()
//	{
//		return $this->db->get($this->table);
//	}
//
//	function get_one($id)
//	{
//		$this->db->select("id, title")
//				 ->from($this->table)
//				 ->where("id", $id)
//				 ->limit(1);
//
//		return $this->db->get();
//	}

	function post($username,$password)
	{
        $this->db->select('usrId')
                 ->from($this->table)
                 ->where('usrLogin', $username)
                 ->where('usrPassword', $password)
                 ->limit(1);

        $json = $this->db->get()->result();

        if (empty($json)){
            return array('code'=> 1,'msg'=>'Erreur : Login ou Mot de passe invalide');
        }
        else {
            return array('code'=> 2, 'msg'=>'Connecté');
        }

	}

	function userExists ($value,$dbName){
        $this->db->select('usrId')
            ->from($this->table)
            ->where($dbName, $value)
            ->limit(1);

        $jsonUsername = $this->db->get()->result();

        if (!empty($jsonUsername)){ // Login already in DB
            return array('code'=> 1, 'msg'=>'Erreur : '.$dbName.' déjà existant dans la Bdd');
        }



//        $this->db->select('usrId')
//            ->from($this->table)
//            ->where('usrEmail', $mail)
//            ->limit(1);
//
//        $jsonEmail = $this->db->get()->result();
//
//        if (!empty($jsonEmail)){ // Mail already in DB
//            $testMail = array('code'=> 3, 'msg'=>'Erreur : Mail déjà existant dans la Bdd');
//        }
//
//
//        return $this->merge_arrays_obj($testLogin,$testMail);
    }

//    function merge_arrays_obj(){
//        $func_info = debug_backtrace();
//        $func_args = $func_info[0]['args'];
//        $return_array_data = array();
//        foreach($func_args as $args_index=>$args_data){
//            if(is_array($args_data) || is_object($args_data)){
//                $return_array_data = array_merge($return_array_data,$args_data);
//            }
//        }
//        return $return_array_data;
//    }

//	function put($id, $title)
//	{
//		$data = array(
//			"title" => $title
//		);
//
//		$this->db->where("id", $id)
//				 ->update($this->table, $data);
//	}
//
//	function delete($id)
//	{
//		$this->db->where_in("id", $id)
//				 ->delete($this->table);
//	}

}