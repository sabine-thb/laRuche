<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "cont_scoruche.php" ;

class ModScorcast {

    private $action;
    private $controlleur;

    public function __construct(){

        $this->controlleur = new ContScorcast();
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'bienvenue';

        $this->start();

    }

    private function start(){

        switch($this->action){

            case 'bienvenue':
                $this->controlleur->bienvenue();
                break;
            case 'competitionDisponible':
                $this->controlleur->recupereCompetitionDisponible();
                break;
            case 'rejoindreCompetition':
                $this->controlleur->rejoindreCompetition();
                break;
            case 'afficheMesCompet':
                $this->controlleur->afficheCompetActive();
                break;
            case 'classement':
                $this->controlleur->afficheClassement();
                break;
            case 'affichePronostic':
                echo "en cours";
                break;
        }
    }

    public function afficheModule(){
        return $this->controlleur->affichage();
    }

}

?>