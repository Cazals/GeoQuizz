<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Model_stats extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "gqplace";
    }

    function statsEmptyPlaces(){
        $statsEmptyPlc=$this->db->query("SELECT COUNT(plcId) as NbEmpty FROM gqplace WHERE plcUsrIdOwner IS NULL");
        return $statsEmptyPlc->result();
    }

    function statsOwnedPlaces(){
        $statsOwnedPlc=$this->db->query("SELECT COUNT(plcId) as NbOwned  FROM gqplace WHERE plcUsrIdOwner IS NOT NULL");
        return $statsOwnedPlc->result();
    }

    function statsBoughtPlc(){
        $statsBgtPlc=$this->db->query("select 'Achat' as TypeTrs,DATE(transDate) as DateTrs, count(transId) as NbTrs from gqtransaction GROUP BY DATE(transDate),transType HAVING transType=1
                                       UNION 
                                       select 'Vente' as TypeTrs,DATE(transDate) as DateTrs, count(transId) as NbTrs from gqtransaction GROUP BY DATE(transDate),transType HAVING transType=3");
        return $statsBgtPlc->result();
    }
}
