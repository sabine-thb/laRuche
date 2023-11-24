<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_connexion.php" ;
require_once "vue_connexion.php" ;

class ContConnexion {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueConnexion();
        $this->modele = new ModeleConnexion();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){

        $this->vue->afficheBienvenue();
    }

    public function afficheFormInsciption(){

        $this->vue->afficheFormulaireInsciption();

    }

    public function ajout() {

        if (isset($_POST['login'],$_POST['mdp'])){

            $resultat = $this->modele->ajoutUser($_POST['login'],$_POST['mdp']);

            if ($resultat) {
                echo "user ajouté avec succès.";
            } else {
                echo "Erreur lors de la creation de compte.";
            }

        } else {
            die("veullez remplir tout les champ");
        }

    }

    public function afficheFormConnexion() {

        $this->vue->afficheFormulaireConnexion();

    }

    public function connexion() {

        

        if (isset($_POST['login'],$_POST['mdp'])){
            

            $resultat = $this->modele->verifUser($_POST['login'],$_POST['mdp']);
            

            if ($resultat) {
                $_SESSION["loginActif"] = $_POST['login'];
                echo "Conexion etablie !";
            } else {
                echo "Erreur lors de la connexion.";
            }
            
        } else {
            die("veullez remplir tout les champ");
        }

    }

    public function deconnexion() {

        session_destroy();
        header('Location: index.php?module=mod_connexion&action=bienvenue');

    }

}
?>