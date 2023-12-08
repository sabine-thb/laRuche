<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_admin.php" ;
require_once "vue_admin.php" ;

class ContAdmin {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueAdmin();
        $this->modele = new ModeleAdmin();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){

        $this->vue->afficheBienvenue();
    }

    public function afficheDemande() {
        $resultat=$this->modele->recupereDemande();
        $this->vue->afficheDemande($resultat);
    }

    public function validerDemande() {
    
        if (isset($_GET["id"])) {
            $resultat=$this->modele->accepteDemande($_GET["id"]);

            if ($resultat) {
                header('Location: admin.php?action=afficherDemande');
            }
        }
    }

    public function refuserDemande() {
    
        if (isset($_GET["id"])) {
            $resultat=$this->modele->refuseDemande($_GET["id"]);

            if ($resultat) {
                header('Location: admin.php?action=afficherDemande');
            }
        }
    }

    public function spprimerCompetition() {
    
        if (isset($_GET["idCompet"])) {
            $resultat=$this->modele->deleteCompetition($_GET["idCompet"]);
            
            if ($resultat) {
                header('Location: admin.php?action=gererCompetition');
            }else{
                echo "erreur lors de la suppression";
            }
        }
    }

    public function gererComp() {
        
        $competitions = $this->modele->recupereComp();
        $this->vue->afficheListCompet($competitions);

    }

    public function afficheFormCompet(){

        $this->vue->afficheFormulaireCompet('');

    }

    public function ajoutCompet(){

        if (isset($_POST['name']) && isset($_POST['description']) && $_POST['name'] != "" && $_POST['description'] != ""){

            $result = $this->modele->ajoutCompet($_POST['name'],$_POST['description']);

            if ($result){
                echo 'la competition ' . $_POST['name'] . ' a bien été ajouté !<br>';
                echo "allez dans l'onglet 'gerer comp' pour ajouter des nouveau matchs";
                echo '<meta http-equiv="refresh" content="4;url=admin.php"/>';
            }else{
                $this->vue->afficheFormulaireCompet("erreur serveur veuillez contacter le support ");
            }

        }else{
            $this->vue->afficheFormulaireCompet("veullez remplir tout les champ !");
        }
    }

}
?>