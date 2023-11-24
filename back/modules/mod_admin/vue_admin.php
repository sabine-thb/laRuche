<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './vue_generique.php';

class VueAdmin extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        if (isset($_SESSION["loginActif"]) && isset($_SESSION["adminActif"]) ) {
            echo "Bon retour parmi nous ". $_SESSION["loginActif"] .", vous etes sur votre page d'acceuille admin !";
        }else{
            header('Location: index.php?module=mod_connexion&action=bienvenue');
        }
    }

}


?>