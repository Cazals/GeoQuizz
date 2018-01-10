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

    function post($transType,$transPoints,$transUsrIdBuyer,$transUsrIdSeller,$transPlaceId)
    {
        date_default_timezone_set('Europe/Paris');

        if (intval($transType)==3){ // Case sell an owned place
            $transPoints=intval($transPoints)*3/4;
            $this->db->query("UPDATE gquser SET usrPointsBalance=usrPointsBalance+".intval($transPoints)."
                              WHERE usrId=".intval($transUsrIdSeller));

            $this->db->query("UPDATE gqplace SET plcUsrIdOwner=NULL
                              WHERE plcId=".intval($transPlaceId));

            $data = array(
                "transDate"=>date("Y-m-d H:i:s"),
                "transType"=>$transType,
                "transPoints"=>$transPoints,
                "transUsrIdBuyer"=>$transUsrIdBuyer,
                "transUsrIdSeller"=>$transUsrIdSeller,
                "transPlaceId"=>$transPlaceId
            );
            $this->db->insert($this->table, $data);
            return array('code'=> 1, 'msg'=>'Vente effectué avec succés');
        }
        elseif ($transType==1){ // Case buy an empty place
            //Verify if user got enough points
            $enoughpoints=$this->db->query("SELECT usrLogin FROM gquser WHERE usrId=".intval($transUsrIdBuyer)."
                                            AND usrPointsBalance>=".intval($transPoints));
            if(!empty($enoughpoints->result())) {
                $this->db->query("UPDATE gquser SET usrPointsBalance=usrPointsBalance-".intval($transPoints)."
                              WHERE usrId=".intval($transUsrIdBuyer));

                $this->db->query("UPDATE gqplace SET plcUsrIdOwner=".intval($transUsrIdBuyer)."
                              WHERE plcId=".intval($transPlaceId));

                $data = array(
                    "transDate"=>date("Y-m-d H:i:s"),
                    "transType"=>$transType,
                    "transPoints"=>$transPoints,
                    "transUsrIdBuyer"=>$transUsrIdBuyer,
                    "transUsrIdSeller"=>$transUsrIdSeller,
                    "transPlaceId"=>$transPlaceId
                );
                $this->db->insert($this->table, $data);
                return array('code'=> 1, 'msg'=>'Achat effectué avec succés');
            }
            else {
                return array('code'=> 2, 'msg'=>'Erreur, pas assez de points');
            }
        }
    }

    function delete($id)
    {
        $this->db->where_in("transId", $id)
            ->delete($this->table);
        return array('code'=> 1, 'msg'=>'Suppression effectué avec succés');
    }
}