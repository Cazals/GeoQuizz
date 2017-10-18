<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actualite extends CI_Controller {


	public function index()
	{
		$idActu =trim($this->uri->segment(3)); 
		if($idActu == "liste" || $idActu == "grille" || $idActu ==null){  //Tous les enregistrements 
			$this->load->model('actualiteBdd');
	        $donnees['resultat']=$this->actualiteBdd->listerTous();
	        $donnees['etat'] = $idActu;
			
			header("content-Type:application/json");
			echo json_encode($donnees);
			
			//$this->load->view('vueAffichageActualite',$donnees);
		}else{
			$this->load->model('actualiteBdd');
	        $donnees['resultat']=$this->actualiteBdd->listerUne($idActu); // Juste l'article correspondant à l'id
	        $donnees['etat'] = "";
			
			header("content-Type:application/json");
			echo json_encode($donnees);
			
			//$this->load->view('vueAffichageActualite',$donnees);
		}
	}

	public function newadd()
	{
		if(($this->input->post('Title')) == null  || ""){
			$this->load->view('vueAjoutActualite');
		}else{
			$this->load->model('actualiteBdd');
	        $donnees['resultat']=$this->actualiteBdd->inserer(($this->input->post('Title')), ($this->input->post('UrlImg')), ($this->input->post('Content')), ($this->input->post('DateActu')));
			
			header("content-Type:application/json");
			echo json_encode($donnees);
			
			//$this->load->view('vueAjoutActualite',$donnees);
		}
	}

	public function supprimer()
	{
		$this->load->model('actualiteBdd');
		$idActu =$this->uri->segment(3); 
		$donnees['resultat']=$this->actualiteBdd->supprimer($idActu);
        
        if ($idActu ==null) {
            $donnees['erreur']="Article non trouvé";
            $donnees['message']="";
            $donnees['resultat']="";
        } else {
            $donnees['erreur']="";
            $donnees['message']="Produit n° ".$idActu." supprimé.";
        }
		
		header("content-Type:application/json");
		echo json_encode($donnees);
		
		$this->load->view('VueSupprimerActualite', $donnees);
	}
}
?>
