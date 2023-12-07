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

    public function recupereDemande() {
        try {
            $stmt = Connexion::$bdd->prepare("SELECT user_id,login,mail FROM LaRuche.users WHERE est_verifier=false");
            $resultat = $this->executeQuery($stmt);

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

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }

    }

    public function ajoutCompet($nom,$detail) {
        try {
            $stmt = Connexion::$bdd->prepare("INSERT INTO LaRuche.competition (nom,description,date_creation) VALUES ('".$nom."', '".$detail."',CURDATE())");
            $resultat = $stmt->execute();

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }


}


?>