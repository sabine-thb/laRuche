<?php

require_once "modele_menu.php" ;
require_once "vue_menu.php" ;
require_once "MenuModule/vue_menu_connexion.php" ;
require_once "MenuModule/vue_menu_joueur.php" ;
require_once "MenuModule/vue_menu_equipe.php" ;

class ContMenu {

    private $vue;
    private $modele;

    public function __construct($module){

        $this->vue = $this->forgeMenu($module);
        //$this->modele = new ModeleMenu();

    }

    private function forgeMenu($module) {

        switch($module) {
            case "mod_connexion":
                $a = new VueMenuConnexion();
                break;
            case "mod_joueur":
                $a = new VueMenuJoueur();
                break;
            case "mod_equipe":
                $a = new VueMenuEquipe();
                break;
            default:
                die("erreur module");
        }

        return $a;

    }

    public function affichage() {
        $this->vue->calculMenu();
        return $this->vue->getContaint();
    }

}

?>