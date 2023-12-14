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

    public function supprimerCompetition() {
    
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

    public function ajoutEquipe(){
        // echo  var_dump($_POST);

        if(isset($_SESSION['token'],$_POST['token'])){
            if(null!==($_SESSION['creationToken']&& time()-$_SESSION['creationToken']<60 )){
                if(isset($_POST['name'],$_FILES['logo']['tmp_name'])){
                    $this->modele->insererEquipe($_POST['name'],$_FILES['logo']);
                    
                    echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';
                }else{
                    echo " Remplissez tous les champs et réessayez"."<br>";
                    echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';
                }
            }else{
                echo " Délai atteint, veuillez réessayer "."<br>";
                echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';
            }
        }else {
            echo " Erreur de Token, redirection..";
            echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';
        }
        unset($_SESSION['token'],$_SESSION['creationToken']);

    }

    public function gererEquipe(){
        $eq=$this->modele->getEquipes();
        $this->vue->afficheEquipes($eq);
    }

    public function supprimerEquipe() {
    
        if (isset($_GET["idEquipe"])) {
            $resultat=$this->modele->deleteEquipe($_GET["idEquipe"]);
            
            if ($resultat) {
                header('Location: admin.php?action=gererEquipe');
            }else{
                echo "erreur lors de la suppression";
            }
        }
    }


    public function afficherFormCreationMatch(){
        $token=$this->modele->genereToken(30);
        $eq=$this->modele->getEquipes();
        $this->vue->afficheFormCreationMatch($token,$eq);
    }

    public function afficherFormCreationEquipe(){
        $token=$this->modele->genereToken(30);
        $this->vue->afficheFormCreationEquipe($token);
    }

}
?>