<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './modules/Connexion.php';

class ModeleAdmin extends Connexion {

    private $option;

    public function __construct() {

    }


    private function executeQuery($stmt) {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }

    public function recupereDemande() {
        try {
            $stmt = Connexion::$bdd->prepare("SELECT user_id,login,mail FROM laruche.users WHERE est_verifier=false");
            $resultat = $this->executeQuery($stmt);

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }


}


?>