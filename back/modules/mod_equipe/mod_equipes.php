<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "cont_equipes.php" ;

class ModEquipes  {

    private $action;
    private $controlleur;

    public function __construct(){

        $this->controlleur = new ContEquipes();
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'bienvenue';
        $this->start();

    }

    private function start(){

        switch($this->action){

            case 'bienvenue':
                $this->controlleur->bienvenue();
                break;
            
            case 'liste':
                $this->controlleur->liste();
                break;

            case 'details':
                $this->controlleur->details();
                break;

            case 'affiche_form':
                $this->controlleur->afficheForm();
                break;
                
            case 'ajout':
                $this->controlleur->ajout();
                break;
            case 'afficheModif':
                $this->controlleur->afficheModifEquipe();
                break;
            case 'modif':
                $this->controlleur->modif();
                break;
            

        }
    }

    public function afficheModule(){
        return $this->controlleur->affichage();
    }

}


?>