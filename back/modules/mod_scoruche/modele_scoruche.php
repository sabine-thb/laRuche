<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

class ModeleScorcast extends Connexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function recupereComp($idUser)
    {
        try {
            $query = "
            SELECT * 
            FROM laruchxsabine.LaRuche_competition 
            WHERE competition_id NOT IN ( 
                SELECT competition_id
                FROM laruchxsabine.LaRuche_pronostiqueur NATURAL JOIN laruchxsabine.LaRuche_competition 
                WHERE user_id = $idUser
            )
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";

            return $e;
        }
    }

    private function executeQuery($stmt)
    {
        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recupereCompActive($idUser)
    {

        try {
            $query = "
            SELECT competition_id,nom,description,date_creation 
            FROM laruchxsabine.LaRuche_pronostiqueur 
            NATURAL JOIN laruchxsabine.LaRuche_competition
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
            INSERT INTO laruchxsabine.LaRuche_pronostiqueur(user_id,competition_id) 
            VALUES ($idUser,$idCompet)
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function updatePronoQuestionBonus(int $idPronostiqueur, int $idQuestion, $inputProno): bool
    {

        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_pronoQuestionBonus 
            SET reponse = :prono
            WHERE question_bonus_id = $idQuestion and pronostiqueur_id = $idPronostiqueur
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':prono', $inputProno, PDO::PARAM_STR);
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
            SELECT login, total_point as points,description,user_id as id,laruchxsabine.LaRuche_getClassement(pronostiqueur_id,$idCompet) as position
            FROM laruchxsabine.LaRuche_pronostiqueur NATURAL JOIN laruchxsabine.LaRuche_users
            WHERE competition_id = $idCompet
            ORDER BY position
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";

            return 404;
        }

    }

    public function recupereMatch(int $idCompet, int $idPronostiqueur)
    {

        try {
            $query = "
            SELECT date_match,E.nom as nom1,E2.nom as nom2,P.prono_equipe1,P.prono_equipe2,P.vainqueur_prono,
                   E.srcLogo as src1,E2.srcLogo as src2,M.match_id,pts_Vainq,pts_Ecart,pts_Exact,heure
            FROM laruchxsabine.LaRuche_matchApronostiquer as M
            INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN laruchxsabine.LaRuche_equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN laruchxsabine.LaRuche_pronostique P ON P.match_id = M.match_id
            WHERE competition_id = $idCompet  and pronostiqueur_id = $idPronostiqueur and pari_ouvert = true
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }

    }

    public function modifProno($idMatch, $prono1, $prono2, $equipeGagnantePeno, $idPronostiqueur): bool
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_pronostique 
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

    public function PronostiqueurIdActuelle($idUser, $idCompet)
    {
        try {
            $query = "
                SELECT pronostiqueur_id
                FROM laruchxsabine.LaRuche_pronostiqueur
                WHERE user_id = $idUser and competition_id = $idCompet
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt)[0]['pronostiqueur_id'];

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function recupereMatchFini(int $idCompet, int $idPronostiqueur)
    {
        try {
            $query = "
            SELECT M.match_id,date_match,E.nom as nom1,E2.nom as nom2,E.srcLogo as src1,E2.srcLogo as src2,
                   R.nb_but_equipe1 as resultat1, R.nb_but_equipe2 as resultat2, P.point_obtenu,M.*,R.resultat_peno,
                   P.prono_equipe1,P.prono_equipe2,P.vainqueur_prono
            FROM laruchxsabine.LaRuche_matchApronostiquer as M
            INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN laruchxsabine.LaRuche_equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN laruchxsabine.LaRuche_pronostique P ON M.match_id = P.match_id  
            INNER JOIN laruchxsabine.LaRuche_resultatMatch R ON M.match_id = R.match_id
            WHERE pari_ouvert = false and competition_id = $idCompet and pronostiqueur_id = $idPronostiqueur
            ORDER BY date_match DESC
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            return 404;
        }
    }

    public function totalPoint(int $idPronostiqueur, int $idCompet)
    {
        try {
            $query = "
            SELECT laruchxsabine.totalPoint($idPronostiqueur,$idCompet) as totalPoints
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt)[0]['totalPoints'];

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function getSrcLogo($id)
    {
        try {
            $query = "
            SELECT src_logo_user
            FROM laruchxsabine.LaRuche_users
            WHERE user_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt)[0]['src_logo_user'];

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function getInfo($idUser)
    {
        try {
            $query = "
            SELECT U.prenom,U.login,c.nom as nom, U.description, U.age , U.Gender
            FROM laruchxsabine.LaRuche_users U
            NATURAL JOIN laruchxsabine.LaRuche_pronostiqueur
            INNER JOIN laruchxsabine.LaRuche_competition join laruchxsabine.LaRuche_competition c on laruchxsabine.LaRuche_pronostiqueur.competition_id = c.competition_id
            WHERE U.user_id = $idUser
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt)[0];
        } catch (PDOException $e) {
            return 404;
        }
    }

    public function getCompetAndClassement($idUser)
    {
        try {
            $query = "
            SELECT c.nom,laruchxsabine.LaRuche_getClassement(p.pronostiqueur_id,c.competition_id) as classement
            FROM laruchxsabine.LaRuche_users u
            INNER JOIN laruchxsabine.LaRuche_pronostiqueur p on u.user_id = p.user_id
            INNER JOIN laruchxsabine.LaRuche_competition c on p.competition_id = c.competition_id
            WHERE u.user_id = $idUser;
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function getQuestionAttente($id)
    {
        try {
            $query = "
            SELECT *
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            WHERE pari_ouvert = true and pronostiqueur_id = $id
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function getQuestionEnCours($id)
    {
        try {
            $query = "
            SELECT Q.*,P.*
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            WHERE pari_ouvert = false and pronostiqueur_id = $id AND Q.question_bonus_id NOT IN(
                SELECT Q.question_bonus_id
                FROM laruchxsabine.LaRuche_questionBonus Q
                INNER JOIN laruchxsabine.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
                INNER JOIN laruchxsabine.LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
                WHERE pari_ouvert = false and pronostiqueur_id = $id
            )
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function getQuestionFini($id)
    {
        try {
            $query = "
            SELECT *
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_competition C ON Q.competition_id = C.competition_id
            INNER JOIN laruchxsabine.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            INNER JOIN laruchxsabine.LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
            WHERE pari_ouvert = false and pronostiqueur_id = $id
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function getEquipes()
    {
        try {
            $query = "
            SELECT * 
            FROM laruchxsabine.LaRuche_equipe
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function editAge($age, $idUser): bool
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_users 
            SET age = $age
            WHERE user_id = $idUser
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function editGenre($gender, $idUser): bool
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_users 
            SET Gender = '$gender'
            WHERE user_id = $idUser
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function changeLogo(string $dest, $idUser): bool
    {
        try {
            $query = "
            UPDATE laruchxsabine.LaRuche_users 
            SET src_logo_user = '$dest'
            WHERE user_id = $idUser
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";

            return false;
        }
    }

    public function getProno($matchId)
    {
        try {
            $query = "
            SELECT DISTINCT P.*, U.login
            FROM laruchxsabine.LaRuche_matchApronostiquer M
            INNER JOIN laruchxsabine.LaRuche_pronostique P
            INNER JOIN laruchxsabine.LaRuche_pronostiqueur PP ON P.pronostiqueur_id = PP.pronostiqueur_id
            INNER JOIN laruchxsabine.LaRuche_users U ON PP.user_id = U.user_id
            WHERE P.match_id = $matchId and M.match_id = $matchId
            ORDER BY P.point_obtenu DESC
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            return false;
        }
    }

    public function getMoyene($matchId)
    {
        try {
            $query = "
            SELECT E.nom as nom1, EE.nom as nom2, R.nb_but_equipe1 as resultat1, R.nb_but_equipe2 as resultat2,
                   ROUND(AVG(P.prono_equipe1), 2) as moyenne_equipe1, EE.srcLogo as src2,
                   ROUND(AVG(P.prono_equipe2), 2) as moyenne_equipe2, E.srcLogo as src1, M.date_match,
                   R.resultat_peno
            FROM laruchxsabine.LaRuche_pronostique P
            NATURAL JOIN laruchxsabine.LaRuche_matchApronostiquer M
            INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN laruchxsabine.LaRuche_equipe EE ON M.equipe2_id = EE.equipe_id
            INNER JOIN laruchxsabine.LaRuche_resultatMatch R ON M.match_id = R.match_id
            WHERE M.match_id = $matchId
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt)[0];

        } catch (PDOException $e) {
            return false;
        }
    }

}