<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './vue_generique.php';

class VueRuche extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        
        echo "Bon retour parmi nous ". $_SESSION["loginActif"] ." !";
        
    }

}


?>