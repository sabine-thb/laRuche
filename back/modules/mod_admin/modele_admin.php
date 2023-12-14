<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

class ModeleAdmin extends Connexion {

    public function __construct() {

    }


    private function executeQuery($stmt) {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }

    
    public function genereToken($var){
        $string = "";
        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnpqrstuvwxy123456789";
        srand((double)microtime()*1000000);
        for($i=0; $i<$var; $i++){
            $string .= $chaine[rand()%strlen($chaine)];
        }
        $_SESSION['token']=$string;
        $_SESSION['creationToken']= time();
        return $string;
    }


    public function recupereDemande() {
        try {
            $stmt = Connexion::$bdd->prepare("SELECT user_id,login,mail FROM LaRuche.users WHERE est_verifier=false");
            $resultat = $this->executeQuery($stmt);
          //  echo var_dump($resultat);

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }

    public function recupereComp() {
        try {
            $stmt = Connexion::$bdd->prepare("SELECT * FROM LaRuche.competition");
            $resultat = $this->executeQuery($stmt);

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }

    public function deleteCompetition($id) {
        try {
            $stmt = Connexion::$bdd->prepare("DELETE FROM LaRuche.competition WHERE competition_id=" . $id ."");
            $resultat = $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }
    }

    

    public function accepteDemande($id) {

        try {
            $stmt = Connexion::$bdd->prepare("UPDATE LaRuche.users SET est_verifier=true WHERE user_id=" . $id ."");
            $resultat = $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }
    public function refuseDemande($id) {

        try {
            $stmt = Connexion::$bdd->prepare("DELETE FROM LaRuche.users WHERE user_id=" . $id ."");
            $resultat = $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

    public function ajoutCompet($nom,$detail) {
        try {
            $stmt = Connexion::$bdd->prepare("INSERT INTO LaRuche.competition (nom,description,date_creation) VALUES ('".$nom."', '".$detail."',CURDATE())");
            $resultat = $stmt->execute();

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }
    }
    public function insererEquipe($nom){
        $chemin= $this->gererLogo();

        $stmt = Connexion::$bdd->prepare("SELECT nom FROM LaRuche.equipe Where nom='".$nom."';");
        $res=$this->executeQuery($stmt);

        if(count($res)==0){
            $stmt = Connexion::$bdd->prepare("INSERT INTO LaRuche.equipe(nom, srcLogo) VALUES ('".$nom."','".$chemin."');");
           $stmt->execute();
            echo " Equipe bien enregistrée ✌️"."<br>";

        }else{
            echo" Une equipe porte déja ce nom.."."<br>";
            echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';


        }

    }

    public function getEquipes(){
        try{
            $stmt = Connexion::$bdd->prepare("SELECT * from LaRuche.equipe;");
            $res=$this->executeQuery($stmt);
            return $res;
        }catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
        
    }
    public function deleteEquipe($id) {
        try {
            $stmt = Connexion::$bdd->prepare("DELETE FROM LaRuche.equipe WHERE equipe_id=" . $id ."");
            $resultat = $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }
    }

    public function gererLogo(){        
        
        $temp_name = $_FILES["logo"]["tmp_name"];
        $name = $_FILES["logo"]["name"];
        $destination = "./style/img/logo/" . $name;

        // Déplacer le fichier téléchargé vers un répertoire sur le serveur
        if (!move_uploaded_file($temp_name, $destination)){
            echo "Une erreur s'est produite lors du téléchargement de l'image."."<br>";
        }
            
        return $destination;
    }


}


?>