<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "cont_scoruche.php";

class ModScorcast
{
    private $action;
    private $controlleur;

    public function __construct()
    {
        $this->controlleur = new ContScorcast();
        $this->action = $_GET['action'] ?? 'bienvenue';
    }

    public function start()
    {

        switch ($this->action) {

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
            case 'stats':
                $this->controlleur->afficheStats();
                break;
            case 'detailUser':
                $this->controlleur->afficheInfoUser();
                break;
            case'questionsBonus':
                $this->controlleur->questionsBonus();
                break;
            case 'editProfil':
                $this->controlleur->editProfil();
                break;
            case 'edit':
                $this->controlleur->recupFormEdit();
                break;
            case 'mini-jeu':
                $this->controlleur->afficheMiniJeu();
                break;
            case 'changePassword':
                $this->controlleur->afficheFormMdp();
                break;
            case 'validationQuestionBonus':
                $this->controlleur->valideQuestionBonus();
                break;
        }
    }

    public
    function afficheModule()
    {
        return $this->controlleur->affichage();
    }

    public
    function updateSession()
    {
        $this->controlleur->recupIdPronostiqueur();
        $this->controlleur->recupLogoUser();
    }

    public
    function updateLogoUser()
    {
        $this->controlleur->recupLogoUser();
    }

}