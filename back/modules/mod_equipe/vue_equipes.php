<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './vue_generique.php';

class VueEquipes extends VueGenerique{

    public function __construct() {
        parent::__construct();
    }

    public function affiche_liste(array $tab){

        echo '<ul>';
        foreach ($tab as $row){
            echo '<li><a id="liste_equipe" href="index.php?module=mod_equipe&action=details&id='. $row['id']. '">'. $row['nom'] .' <img src="' . $row['logo'] . '" /></a></li>';
        }
    }

    public function affiche_details(array $tab){
        foreach ($tab as $row){
            echo '<p>'. $row['nom'] .' est un club crée en ' . $row['annee_creation'] . ', voici une desciption du '. $row['nom'] . ' :<br>' . $row['description'] . '</p>';
            echo '<img src="' . $row['logo'] . '" />';
            echo '<div><a id="modif_equipe" href="index.php?module=mod_equipe&action=afficheModif&id='. $row['id']. '"> modifer </a></div>';
        }
    }

    public function afficheFormulaire($token){

        echo '<form action="index.php?module=mod_equipe&action=ajout" enctype="multipart/form-data" method="post" >';
        echo "Nom de l'equipe: <input type='text' name='nom'><br>";
        echo 'annee de creation: <input type="int" name="annee"><br>';
        echo 'petite description : <textarea name="description"></textarea><br>';
        echo 'pays ref: <input type="text" name="pays"><br>';
        echo '<input type="hidden" value="'. $token .'" name="token" ';
        echo '<input type="hidden" name="MAX_FILE_SIZE" value="300000" />';
        echo 'logo : <input type="file" name="logo" id="logo"><br>';
        echo '<input type="submit" value="Ajouter equipe">';
        echo '</form>';

    }

    public function modif(array $tab,$token) {
           
        echo '<form action="index.php?module=mod_equipe&action=modif&id=' .$tab[0]["id"]. '" enctype="multipart/form-data" method="post" >';
        echo 'Nom : <input type="text" name="nom" value="' . $tab[0]['nom'] . '"><br>';
        echo 'annee de creation: <input type="int" name="annee" value="' . $tab[0]['annee_creation'] . '"><br>';
        echo 'description : <textarea name="description" >' . $tab[0]['description'] . '</textarea><br>';
        echo 'pays: <input type="text" name="pays" value="' . $tab[0]['pays'] . '"><br>';
        echo '<input type="hidden" value="'. $token .'" name="token" ';
        echo '<input type="hidden" name="MAX_FILE_SIZE" value="300000" />';
        echo 'logo : <input type="file" name="logo" id="logo"><br>';
        echo '<input type="submit" value="modif equipe">';
        echo '</form>';
        
    }

}


?>