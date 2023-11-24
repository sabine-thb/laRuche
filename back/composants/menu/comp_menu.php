<?php

require_once "cont_menu.php" ;

class CompMenu {

    private $controlleur;

    public function __construct($module) {
        $this->controlleur = new ContMenu($module);
    }

    public function afficheMenu(){
        return $this->controlleur->affichage();
    }

}

?>