<?php
class Produitbdd extends CI_Model {

	
	public function inserer() {
       // $sql = "INSERT INTO mytable (title, name) VALUES (".$this->db->escape($title).", ".$this->db->escape($name).")";
        
	}
    
    public function listerTous() {
        $this->load->database();
        $query = $this->db->query('SELECT id, nom,prix FROM matable');
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
