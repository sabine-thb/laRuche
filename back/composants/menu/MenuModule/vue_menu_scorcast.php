<?php

require_once './composants/menu/vue_menu.php';

class VueMenuScorcast extends VueMenu {

    protected function menuModule() {

        return '
        <ul>
         <li><a href="index.php?module=mod_joueur&action=liste">Liste</a></li>
         <li><a href="index.php?module=mod_joueur&action=affiche_form">Ajout</a></li>
        </ul>';

    }

}

?>