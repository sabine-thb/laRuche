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
            SELECT * 
            FROM LaRuche.users
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
}