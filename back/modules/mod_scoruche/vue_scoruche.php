<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/vue_generique.php';

class VueScorcast extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        require_once('./front/scoruche/bienvenue.html');
    }

    public function afficheCompetitionDispo($tableau) {
        require_once('./front/scoruche/listeCompetitionDispo.php');
    }

    public function afficheCompetitionActive($tableau) {
        require_once('./front/scoruche/listeCompetitionActive.php');
    }

}

?>