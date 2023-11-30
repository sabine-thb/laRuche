<?php

require_once "modele_menu.php" ;
require_once "vue_menu.php" ;
require_once "MenuModule/vue_menu_connexion.php" ;
require_once "MenuModule/vue_menu_ruche.php" ;
require_once "MenuModule/vue_menu_scorcast.php" ;
require_once "MenuModule/vue_menu_admin.php" ;

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
            case "mod_ruche":
                $a = new VueMenuRuche();
                break;
            case "mod_scorcast":
                $a = new VueMenuScorcast();
                break;
            case "mod_admin":
                $a = new VueMenuAdmin();
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