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
        $this->action = $_GET['action'] ?? 'bienvenue';

    }

    public function start(){

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
                $this->controlleur->afficheMatchApronostique();
                break;
            case 'validationProno':
                $this->controlleur->valideProno();
                break;
            case 'resultat':
                $this->controlleur->afficheResultat();
                break;
        }
    }

    public function afficheModule()
    {
        return $this->controlleur->affichage();
    }

    public function updateSession()
    {
        $this->controlleur->recupIdPronostiqueur();
        $this->controlleur->recupLogoUser();
    }

    public function updateLogoUser()
    {
        $this->controlleur->recupLogoUser();
    }

}