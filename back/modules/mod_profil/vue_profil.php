<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/vue_generique.php';

class VueProfil extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        require_once("./front/ruche/bienvenue.php");
    }

    public function afficheFormEdit()
    {
        require_once("./front/profil/editProfil.php");
    }

}