<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/vue_generique.php';

class VueConnexion extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        require_once("./front/connexion/bienvenue.php");
    }

    public function afficheFormulaireInsciption(){
        require_once('./front/connexion/inscription.php');
    }

    public function afficheFormulaireConnexion(){
        require_once('./front/connexion/connexion.php');
    }

    public function afficheFormNouveauMDP()
    {
        require_once('./front/connexion/nouveauPassword.php');
    }

}


?>