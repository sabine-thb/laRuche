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
                header('Location: index.php?module=mod_admin&action=afficherDemande');
            }
        }
    }

    public function spprimerCompetition() {
    
        if (isset($_GET["idCompet"])) {
            $resultat=$this->modele->deleteCompetition($_GET["idCompet"]);

            if ($resultat) {
                header('Location: index.php?module=mod_admin&action=gererCompetition');
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

            echo 'la competition ' . $_POST['name'] . ' a bien été ajouté !<br>';
            echo "allez dans l'onglet 'gerer comp' pour ajouter des nouveau matchs";
            echo '<meta http-equiv="refresh" content="4;url=index.php?module=mod_admin" />';

        }else{
            $this->vue->afficheFormulaireCompet("erreur !");
        }
    }

}
?>