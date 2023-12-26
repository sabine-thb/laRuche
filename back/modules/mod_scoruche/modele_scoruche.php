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

    public function rejoindreCompet(int $idCompet) {

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

    public function recupereClassement(int $idCompet){

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

    public function recupereMatch(int $idCompet){

        try {
            $query = "
            SELECT date_max_pari,E.nom as nom1,E2.nom as nom2,P.prono_equipe1,P.prono_equipe2,E.srcLogo as src1,E2.srcLogo as src2,M.match_id
            FROM LaRuche.matchApronostiquer as M
            INNER JOIN LaRuche.equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN LaRuche.equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN LaRuche.pronostique P ON P.match_id = M.match_id
            WHERE competition_id =". $idCompet ." and pronostiqueur_id = ".$_SESSION['idUser']."
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $result = $this->executeQuery($stmt);

            return $result;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

    public function modifiProno(int $idMatch,int $prono1,int $prono2){

        try {
            $query = "
            UPDATE LaRuche.pronostique 
            SET prono_equipe1 = " . $prono1 . ",
                prono_equipe2 = " . $prono2 . " 
            WHERE match_id = " . $idMatch . " and 
                pronostiqueur_id = " . $_SESSION['idUser'] ."
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