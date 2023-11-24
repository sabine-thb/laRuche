<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './modules/Connexion.php';

class ModeleEquipes extends Connexion {

    public function __construct() {

    }

    public function getListe(){

        try {
            $stmt = Connexion::$bdd->prepare("SELECT id,nom,logo FROM Equipes");
            return $this->executeQuery($stmt);
        } catch (PDOException $e) {
            echo "probleme connexion a la base de bonné!" ;
        }

    }

    public function getDetailsEquipe($id) {

        try {
            $stmt = Connexion::$bdd->prepare("SELECT * FROM Equipes WHERE id = " . $id );
            return $this->executeQuery($stmt);  
        } catch (PDOException $e) {
            echo "probleme connexion a la base de bonné!" ;
        }
        
    }

    public function genereToken($nbIteration) {

        $string = "";
        $chaine = "a0b1c2d3e4f5g6h7i8j9klmnpqrstuvwxy123456789";
        srand((double)microtime()*1000000);
        for($i=0; $i<$nbIteration; $i++){
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return $string;
    
    }

    private function executeQuery($stmt) {

        $stmt->execute();

        // Récupérez les résultats sous forme d'un tableau associatif
        $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $resultats;
    }

    public function modif($id,$nom,$annee,$description,$pays,$logo) {

        try {

            //echo 'INSERT INTO Equipes (nom, annee,description,pays,logo) VALUES ("'.$nom.'", '.$annee.', "'.$description.'", "'.$pays.'", "'.$logo.'")';

            if (isset($logo)){
                $stmt = Connexion::$bdd->prepare("UPDATE Equipes SET nom='". $nom ."' , annee_creation= ". $annee . " , description='".$description."' , pays='".$pays ."', logo='".$logo."' WHERE id = " . $id );
            }else{
                $stmt = Connexion::$bdd->prepare("UPDATE Equipes SET nom='". $nom ."' , annee_creation= ". $annee . " , description='".$description."' , pays='".$pays ."' WHERE id = " . $id );
            }
            $resultat = $stmt->execute();


            echo "<script>console.log('debug:" . $resultat ."');</script>";

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }

    }

    public function ajoutEquipe($nom,$annee,$description,$pays,$logo) {

        try {

            //echo 'INSERT INTO Equipes (nom, annee,description,pays,logo) VALUES ("'.$nom.'", '.$annee.', "'.$description.'", "'.$pays.'", "'.$logo.'")';

            $stmt = Connexion::$bdd->prepare('INSERT INTO Equipes (nom, annee_creation,description,pays,logo) VALUES ("'.$nom.'", '.$annee.', "'.$description.'", "'.$pays.'", "'.$logo.'")');
            $resultat = $stmt->execute();


            echo "<script>console.log('debug:" . $resultat ."');</script>";

            return $resultat;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    
    }

}


?>