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

            case 'deconnexion':
                $this->controlleur->deconnexion();
                break;
        }
    }

    public function afficheModule(){
        return $this->controlleur->affichage();
    }

}

?>