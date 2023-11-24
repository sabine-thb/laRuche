<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './modules/Connexion.php';

class ModeleJoueurs extends Connexion{

    public function __construct() {

    }

    public function getListe(){

        $stmt = Connexion::$bdd->prepare("SELECT id,nom FROM joueurs");
        return $this->executeQuery($stmt);

    }

    public function getDetailsJoueur($id) {

        $stmt = Connexion::$bdd->prepare("SELECT * FROM joueurs WHERE id = " . $id );
        return $this->executeQuery($stmt);
    }

    public function ajoutJoueurs($nom, $biographie) {

        try {

            $stmt = Connexion::$bdd->prepare('INSERT INTO joueurs (nom, biographie) VALUES ("'.$nom.'", "'.$biographie.'")');
            $resultat = $stmt->execute();

            return $resultat;

        } catch (PDOException $e) {
            return $e;
        }
    
    }

    private function executeQuery($stmt) {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }

    

}

?>