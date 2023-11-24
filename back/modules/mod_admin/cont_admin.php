<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_admin.php" ;
require_once "vue_admin.php" ;

class ContAdmin {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueAdmin();
        $this->modele = new ModeleAdmin();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){

        $this->vue->afficheBienvenue();
    }


    public function deconnexion() {

        session_destroy();
        header('Location: index.php?module=mod_connexion&action=bienvenue');

    }

}
?>