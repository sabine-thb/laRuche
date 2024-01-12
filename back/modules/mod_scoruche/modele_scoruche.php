<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

class ModeleScorcast extends Connexion {

    public function __construct() {
        parent::__construct();
    }

    private function executeQuery($stmt)
    {
        $stmt->execute();
        // Récupérez les résultats sous forme d'un tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recupereComp(int $idUser)
    {
        try {
            $query = "
            SELECT * FROM LaRuche.competition 
            EXCEPT 
            SELECT competition_id,nom,description,date_creation 
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.competition 
            WHERE user_id = $idUser
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e;
        }
    }

    public function recupereCompActive(int $idUser)
    {

        try {
            $query = "
            SELECT competition_id,nom,description,date_creation 
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.competition
            WHERE user_id = $idUser
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e;
        }
    }

    public function rejoindreCompet(int $idCompet, int $idUser): bool
    {

        try {
            $query = "
            INSERT INTO LaRuche.pronostiqueur(user_id,competition_id) VALUES
            ($idUser,$idCompet)
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }

    }

    public function recupereClassement(int $idCompet)
    {

        try {
            $query = "
            SELECT login, LaRuche.totalPoint(pronostiqueur_id,$idCompet) as points,src_logo_user,user_id as id
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.users
            WHERE competition_id = $idCompet
            ORDER BY points DESC
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return 404;
        }

    }

    public function recupereMatch(int $idCompet,int $idPronostiqueur)
    {

        try {
            $query = "
            SELECT date_match,E.nom as nom1,E2.nom as nom2,P.prono_equipe1,P.prono_equipe2,P.vainqueur_prono,
                   E.srcLogo as src1,E2.srcLogo as src2,M.match_id,pts_Vainq,pts_Ecart,pts_Exact,heure
            FROM LaRuche.matchApronostiquer as M
            INNER JOIN LaRuche.equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN LaRuche.equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN LaRuche.pronostique P ON P.match_id = M.match_id
            WHERE competition_id = $idCompet  and pronostiqueur_id = $idPronostiqueur and pari_ouvert = true
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }

    }

    public function modifProno($idMatch,$prono1,$prono2,$equipeGagnantePeno,$idPronostiqueur): bool
    {
        try {
            $query = "
            UPDATE LaRuche.pronostique 
            SET prono_equipe2 = $prono2 , prono_equipe1 = $prono1 , vainqueur_prono = $equipeGagnantePeno
            WHERE match_id = $idMatch and pronostiqueur_id = $idPronostiqueur
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);
            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function PronostiqueurIdActuelle($idUser,$idCompet)
    {
        try {
            $query = "
                SELECT pronostiqueur_id
                FROM LaRuche.pronostiqueur
                WHERE user_id = $idUser and competition_id = $idCompet
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt)[0]['pronostiqueur_id'];

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    public function recupereMatchFini(int $idCompet,int $idPronostiqueur)
    {
        try {
            $query = "
            SELECT date_match,E.nom as nom1,E2.nom as nom2,E.srcLogo as src1,E2.srcLogo as src2,M.match_id,
                   R.nb_but_equipe1 as resultat1, R.nb_but_equipe2 as resultat2, point_obtenu,heure
            FROM LaRuche.matchApronostiquer as M
            INNER JOIN LaRuche.equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN LaRuche.equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN LaRuche.pronostique P ON M.match_id = P.match_id  
            INNER JOIN LaRuche.resultatMatch R ON M.match_id = R.match_id
            WHERE pari_ouvert = false and competition_id = $idCompet and pronostiqueur_id = $idPronostiqueur
            ORDER BY date_match DESC
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function totalPoint(int $idPronostiqueur,int $idCompet)
    {
        try {
            $query = "
            SELECT LaRuche.totalPoint($idPronostiqueur,$idCompet) as totalPoints
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt)[0]['totalPoints'];

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

}