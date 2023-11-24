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


}


?>