<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_profil.php" ;
require_once "vue_profil.php" ;

class ContProfil {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueProfil();
        $this->modele = new ModeleProfil();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){
        $this->vue->afficheBienvenue();
    }

    public function editProfil()
    {
        $this->vue->afficheFormEdit();
    }

}