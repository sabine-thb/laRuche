<?php

require_once './composants/menu/vue_menu.php';

class VueMenuAdmin extends VueMenu {

    protected function menuModule() {

        $temp = '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_connexion&action=deconnexion" class="nav-link px-2">log out</a></button>';
        $temp .= '</div>';
        $temp .= '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_admin&action=afficherDemande" class="nav-link px-2">demande compte</a></button>';
        $temp .= '</div>';

        return $temp;

    }

}

?>