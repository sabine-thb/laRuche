<?php

abstract class VueMenu {

    protected $containt;

    abstract protected function menuModule();

    public function calculMenu() {

        //tout ca ne sert p ua rien normalement
        // $module = $_GET['module'];

        // $this->containt = '
        // <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        // <div class="col-md-3 mb-2 mb-md-0">
        //     <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
        //     <svg class="bi" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
        //     </a>
        // </div>

        // <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        //     <li><a href="index.php?module=' . $module . '&action=bienvenue" class="nav-link px-2 link-secondary">Home</a></li>
        //     <li><a href="index.php?module=mod_joueur" class="nav-link px-2">joueurs</a></li>
        //     <li><a href="index.php?module=mod_equipe" class="nav-link px-2">equipes</a></li>
        //     <li><a href="index.php?module=mod_connexion" class="nav-link px-2">connexion</a></li>
        // </ul>' .  . '</header>';

        echo $this->menuModule();

    } 

    public function getContaint() {
        return $this->containt;
    }


}

?>