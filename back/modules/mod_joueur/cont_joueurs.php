<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_joueurs.php" ;
require_once "vue_joueurs.php" ;

class ContJoueurs {

    private $vue;
    private $modele;
    

    public function __construct(){

        $this->vue = new VueJoueurs();
        $this->modele = new ModeleJoueurs();

    }

    public function liste(){

        $tab = $this->modele->getListe();

        $this->vue->affiche_liste($tab);

    }

    public function bienvenue(){

        echo "salut vous etes sur le module joueur !";

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function details(){

        $tab = $this->modele->getDetailsJoueur($_GET['id']);

        $this->vue->affiche_details($tab);

    }

    public function afficheForm(){

        $this->vue->afficheFormulaire();

    }

    public function ajout(){

        $resultat = $this->modele->ajoutJoueurs($_POST['nom'],$_POST['biographie']);

        if ($resultat) {
            echo "Joueur ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du joueur.";
        }

    }

}
?>