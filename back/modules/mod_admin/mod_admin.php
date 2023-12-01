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
                echo "TODO a coder";
                break;

            case 'gererEquipe':
                echo "TODO a coder";
                break;

            case 'afficheFormMatch':
                echo "TODO a coder";
                break;

            case 'voirMatch':
                echo "TODO a coder";
                break;
            
            case 'supprimerCompetition':
                $this->controlleur->spprimerCompetition();
                break;    
             
            case 'detailCompetition':
                echo "TODO a coder";
                break;        
        }
    }

    public function afficheModule(){
        return $this->controlleur->affichage();
    }

}

?>