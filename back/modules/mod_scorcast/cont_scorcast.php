<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_scorcast.php" ;
require_once "vue_scorcast.php" ;

class ContScorcast {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueScorcast();
        $this->modele = new ModeleScorcast();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){
        $this->vue->afficheBienvenue();
    }


}
?>