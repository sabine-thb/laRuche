<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/modules/Connexion.php';

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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ajoutDemandeUser($prenom, $login, $mail, $mdp, $description): bool
    {

        if ($this->nouveau("login",$login)){
            if ($this->nouveau("mail",$mail)) {
                return $this->ajoutFinal($prenom,$login, $mail, $mdp,$description);
            } else {
                $_SESSION['error'] = "<p> Mail déja utilisé ! </p><br>";
                header('Location: connexion.php?action=inscription');
            }
        }
        else {
            $_SESSION['error'] = "<p> Login déjà utilisé ! </p><br>";
            header('Location: connexion.php?action=inscription');
        }
        return false;
    }

    private function ajoutFinal($prenom, $login, $mail, $mdp, $description): bool
    {
        try {
            $mdp = password_hash($mdp,PASSWORD_BCRYPT,$this->option);
            $query = "
            INSERT INTO laruchxsabine.LaRuche_users (prenom,login,mail,description,password) 
            VALUES (:prenom,:login,:mail,:description,:mdp)
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':mdp', $mdp, PDO::PARAM_STR);
            $stmt->execute();

            return true;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    private function nouveau($champSql, $var): bool
    {
        try {
            $query = "
            SELECT $champSql 
            FROM laruchxsabine.LaRuche_users 
            WHERE $champSql = :variable 
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':variable', $var, PDO::PARAM_STR);
            $resultat = $this->executeQuery($stmt);

            if(isset($resultat[0][$champSql])){
                return false;
            }
            else{
                return true;
            }

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }

    }

    public function verifConnexion($inputLogin, $inputMdp)
    {
        if ($this->estAdmin($inputLogin, $inputMdp))
            return [3, $inputLogin];  //admin good
        else {
            $res = $this->estUser($inputLogin, $inputMdp);

            if ($res == -1 || $res == -404 || $res == 45)
                return $res;
            else
                return [$res, $inputLogin];
        }
    }

    private function estAdmin($inputlogin, $inputMdp): bool
    {
        try {
            $query = "
            SELECT password 
            FROM laruchxsabine.LaRuche_admin 
            WHERE login = :login 
            ";
            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':login', $inputlogin, PDO::PARAM_STR);
            $resultat = $this->executeQuery($stmt);

            return isset($resultat[0]["password"]) && $this->checkMdp($resultat, $inputMdp);

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

    private function estUser($input, $inputMdp): int
    {
        try {
            $query = "
            SELECT * 
            FROM laruchxsabine.LaRuche_users 
            WHERE login = :login or mail = :mail  
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':login', $input, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $input, PDO::PARAM_STR);
            $resultat = $this->executeQuery($stmt);

            if ($resultat[0]["password"] == "reset") {
                $_SESSION['idUser'] = $resultat[0]["user_id"];
                return 45;
            }

            if (isset($resultat[0]["password"]) && $this->checkMdp($resultat, $inputMdp)) {
                if ($resultat[0]["est_verifier"]) {
                    $_SESSION['idUser'] = $resultat[0]["user_id"];
                    return 1;
                } else {
                    return 2;
                }
            } else
                return -1;

        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return -404;
        }
    }

    private function checkMdp($resultat, $mdp): bool
    {
        $mdpCripte = $resultat[0]["password"];

        if (password_verify($mdp, $mdpCripte)) {
            // Le hachage correspond, on vérifie au cas où un nouvel algorithme de hachage
            // serait disponible ou si le coût a été changé
            if (password_needs_rehash($mdpCripte, PASSWORD_BCRYPT, $this->option)) {
                // On crée un nouveau hachage afin de mettre à jour l'ancien
                $newHash = password_hash($mdp, PASSWORD_BCRYPT, $this->option);
                echo"il faut mettre à jour!";

            }
        
            return true;
        }
        return false;
    }

    public function setPassword($mdp, $id): bool
    {
        try {
            $mdp = password_hash($mdp,PASSWORD_BCRYPT,$this->option);
            $query = "
            UPDATE laruchxsabine.LaRuche_users
            SET password = :newMdp
            WHERE user_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $stmt->bindParam(':newMdp', $mdp, PDO::PARAM_STR);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return false;
        }
    }

}