<?php

require_once './composants/menu/vue_menu.php';

class VueMenuScorcast extends VueMenu {

    protected function menuModule() {

        $temp = '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_ruche" class="nav-link px-2">retour a la ruche</a></button>';
        $temp .= '</div>';
        $temp .= '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_connexion&action=deconnexion" class="nav-link px-2">deconnexion</a></button>';
        $temp .= '</div>';

        return $temp;

    }

}

?>