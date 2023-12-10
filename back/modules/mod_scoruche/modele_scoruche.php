<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

class ModeleScorcast extends Connexion {

    public function __construct() {

    }


    private function executeQuery($stmt) {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }

    public function recupereComp() {
        try {
            $query = "
            SELECT * FROM LaRuche.competition 
            EXCEPT 
            SELECT competition_id,nom,description,date_creation 
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.competition NATURAL JOIN LaRuche.users 
            WHERE login ='" . $_SESSION['loginActif'] . "'
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $resultat = $this->executeQuery($stmt);

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }

    public function recupereCompActive() {
        try {
            $query = "
            SELECT competition_id,nom,description,date_creation 
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.competition NATURAL JOIN LaRuche.users
            WHERE login ='" . $_SESSION['loginActif'] . "'
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $resultat = $this->executeQuery($stmt);

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }

    public function rejoindreCompet($idCompet) {

        try {
            $query = "
            INSERT INTO LaRuche.pronostiqueur(user_id,competition_id) VALUES
            (". $_SESSION['id'] .",". $idCompet .")
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

    public function recupereClassement($idCompet){

        try {
            $query = "
            SELECT login, points
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.users
            WHERE competition_id =". $idCompet ."
            ORDER BY points
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $result = $this->executeQuery($stmt);

            return $result;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

}


?>