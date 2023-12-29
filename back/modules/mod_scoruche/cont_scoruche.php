<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_scoruche.php" ;
require_once "vue_scoruche.php" ;

class ContScorcast {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueScorcast();
        $this->modele = new ModeleScorcast();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){
        $this->vue->afficheBienvenue();
    }

    public function recupereCompetitionDisponible(){

        $compets = $this->modele->recupereComp($_SESSION['idUser']);
        $this->vue->afficheCompetitionDispo($compets);

    }

    public function rejoindreCompetition(){

        if(isset($_GET['idCompet'])){
            $result = $this->modele->rejoindreCompet($_GET['idCompet'],$_SESSION['idUser']);

            if($result){
                echo "vous avez rejoint la competiton avec succès";
            }else{
                echo "erreur, impossible de rejoindre la competition";
            }

        }

    }

    public function afficheCompetActive(){
        $compets = $this->modele->recupereCompActive($_SESSION['idUser']);
        $this->vue->afficheCompetitionActive($compets);
    }

    public function afficheClassement(){
        //le 'id' dans le get correspond a l'id de la competition
        $classement = $this->modele->recupereClassement($_GET['id']);

        if ($classement == 404)
            echo "<p> Erreur lors de la recuperation du classement </p>";
        else
            $this->vue->afficheClassement($classement);
    }

    public function afficheMatchApronostique(){
        $matchs = $this->modele->recupereMatch($_GET['id'],$_SESSION['idPronostiqueur']);
        $this->vue->afficheMatchs($matchs);
    }

    public function valideProno(){

        $totalBool = true;

        foreach ($_POST as $key => $value) {

            $idMatch = (int)substr($key, -1);
            $prono = (int)substr($key, 0);

            if ($prono == 1){
                $res = $this->modele->modifiProno1($idMatch,$value,$_SESSION['idPronostiqueur']);
            }else{
                $res = $this->modele->modifiProno2($idMatch,$value,$_SESSION['idPronostiqueur']);
            }

            if (!$res)
                $totalBool = false;
        }

        if (!$totalBool)
            echo "erreur pendant au moins une modification";
        else
            echo "changements enregistrés avec succés";
    }

    public function demandePronostiqueurIdActuelle()
    {
        $id = $this->modele->PronostiqueurIdActuelle($_SESSION['idUser'],$_GET['id']);

        if ($id)
            return $id;
        else
            die("erreur lors de la recuperation de l'id pronostiqueur");
    }

    public function afficheResultat()
    {
        $matchs = $this->modele->recupereMatchFini($_GET['id'],$_SESSION['idPronostiqueur']);

        if ($matchs == 404)
            echo "<p> Erreur lors de la recup des resultats </p>";
        else{
            $totalPoints = $this->modele->totalPoint($_SESSION['idPronostiqueur'],$_GET['id']);
            $this->vue->afficheResultat($matchs,$totalPoints);
        }

    }

}