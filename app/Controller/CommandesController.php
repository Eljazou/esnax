<?php

App::uses('AppController', 'Controller');


class CommandesController extends AppController {

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow("system_get_data_from_commande");
    }
	
	public function system_get_data_from_commande() 
    {
		$clients=$this->Commande->Client->find("list",array("fields"=>array("Client.code_wavsoft","Client.id")));
		$users=$this->Commande->User->find("list",array("fields"=>array("User.username","User.id")));
		
		$data = file_get_contents('php://input');
		
		$info = json_decode($data, true);
		foreach($info as $data)
		{
			$commande=$this->Commande->findByCommandeId($data["commande_id"]);
			if(count($commande)!=0)
				continue;
			
			$data["user_id"] = null;
			if(isset($users[$data["user"]]))
				$data["user_id"] =$users[$data["user"]];
			$data["client_id"] = null;
			if($data["client_id_val"]!=null && $data["client_id_val"]!="")
			{	
				if(isset($clients[$data["client_id_val"]]))
					$data["client_id"] =$clients[$data["client_id_val"]];
			}
			if($data["client_id_esna"]!=null && $data["client_id_esna"]!="")
			{
				if(isset($clients[$data["client_id_esna"]]))
					$data["client_id"] =$clients[$data["client_id_esna"]];
			}
			
			
			$data["code_client"] =$data["client_id_val"].",".$data["client_id_esna"];
			//// Vérifier que les ID ne sont pas null avant d'enregistrer
			//if ($data["user_id"] && $data["client_id"]) 
			//{
				$this->Commande->create();
				$this->Commande->save($data);
			//}
		}
		exit();		
    }
	
	function index()
	{
		$url = "https://esnacommande.connectlabo.com/outils/send_all_data_call_to_crm";
		$response = file_get_contents($url);
		$commandes =$this->Commande->find("all");
		$this->loadModel("Secteur");
		$secteurs=$this->Secteur->find("list",array("fields"=>array("Secteur.id","Secteur.ville")));
		$this->set("commandes",$commandes);
		$this->set("secteurs",$secteurs);
	}
    

}
