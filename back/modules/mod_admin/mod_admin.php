<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "cont_admin.php" ;

class ModAdmin {

    private $action;
    private $controlleur;

    public function __construct(){

        $this->controlleur = new ContAdmin();
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'bienvenue';

        $this->start();

    }

    private function start(){

        switch($this->action){

            case 'bienvenue':
                $this->controlleur->bienvenue();
                break;

            case 'afficherDemande':
                $this->controlleur->afficheDemande();
                break;

            case 'valider':
                $this->controlleur->validerDemande();
                break;
                
            case 'refuser':
                $this->controlleur->refuserDemande();
                break;

            case 'afficheFormCompetition':
                $this->controlleur->afficheFormCompet();
                break;

            case 'ajoutCompetition':
                $this->controlleur->ajoutCompet();
                break;    

            case 'gererCompetition':
                $this->controlleur->gererComp();
                break;

            case 'afficheFormEquipe':
                $this->controlleur->afficherFormCreationEquipe();
                break;

            case 'ajoutEquipe':
                $this->controlleur->ajoutEquipe();
                break;

            case 'ajoutMatch':
                echo var_dump($_POST); 
                $this->controlleur->ajoutMatch();
                
                // echo ("2023-12-05"-date("Y-m-d"));
                break;

            case 'gererEquipe':
                $this->controlleur->gererEquipe();
                break;

            case 'afficheFormMatch':
                $this->controlleur->afficherFormCreationMatch();
                break;

            case 'voirMatch':
                $this->controlleur->gererMatch();
                break;
            
            case 'supprimerCompetition':
                $this->controlleur->supprimerCompetition();
                break;    
             
            case 'detailCompetition':
                echo "TODO a coder";
                break;

            case 'supprimerEquipe':
                $this->controlleur->supprimerEquipe();
                break;    
                
            case 'detailEquipe':
                echo "TODO a coder";
                break;
        }
    }

    public function afficheModule(){
        return $this->controlleur->affichage();
    }

}

?>