<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './vue_generique.php';

class VueConnexion extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        if (isset($_SESSION["loginActif"])){
            echo "Bon retour parmi nous ". $_SESSION["loginActif"] ." !";
        }else{
            echo "salut vous etes sur le module connexion !";
        }
    }

    public function afficheFormulaireInsciption(){

        echo '<div class = "container d-flex justify-content-center" >';
        echo '<form class="form-inline align-items-center justify-content-center justify-content-md-between" action="index.php?module=mod_connexion&action=ajout" method="post">';
        echo "login: <input class='form-control mr-sm-2' type='text' name='login' placeholder='nom utilisateur'><br>";
        echo 'mot de passe: <input class="form-control mr-sm-2" type="password" name="mdp" placeholder="mot de passe"><br>';
        echo '<input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Ajouter Joueur">';
        echo '</form>';
        echo '</div>';

    }

    public function afficheFormulaireConnexion(){

        echo '<div class = "container d-flex justify-content-center" >';
        echo '<form action="index.php?module=mod_connexion&action=verificationConnexion" method="post" class="align-items-center justify-content-center justify-content-md-between">';
        echo "login: <input class='form-control mr-sm-2' type='text' name='login'><br>";
        echo 'mot de passe: <input class="form-control mr-sm-2" type="password" name="mdp"><br>';
        echo '<input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Connexion">';
        echo '</form>';
        echo '</div>';

    }

}


?>