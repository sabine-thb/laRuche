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

    public function recupereComp($idUser)
    {
        try {
            $query = "
<<<<<<< HEAD
            SELECT * FROM LaRuche.LaRuche_competition 
            EXCEPT 
            SELECT competition_id,nom,description,date_creation 
            FROM LaRuche.LaRuche_pronostiqueur NATURAL JOIN LaRuche.LaRuche_competition 
            WHERE user_id = $idUser
=======
            SELECT * 
            FROM laruchxsabine.LaRuche_competition 
            WHERE competition_id NOT IN ( 
                SELECT competition_id
                FROM laruchxsabine.LaRuche_pronostiqueur NATURAL JOIN laruchxsabine.LaRuche_competition 
                WHERE user_id = $idUser
            )
>>>>>>> Prod
            ";

            $stmt = Connexion::$bdd->prepare($query);
            return $this->executeQuery($stmt);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e');</script>";
            return $e;
        }
    }

    public function recupereCompActive($idUser)
    {

        try {
            $query = "
            SELECT competition_id,nom,description,date_creation 
<<<<<<< HEAD
            FROM LaRuche.LaRuche_pronostiqueur NATURAL JOIN LaRuche.LaRuche_competition
=======
            FROM laruchxsabine.LaRuche_pronostiqueur 
            NATURAL JOIN laruchxsabine.LaRuche_competition
>>>>>>> Prod
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
<<<<<<< HEAD
            INSERT INTO LaRuche.LaRuche_pronostiqueur(user_id,competition_id) VALUES
            ($idUser,$idCompet)
=======
            INSERT INTO laruchxsabine.LaRuche_pronostiqueur(user_id,competition_id) 
            VALUES ($idUser,$idCompet)
>>>>>>> Prod
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
<<<<<<< HEAD
            UPDATE LaRuche.LaRuche_pronoQuestionBonus 
            SET reponse = '$prono'
=======
            UPDATE laruchxsabine.LaRuche_pronoQuestionBonus 
            SET reponse = :prono
>>>>>>> Prod
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
<<<<<<< HEAD
            SELECT login, total_point as points,description,user_id as id,LaRuche.LaRuche_getClassement(pronostiqueur_id,$idCompet) as position
            FROM LaRuche.LaRuche_pronostiqueur NATURAL JOIN LaRuche.LaRuche_users
=======
            SELECT login, total_point as points,description,user_id as id,LaRuche_getClassement(pronostiqueur_id,$idCompet) as position
            FROM laruchxsabine.LaRuche_pronostiqueur NATURAL JOIN laruchxsabine.LaRuche_users
>>>>>>> Prod
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

    public function recupereMatch(int $idCompet,int $idPronostiqueur)
    {

        try {
            $query = "
            SELECT date_match,E.nom as nom1,E2.nom as nom2,P.prono_equipe1,P.prono_equipe2,P.vainqueur_prono,
                   E.srcLogo as src1,E2.srcLogo as src2,M.match_id,pts_Vainq,pts_Ecart,pts_Exact,heure
<<<<<<< HEAD
            FROM LaRuche.LaRuche_matchApronostiquer as M
            INNER JOIN LaRuche.LaRuche_equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN LaRuche.LaRuche_equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN LaRuche.LaRuche_pronostique P ON P.match_id = M.match_id
=======
            FROM laruchxsabine.LaRuche_matchApronostiquer as M
            INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id=E.equipe_id
            INNER JOIN laruchxsabine.LaRuche_equipe E2 ON M.equipe2_id=E2.equipe_id
            INNER JOIN laruchxsabine.LaRuche_pronostique P ON P.match_id = M.match_id
>>>>>>> Prod
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
<<<<<<< HEAD
            UPDATE LaRuche.LaRuche_pronostique 
=======
            UPDATE laruchxsabine.LaRuche_pronostique 
>>>>>>> Prod
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
<<<<<<< HEAD
                FROM LaRuche.LaRuche_pronostiqueur
=======
                FROM laruchxsabine.LaRuche_pronostiqueur
>>>>>>> Prod
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
                   R.nb_but_equipe1 as resultat1, R.nb_but_equipe2 as resultat2, P.point_obtenu,M.heure,R.resultat_peno
<<<<<<< HEAD
            FROM LaRuche.LaRuche_matchApronostiquer as M
            INNER JOIN LaRuche.LaRuche_equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN LaRuche.LaRuche_equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN LaRuche.LaRuche_pronostique P ON M.match_id = P.match_id  
            INNER JOIN LaRuche.LaRuche_resultatMatch R ON M.match_id = R.match_id
=======
            FROM laruchxsabine.LaRuche_matchApronostiquer as M
            INNER JOIN laruchxsabine.LaRuche_equipe E ON M.equipe1_id = E.equipe_id
            INNER JOIN laruchxsabine.LaRuche_equipe E2 ON M.equipe2_id = E2.equipe_id
            INNER JOIN laruchxsabine.LaRuche_pronostique P ON M.match_id = P.match_id  
            INNER JOIN laruchxsabine.LaRuche_resultatMatch R ON M.match_id = R.match_id
>>>>>>> Prod
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
            SELECT totalPoint($idPronostiqueur,$idCompet) as totalPoints
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
<<<<<<< HEAD
            $query = "
                SELECT src_logo_user
                FROM LaRuche.LaRuche_users
                WHERE user_id = $id
=======
            $query="
            SELECT src_logo_user
            FROM laruchxsabine.LaRuche_users
            WHERE user_id = $id
>>>>>>> Prod
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
<<<<<<< HEAD
            FROM LaRuche.LaRuche_users U
            NATURAL JOIN LaRuche.LaRuche_pronostiqueur
            INNER JOIN LaRuche.LaRuche_competition join LaRuche.LaRuche_competition c on LaRuche_pronostiqueur.competition_id = c.competition_id
=======
            FROM laruchxsabine.LaRuche_users U
            NATURAL JOIN laruchxsabine.LaRuche_pronostiqueur
            INNER JOIN laruchxsabine.LaRuche_competition join laruchxsabine.LaRuche_competition c on laruchxsabine.LaRuche_pronostiqueur.competition_id = c.competition_id
>>>>>>> Prod
            WHERE U.user_id = $idUser
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt)[0];
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function getCompetAndClassement($idUser)
    {
        try{
            $query = "
<<<<<<< HEAD
            SELECT c.nom,LaRuche.LaRuche_getClassement(p.pronostiqueur_id,c.competition_id) as classement
            FROM LaRuche.LaRuche_users u
            INNER JOIN LaRuche.LaRuche_pronostiqueur p on u.user_id = p.user_id
            INNER JOIN LaRuche.LaRuche_competition c on p.competition_id = c.competition_id
=======
            SELECT c.nom,LaRuche_getClassement(p.pronostiqueur_id,c.competition_id) as classement
            FROM laruchxsabine.LaRuche_users u
            INNER JOIN laruchxsabine.LaRuche_pronostiqueur p on u.user_id = p.user_id
            INNER JOIN laruchxsabine.LaRuche_competition c on p.competition_id = c.competition_id
>>>>>>> Prod
            WHERE u.user_id = $idUser;
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function getQuestionAttente($id)
    {
        try{
            $query = "
            SELECT *
<<<<<<< HEAD
            FROM LaRuche.LaRuche_questionBonus Q
            INNER JOIN LaRuche.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
=======
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
>>>>>>> Prod
            WHERE pari_ouvert = true and pronostiqueur_id = $id
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function getQuestionEnCours($id)
    {
        try{
            $query = "
            SELECT Q.*,P.*
<<<<<<< HEAD
            FROM LaRuche.LaRuche_questionBonus Q
            INNER JOIN LaRuche.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            WHERE pari_ouvert = false and pronostiqueur_id = $id
            EXCEPT 
            SELECT Q.*,P.*
            FROM LaRuche.LaRuche_questionBonus Q
            INNER JOIN LaRuche.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            INNER JOIN LaRuche.LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
            WHERE pari_ouvert = false and pronostiqueur_id = $id
=======
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            WHERE pari_ouvert = false and pronostiqueur_id = $id AND Q.question_bonus_id NOT IN(
                SELECT Q.question_bonus_id
                FROM laruchxsabine.LaRuche_questionBonus Q
                INNER JOIN laruchxsabine.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
                INNER JOIN laruchxsabine.LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
                WHERE pari_ouvert = false and pronostiqueur_id = $id
            )
>>>>>>> Prod
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function getQuestionFini($id)
    {
        try{
            $query = "
            SELECT *
<<<<<<< HEAD
            FROM LaRuche.LaRuche_questionBonus Q
            INNER JOIN LaRuche.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            INNER JOIN LaRuche.LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
=======
            FROM laruchxsabine.LaRuche_questionBonus Q
            INNER JOIN laruchxsabine.LaRuche_pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            INNER JOIN laruchxsabine.LaRuche_resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
>>>>>>> Prod
            WHERE pari_ouvert = false and pronostiqueur_id = $id
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function getEquipes($idCompet)
    {
        try{
            $query = "
            SELECT DISTINCT E.nom,E.equipe_id
<<<<<<< HEAD
            FROM LaRuche.LaRuche_equipe E
            NATURAL JOIN LaRuche.LaRuche_matchApronostiquer M
=======
            FROM laruchxsabine.LaRuche_equipe E
            NATURAL JOIN laruchxsabine.LaRuche_matchApronostiquer M
>>>>>>> Prod
            WHERE M.competition_id = $idCompet
            ";
            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt);
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function editAge($age, $idUser): bool
    {
        try{
            $query = "
<<<<<<< HEAD
            UPDATE LaRuche.LaRuche_users 
=======
            UPDATE laruchxsabine.LaRuche_users 
>>>>>>> Prod
            SET age = $age
            WHERE user_id = $idUser
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function editGenre($gender, $idUser): bool
    {
        try{
            $query = "
<<<<<<< HEAD
            UPDATE LaRuche.LaRuche_users 
=======
            UPDATE laruchxsabine.LaRuche_users 
>>>>>>> Prod
            SET Gender = '$gender'
            WHERE user_id = $idUser
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

    public function changeLogo(string $dest,$idUser): bool
    {
        try{
            $query = "
<<<<<<< HEAD
            UPDATE LaRuche.LaRuche_users 
=======
            UPDATE laruchxsabine.LaRuche_users 
>>>>>>> Prod
            SET src_logo_user = '$dest'
            WHERE user_id = $idUser
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        }catch (PDOException $e) {
            var_dump($e);
            return false;
        }
    }

}