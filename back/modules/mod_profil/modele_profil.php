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
            SELECT src_logo_user,login,c.nom as nom
            FROM LaRuche.users
            NATURAL JOIN LaRuche.pronostiqueur
            INNER JOIN LaRuche.competition join LaRuche.competition c on pronostiqueur.competition_id = c.competition_id
            WHERE user_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);

            return $this->executeQuery($stmt)[0];
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

    public function changeLogo(string $dest): bool
    {
        try{
            $query = "
            UPDATE LaRuche.users 
            SET src_logo_user = '$dest'
            WHERE user_id = $_SESSION[idUser]
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
}