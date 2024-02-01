<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "cont_profil.php";

class ModProfil
{

    private $action;
    private $controlleur;

    public function __construct()
    {

        $this->controlleur = new ContProfil();
        $this->action = $_GET['action'] ?? 'bienvenue';

        $this->start();

    }

    private function start()
    {

        switch ($this->action) {

            case 'editProfil':
                $this->controlleur->editProfil();
                break;
            case 'edit':
                $this->controlleur->recupFormEdit();
                break;
            case 'changePassword':
                $this->controlleur->afficheFormMdp();
                break;
        }
    }

    public function afficheModule()
    {
        return $this->controlleur->affichage();
    }

}