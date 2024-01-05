<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "cont_connexion.php" ;

class ModConnexion {

    private $action;
    private $controlleur;

    public function __construct(){

        $this->controlleur = new ContConnexion();
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'bienvenue';

        $this->start();

    }

    private function start(){

        switch($this->action){

            case 'bienvenue':
                $this->controlleur->bienvenue();
                break;
            
            case 'inscription':
                $this->controlleur->afficheFormInsciption();
                break;

            case 'ajout':
                $this->controlleur->ajout();
                break;

            case 'connexion':
                $this->controlleur->afficheFormConnexion();
                break;

            case 'verificationConnexion':
                $this->controlleur->connexion();
                break;    

            case 'deconnexion':
                $this->controlleur->deconnexion();
                break;

            case 'resetPassword':
                $this->controlleur->nouveauPassword();
                break;
        }
    }

    public function afficheModule(){
        return $this->controlleur->affichage();
    }

}

?>