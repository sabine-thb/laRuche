<?php

require_once './composants/menu/vue_menu.php';

class VueMenuRuche extends VueMenu {

    protected function menuModule() {

        $temp = '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_scorcast" class="nav-link px-2">Scorcast</a></button>';
        $temp .= '</div>';
        $temp .= '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_connexion&action=deconnexion" class="nav-link px-2">deconnexion</a></button>';
        $temp .= '</div>';

        return $temp;

    }

}

?>