<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Model_login extends CI_Model {
    function __construct()
    {
        parent::__construct();
        $this->table = "gquser";
    }

    function post($usrLogin,$usrPassword)
    {
        $this->db->select('usrId')
            ->from($this->table)
            ->where('usrLogin', $usrLogin)
            ->where('usrPassword', $usrPassword)
            ->limit(1);
        $json = $this->db->get()->result();
        if (empty($json)){
            return array('code'=> 2,'msg'=>'Erreur : Login ou Mot de passe invalide');
        }
        else {
            //Update last connection
            $this->db->query("UPDATE gquser SET usrLastConnexionDate=NOW() WHERE usrLogin=".$username);
            return array('code'=> 1, 'msg'=>'Connecté');
        }
    }
    function userExists ($value,$dbName){
        $this->db->select('usrId')
            ->from($this->table)
            ->where($dbName, $value)
            ->limit(1);
        $jsonUsername = $this->db->get()->result();
        if (!empty($jsonUsername)){ // Login already in DB
            return array('code'=> 2, 'msg'=>'Erreur : '.$dbName.' déjà existant dans la Bdd');
        }
    }
}