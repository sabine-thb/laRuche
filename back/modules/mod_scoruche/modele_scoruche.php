<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

class ModeleScorcast extends Connexion {

    public function __construct() {

    }


    private function executeQuery($stmt)
    {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recupereComp()
    {
        try {
            $query = "
            SELECT * FROM LaRuche.competition 
            EXCEPT 
            SELECT competition_id,nom,description,date_creation 
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.competition NATURAL JOIN LaRuche.users 
            WHERE login ='" . $_SESSION['loginActif'] . "'
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }

    public function recupereCompActive()
    {

        try {
            $query = "
            SELECT competition_id,nom,description,date_creation 
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.competition NATURAL JOIN LaRuche.users
            WHERE login ='" . $_SESSION['loginActif'] . "'
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }

    public function rejoindreCompet(int $idCompet): bool
    {

        try {
            $query = "
            INSERT INTO LaRuche.pronostiqueur(user_id,competition_id) VALUES
            (". $_SESSION['idUser'] .",". $idCompet .")
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

    public function recupereClassement(int $idCompet)
    {

        try {
            $query = "
            SELECT login, points
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.users
            WHERE competition_id =". $idCompet ."
            ORDER BY points
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

    public function recupereMatch(int $idCompet)
    {

        try {
            $query = "
            SELECT date_match,E.nom as nom1,E2.nom as nom2,P.prono_equipe1,P.prono_equipe2,E.srcLogo as src1,E2.srcLogo as src2,M.match_id
            FROM LaRuche.matchApronostiquer as M
            INNER JOIN LaRuche.equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN LaRuche.equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN LaRuche.pronostique P ON P.match_id = M.match_id
            WHERE competition_id =". $idCompet ." and pronostiqueur_id = ".$_SESSION['idPronostiqueur']." and pari_ouvert = true
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

    public function modifiProno1(int $idMatch,int $prono): bool
    {

        try {
            $query = "
            UPDATE LaRuche.pronostique 
            SET prono_equipe1 = " . $prono . "
            WHERE match_id = " . $idMatch . " and 
                pronostiqueur_id = " . $_SESSION['idPronostiqueur'] ."
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);
            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

    public function modifiProno2(int $idMatch,int $prono): bool
    {

        try {
            $query = "
            UPDATE LaRuche.pronostique 
            SET prono_equipe2 = " . $prono . "
            WHERE match_id = " . $idMatch . " and 
                pronostiqueur_id = " . $_SESSION['idPronostiqueur'] ."
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);
            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }

    }

    public function PronostiqueurIdActuelle()
    {
        try {
            $query = "
                SELECT pronostiqueur_id
                FROM LaRuche.pronostiqueur
                WHERE user_id =" . $_SESSION['idUser'] . " and competition_id =". $_GET['id'] ." 
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt)[0]['pronostiqueur_id'];

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }
    }

}


?>