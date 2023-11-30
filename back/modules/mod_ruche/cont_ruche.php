<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_ruche.php" ;
require_once "vue_ruche.php" ;

class ContRuche {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueRuche();
        $this->modele = new ModeleRuche();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){
        $this->vue->afficheBienvenue();
    }

    // public function deconnexion() {

    //     session_destroy();
    //     header('Location: index.php?module=mod_connexion&action=bienvenue');

    // }

}
?>