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
                echo "<section>Vous avez rejoint la competiton avec succès.</section>";
            }else{
                echo "<section>Erreur, impossible de rejoindre la compétition.</section>";
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
            echo "<p> Erreur lors de la récuperation du classement </p>";
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

            if (strpos($key, "match_id")) {
                $idMatch = $value;
                $str_input1 = $idMatch . "_prono_equipe1";
                $str_input2 = $idMatch . "_prono_equipe2";
                $input1 = $_POST["$str_input1"];
                $input2 = $_POST["$str_input2"];

                if ($input1 != "" && $input2 != "") {
                    if ($input1 == $input2) {
                        $str_toggle = $idMatch . "_toggle";
                        $equipe_gagnante_peno = array_key_exists($str_toggle, $_POST) ? "'equipe2'" : "'equipe1'";
                    } else
                        $equipe_gagnante_peno = "null";

                    $res = $this->modele->modifProno($idMatch, $input1, $input2, $equipe_gagnante_peno, $_SESSION['idPronostiqueur']);

                    if (!$res)
                        $totalBool = false;
                }
            }
        }

        if (!$totalBool)
            echo "Erreur pendant au moins une modification";
        else
            echo "Changements enregistrés avec succès";
    }

    public function recupLogoUser()
    {
        $srcLogoUser = $this->modele->getSrcLogo($_SESSION['idUser']);

        if ($srcLogoUser)
            $_SESSION['srcLogoUser'] = $srcLogoUser;
    }

    public function recupIdPronostiqueur()
    {
        $id = $this->modele->PronostiqueurIdActuelle($_SESSION['idUser'],$_GET['id']);

        if ($id)
            $_SESSION['idPronostiqueur'] = $id;
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

    public function afficheInfoUser()
    {
        $idUser = $_GET['userId'];

        $data = $this->modele->getInfo($idUser);
        $competActive = $this->modele->getCompetAndClassement($idUser);
        $this->vue->afficheInfoUser($data,$competActive);
    }

}