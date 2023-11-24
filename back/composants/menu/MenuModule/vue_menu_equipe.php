<?php

require_once './composants/menu/vue_menu.php';

class VueMenuEquipe extends VueMenu {

    protected function menuModule() {

        return '
        <ul>
            <li><a href="index.php?module=mod_equipe&action=liste">Liste</a></li>
            <li><a href="index.php?module=mod_equipe&action=affiche_form">Ajout</a></li>
        </ul>';

    }

}

?>