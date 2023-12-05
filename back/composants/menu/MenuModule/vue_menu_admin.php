<?php

require_once './back/composants/menu/vue_menu.php';

class VueMenuAdmin extends VueMenu {

    protected function menuModule() {

        $temp = '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_admin&action=afficherDemande" class="nav-link px-2">voir demande compte</a></button>';
        $temp .= '</div>';

        $temp .= '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_admin&action=afficheFormCompetition" class="nav-link px-2">créer comp</a></button>';

        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_admin&action=gererCompetition" class="nav-link px-2">gerer comp</a></button>';
        $temp .= '</div>';

        $temp .= '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_admin&action=afficheFormEquipe" class="nav-link px-2">créer equipe</a></button>';

        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_admin&action=gererEquipe" class="nav-link px-2">gerer equipe</a></button>';
        $temp .= '</div>';

        $temp .= '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_admin&action=afficheFormMatch" class="nav-link px-2">créer match</a></button>';

        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_admin&action=voirMatch" class="nav-link px-2">voir match</a></button>';
        $temp .= '</div>';


        $temp .= '<div class="col-md-3 text-end">';
        $temp .= '<button  type="button" class="btn btn-outline-primary me-2"><a href="index.php?module=mod_connexion&action=deconnexion" class="nav-link px-2">deconnexion</a></button>';
        $temp .= '</div>';

        return $temp;

    }

}

?>