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

        $compets = $this->modele->recupereComp();
        $this->vue->afficheCompetitionDispo($compets);

    }

    public function rejoindreCompetition(){

        if(isset($_GET['idCompet'])){
            $result = $this->modele->rejoindreCompet($_GET['idCompet']);

            if($result){
                echo "vous avez rejoint la competiton avec succès";
            }else{
                echo "erreur, impossible de rejoindre la competition";
            }

        }

    }

    public function afficheCompetActive(){
        $compets = $this->modele->recupereCompActive();
        $this->vue->afficheCompetitionActive($compets);
    }

    public function afficheClassement(){
        //le 'id' dans le get correspond a l'id de la competition
        $classement = $this->modele->recupereClassement($_GET['id']);
        $this->vue->afficheClassement($classement);
    }

    public function afficheMatchApronostique(){
        $matchs = $this->modele->recupereMatch($_GET['id']);
        $this->vue->afficheMatchs($matchs);
    }

    public function valideProno(){

        $totalBool = true;

        foreach ($_POST as $key => $value) {

            $idMatch = (int)substr($key, -1);
            $prono = (int)substr($key, 0);

            if ($prono == 1){
                $res = $this->modele->modifiProno1($idMatch,$value);
            }else{
                $res = $this->modele->modifiProno2($idMatch,$value);
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
        $id = $this->modele->PronostiqueurIdActuelle();

        if ($id)
            return $id;
        else
            die("erreur lors de la recuperation de l'id pronostiqueur");
    }

}
?>