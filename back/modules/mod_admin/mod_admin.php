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
        $this->action = $_GET['action'] ?? 'bienvenue';

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
                $this->controlleur->ajoutMatch();
                break;

            case 'gererEquipe':
                $this->controlleur->gererEquipe();
                break;

            case 'afficheFormMatch':
                $this->controlleur->afficherFormCreationMatch();
                break;

            case 'gererMatch':
                $this->controlleur->gererMatch();
                break;
            
            case 'supprimerCompetition':
                $this->controlleur->supprimerCompetition();
                break;

            case 'miseEnAttenteMatch':
                $this->controlleur->miseEnAttenteMatch();
                break;

            case 'ajouteResultatMatch':
                $this->controlleur->ajouteResultatMatch();
                break;

            case 'modifierEquipe':
                $this->controlleur->afficheVueModifieEquipe();
                break;

            case 'modifieEquipe':
                $this->controlleur->modifieEquipe();
                break;

            case 'gererComptes':
                $this->controlleur->afficheRechercheCompte();
                break;

            case'resetPwd':
                $this->controlleur->resetPasswordUser();
                break;

            case 'detailEquipe':
                echo "TODO a coder";
                break;

            case 'detailCompetition':
                echo "TODO a coder";
                break;

            case 'supprimerEquipe':
                $this->controlleur->supprimerEquipe();
                break;

            case 'supprimeUser':
                $this->controlleur->supprimerUser();
                break;

            default :
                echo "erreur 404 : Cette page s'est faite dégager aux 6m ! <br><br><br> cliquez l''abeille pour retourner au menu";
                break;

        }
    }

    public function afficheModule(){
        return $this->controlleur->affichage();
    }

}

?>