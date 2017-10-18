<?php
class actualiteBdd extends CI_Model {
    
    public function listerTous() {
        $this->load->database();
        $query = $this->db->query('SELECT id, titre,image, texte,dateActualite FROM actualite');
        return $query->result_array();  
    }

    public function listerUne($id) {
        $this->load->database();
        $sql = "SELECT id, titre,image, texte, dateActualite FROM actualite WHERE id=".$this->db->escape($id);
        $query = $this->db->query($sql);
        return $query->result_array(); 
    }

    public function inserer($titre, $image, $texte, $dateActualite) {
        $this->load->database();
        $sql = "INSERT INTO actualite (titre,image, texte, dateActualite) VALUES (".$this->db->escape($titre).", ".$this->db->escape($image).", ".$this->db->escape($texte).", ".$this->db->escape($dateActualite).")";
        $this->db->query($sql);
         return $this->db->insert_id();
    }
    
        
    public function supprimer($id) {
        $this->load->database();
        $sql = "DELETE FROM actualite WHERE id=".$this->db->escape($id);
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
}
?>
