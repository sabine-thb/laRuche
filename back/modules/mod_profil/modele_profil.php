<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

class ModeleProfil extends Connexion {


    public function __construct() {
        parent::__construct();
    }


    private function executeQuery($stmt) {

        $stmt->execute();
        // Récupérez les résultats sous forme d'un tableau associatif
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getInfo($id)
    {
        try {
            $query = "
            SELECT U.prenom,U.login,c.nom as nom, U.description, U.age , U.Gender
            FROM laruchxsabine.LaRuche_users U
            NATURAL JOIN laruchxsabine.LaRuche_pronostiqueur
            INNER JOIN laruchxsabine.LaRuche_competition join laruchxsabine.LaRuche_competition c on LaRuche_pronostiqueur.competition_id = c.competition_id
            WHERE user_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt)[0];
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function changeLogo(string $dest,$idUser): bool
    {
        try{
            $query = "
            UPDATE laruchxsabine.LaRuche_users 
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

    public function getCompetAndClassement($idUser)
    {
        try{
            $query = "
            SELECT c.nom,LaRuche_getClassement(p.pronostiqueur_id,c.competition_id) as classement
            FROM laruchxsabine.LaRuche_users u
            INNER JOIN laruchxsabine.LaRuche_pronostiqueur p on u.user_id = p.user_id
            INNER JOIN laruchxsabine.LaRuche_competition c on p.competition_id = c.competition_id
            WHERE u.user_id = $idUser;
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
            UPDATE laruchxsabine.LaRuche_users 
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
            UPDATE laruchxsabine.LaRuche_users 
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
}