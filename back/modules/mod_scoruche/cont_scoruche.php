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
        $classement = $this->modele->recupereClassement($_GET['id']);
        $this->vue->afficheClassement($classement);
    }

    public function pronostics(){
        $matchs = $this->modele->recupereClassement($_GET['id']);
        
        var_dump($matchs);
    }

}
?>