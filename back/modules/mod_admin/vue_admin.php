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
        foreach ($tableau as $tuple) {
            echo '<div class="card mb-3">';
            echo    '<div class="card-body">';
            echo        '<h5 class="card-title">Login: '. $tuple["login"] . '</h5>';
            echo        '<p class="card-text">Mail: '. $tuple["mail"] . '</p>';
            echo        '<a href="index.php?module=mod_admin&action=valider&id=' . $tuple['user_id'] . '" class="btn btn-primary">Valider</a>';
            echo    '</div>';
            echo '</div>';
        }
        echo '</div>';

    }

    public function afficheListCompet($tableau){

        echo "voici les competitions existante :<br>";
        echo '<div class="container mt-5">';
        foreach ($tableau as $tuple) {
            echo '<div class="card mb-3">';
            echo    '<div class="card-body">';
            echo        '<h5 class="card-title"> ' . $tuple["nom"] . ' - '. $tuple["date_creation"] . '</h5>';
            echo        '<p class="card-text">'. $tuple["description"] . '</p>';
            echo        '<a href="index.php?module=mod_admin&action=supprimerCompetition&idCompet=' . $tuple['competition_id'] . '"><i class="fa-solid fa-trash"></i></a>';
            echo        '<a href="index.php?module=mod_admin&action=detailCompetition&idCompet=' . $tuple['competition_id'] . '"><i class="fa-solid fa-calendar-day"></i></a>';
            echo    '</div>';
            echo '</div>';
        }
        echo '</div>';
    }

    public function afficheFormulaireCompet($erreur){

        echo '<div class = "container d-flex justify-content-center" >';
        echo '<form action="index.php?module=mod_admin&action=ajoutCompetition" method="post" class="align-items-center justify-content-center justify-content-md-between">';
        echo "nom de la competition: <input class='form-control mr-sm-2' type='text' name='name'><br>";
        echo 'petite description : <textarea class="form-control mr-sm-2" name="description" rows="4" cols="50"></textarea><br>';
        echo '<p>' . $erreur . '</p>';
        echo '<input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="créer">';
        echo '</form>';
        echo '</div>';

    }


}


?>