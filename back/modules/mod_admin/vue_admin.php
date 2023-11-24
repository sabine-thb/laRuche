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

    public function afficheDemande($tableau) {
        
        echo '<div class="container mt-5">';
        foreach ($tableau as $k) {
            echo '<div class="card mb-3">';
            echo    '<div class="card-body">';
            echo        '<h5 class="card-title">Login: '. $k["login"] . '</h5>';
            echo        '<p class="card-text">Mail: '. $k["mail"] . '</p>';
            echo        '<a href="#" class="btn btn-primary">Valider</a>';
            echo    '</div>';
            echo '</div>';
        }
        echo '</div>';

    }

}


?>