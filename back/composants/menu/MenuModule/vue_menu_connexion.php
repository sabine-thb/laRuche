<?php

require_once './composants/menu/vue_menu.php';

class VueMenuConnexion extends VueMenu {

    protected function menuModule() {

        $temp = '<div class="col-md-3 text-end">';
        if (isset($_SESSION["loginActif"])){
            $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_connexion&action=deconnexion" class="nav-link px-2">log out</a></button>';
        } else {
            $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_connexion&action=connexion" class="nav-link px-2"> Login</a></button>';
            $temp .= '<button  type="button" class="btn btn-primary"><a href="index.php?module=mod_connexion&action=inscription" class="nav-link px-2">Sign-up</a></button>';
        }

        $temp .= '</div>';

        return $temp;

    }

}

?>