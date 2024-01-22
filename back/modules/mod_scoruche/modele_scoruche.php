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

    public function updatePronoQuestionBonus(int $idPronostiqueur,$idQuestion, $prono): bool
    {

        try {
            $query = "
            UPDATE LaRuche.pronoQuestionBonus 
            SET reponse = '$prono'
            WHERE question_bonus_id = $idQuestion and pronostiqueur_id = $idPronostiqueur
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
            SELECT login, total_point as points,description,user_id as id,LaRuche.getClassement(pronostiqueur_id,$idCompet) as position
            FROM LaRuche.pronostiqueur NATURAL JOIN LaRuche.users
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
                   R.nb_but_equipe1 as resultat1, R.nb_but_equipe2 as resultat2, P.point_obtenu,M.heure,R.resultat_peno
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

    public function getSrcLogo($id)
    {
        try {
            $query = "
                SELECT src_logo_user
                FROM LaRuche.users
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
            FROM LaRuche.users U
            NATURAL JOIN LaRuche.pronostiqueur
            INNER JOIN LaRuche.competition join LaRuche.competition c on pronostiqueur.competition_id = c.competition_id
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
            SELECT c.nom,LaRuche.getClassement(p.pronostiqueur_id,c.competition_id) as classement
            FROM LaRuche.users u
            INNER JOIN LaRuche.pronostiqueur p on u.user_id = p.user_id
            INNER JOIN LaRuche.competition c on p.competition_id = c.competition_id
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
            FROM LaRuche.questionBonus Q
            INNER JOIN LaRuche.pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
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
            FROM LaRuche.questionBonus Q
            INNER JOIN LaRuche.pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            WHERE pari_ouvert = false and pronostiqueur_id = $id
            EXCEPT 
            SELECT Q.*,P.*
            FROM LaRuche.questionBonus Q
            INNER JOIN LaRuche.pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            INNER JOIN LaRuche.resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
            WHERE pari_ouvert = false and pronostiqueur_id = $id
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
            FROM LaRuche.questionBonus Q
            INNER JOIN LaRuche.pronoQuestionBonus P on Q.question_bonus_id = P.question_bonus_id
            INNER JOIN LaRuche.resultatQuestionBonus R on Q.question_bonus_id = R.question_bonus_id
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
            FROM LaRuche.equipe E
            NATURAL JOIN LaRuche.matchApronostiquer M
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
            UPDATE LaRuche.users 
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
            UPDATE LaRuche.users 
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
            UPDATE LaRuche.users 
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