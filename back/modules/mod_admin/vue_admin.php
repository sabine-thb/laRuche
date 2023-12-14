<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/vue_generique.php';

class VueAdmin extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        require_once("./front/admin/bienvenue.php");
    }

    public function afficheDemande($tableau) {
        require_once("./front/admin/afficheDemande.php");
    }

    public function afficheListCompet($tableau){
        require_once("./front/admin/listCompetition.php");
    }

    public function afficheFormulaireCompet($erreur){
        require_once("./front/admin/formulaireCompetition.php");
    }

    public function afficheFormCreationMatch($token,$eq){
        require_once("./front/admin/formulaireCreationMatch.php");
    }

    public function afficheFormCreationEquipe($token){
        require_once("./front/admin/formulaireCreationEquipe.php");
    }

    public function afficheEquipes($eq){
        require_once("./front/admin/listeEquipes.php");
    }


}


?>