<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './vue_generique.php';

class VueJoueurs extends VueGenerique{

    public function __construct() {
        parent::__construct();
    }

    public function affiche_liste(array $tab){

        echo '<ul>';
        foreach ($tab as $row){
            echo '<li><a href="index.php?module=mod_joueur&action=details&id='. $row['id']. '">'. $row['nom'] .'</a></li>';
        }
    }

    public function affiche_details(array $tab){
        foreach ($tab as $row){
            echo '<p>'. $row['biographie'] .'</p>';
        }
    }

    public function afficheFormulaire(){

        echo '<form action="index.php?module=mod_joueur&action=ajout" method="post">';
        echo 'Nom du joueur: <input type="text" name="nom"><br>';
        echo 'Biographie: <textarea name="biographie"></textarea><br>';
        echo '<input type="submit" value="Ajouter Joueur">';
        echo '</form>';

    }
}

?>