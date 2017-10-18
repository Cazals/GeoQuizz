<?php
class actualitebdd extends CI_Model {

	

    
    public function affichertout() {
        $this->load->database('actualitedb');
        $query = $this->db->query('SELECT id,titre,image,texte,dateActualite FROM actualite;');
        return $query->result_array();
        
        /*foreach ($query->result_array() as $ligne)
        {
            echo $ligne['title'];
            echo $ligne['name'];
            echo $ligne['email'];
        }

        echo 'Total Results: ' . $query->num_rows();
        */
        
    }
    
        
    public function supprimer($id) {
        $sql = "DELETE FROM matable WHERE id=".$this->db->escape($id);
        $this->db->query($sql);
        return $this->db->affected_rows();
    }
    
   
    
   
}
