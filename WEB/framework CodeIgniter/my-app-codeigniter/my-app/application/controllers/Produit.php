<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produit extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('vueindex');
	}
    
    
    public function creer()
	{
        $donnees['ref']="PE124587";
        $donnees['nom']="xxxxxPoele a crepes";
        $donnees['prix']=12.5;
		$this->load->view('vuecreer',$donnees);
	}
    
    
    
    
    
    
    
    
    public function supprimer()
	{
        
        
        $idproduit=$this->uri->segment(3); 
        
        if ($idproduit ==null) {
            $donnees['erreur']="Id produit introuvable";
            $donnees['message']="";
            $donnees['resultat']="";
        } else {
            $donnees['erreur']="";
            $donnees['message']="Produit n° ".$idproduit." supprimé.";
        }
		$this->load->view('vuesupprimer',$donnees);
	}
    
    
    
    
    
    
    
    public function lister()
	{
        $this->load->model('produitbdd');
               
        $donnees['resultat']=$this->produitbdd->listerTous();
        
		$this->load->view('vuelistertous',$donnees);
	}
    
    
    
    
    
   /*
   public function operation()
	{
       // 1- récupérer les parametres / données de la requete HTTP, et faire les vérifications nécessaires (session etc.)
       // 2- faire éventuellement appel à la couche Base de données (requetes SQL)
       // 3- transmettre les données à la vue pour génération de la réponse HTTP
	}
    */
}





