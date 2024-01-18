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
        require_once('./front/scoruche/bienvenue.php');
    }

    public function afficheCompetitionDispo($tableau) {
        require_once('./front/scoruche/listeCompetitionDispo.php');
    }

    public function afficheCompetitionActive($tableau) {
        require_once('./front/scoruche/listeCompetitionActive.php');
    }

    public function afficheClassement($classement) {
        require_once('./front/scoruche/Classement.php');
    }

    public function afficheMatchs($matchs) {
        require_once('./front/scoruche/matchs.php');
    }

    public function afficheResultat($matchs, $totalPoints)
    {
        require_once ('./front/scoruche/resultats.php');
    }

    public function afficheInfoUser($data, $competActive)
    {
        require_once('./front/profil/PageProfil.php');
    }

}