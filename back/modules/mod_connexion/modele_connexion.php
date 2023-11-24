<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './modules/Connexion.php';

class ModeleConnexion extends Connexion {

    private $option;

    public function __construct() {

        $this->option = [
            'cost' => 10,
        ];

    }


    private function executeQuery($stmt) {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }

    public function ajoutUser($nom,$mdp) {

        $mdp = password_hash($mdp,PASSWORD_BCRYPT,$this->option);

        if ($this->nouveauUser($nom)){
            try {

                $stmt = Connexion::$bdd->prepare('INSERT INTO Users (login,mot_de_passe) VALUES ("'.$nom.'", "'.$mdp.'")');
                $resultat = $stmt->execute();

                return $resultat;

            } catch (PDOException $e) {
                echo "<script>console.log('erreur:" . $e ."');</script>";
                return $e;
            }
        }
        else {
            echo "<p> utilisateur deja inscrit! </p>";
        }
    
    }

    public function nouveauUser($nom) {

        try {

            $stmt = Connexion::$bdd->prepare('SELECT login FROM Users WHERE login="' .$nom. '" ');
            $resultat = $this->executeQuery($stmt);

            if(isset($resultat[0]["login"])){
                return false;
            }
            else{
                return true;
            }

            

        } catch (PDOException $e) {
            return false;
        }

    }

    public function verifUser($nom,$mdp) {

        try {
            
            $stmt = Connexion::$bdd->prepare('SELECT mot_de_passe FROM Users WHERE login="' .$nom. '" ');
            $resultat = $this->executeQuery($stmt);

            if(isset($resultat[0]["mot_de_passe"])){
                $mdpCripte = $resultat[0]["mot_de_passe"];

                if (password_verify($mdp, $mdpCripte)) {
                    // Le hachage correspond, on vérifie au cas où un nouvel algorithme de hachage
                    // serait disponible ou si le coût a été changé
                    if (password_needs_rehash($mdpCripte, PASSWORD_BCRYPT, $this->option)) {
                        // On crée un nouveau hachage afin de mettre à jour l'ancien
                        $newHash = password_hash($mdp, PASSWORD_BCRYPT, $this->option);

                        //todo mettre a jour le mdp dans phpmyadmin
                    }
                
                    return true;
                }
            }

            return false;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return false;
        }
    
    }

}


?>