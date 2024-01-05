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

    public function ajoutDemandeUser($login,$mail,$mdp,$description) {

        //todo verifier que le nouveau utilisateur n'aille pas les meme identifiant que un admin
        if ($this->nouveau("login",$login)){
            if ($this->nouveau("mail",$mail)) {
                return $this->ajoutFinal($login, $mail, $mdp,$description);
            } else {
                $_SESSION['error'] =  "<p> Mail déja utilisé! </p><br>";
                header('Location: index.php?module=mod_connexion&action=inscription'); 
            }
        }
        else {
            $_SESSION['error'] =  "<p> Login déjà utilisé ! </p><br>";
            header('Location: index.php?module=mod_connexion&action=inscription'); 
        }

        return false;
    
    }

    private function ajoutFinal($login,$mail,$mdp,$description) {
        try {
            $mdp = password_hash($mdp,PASSWORD_BCRYPT,$this->option);
            $stmt = Connexion::$bdd->prepare("INSERT INTO LaRuche.users (login,mail,description,password) VALUES ('".$login."', '".$mail."', '".$description."', '".$mdp."')");
            return $stmt->execute();

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return $e;
        }
    }

    private function nouveau($champSql, $var): bool
    {
        try {
            $stmt = Connexion::$bdd->prepare("SELECT " .$champSql. " FROM LaRuche.users WHERE " .$champSql. "='" .$var. "' ");
            $resultat = $this->executeQuery($stmt);

            if(isset($resultat[0][$champSql])){
                return false;
            }
            else{
                return true;
            }

        } catch (PDOException $e) {
            return false;
        }

    }

    public function verifUser($login,$mdp) {

        //ici le login peut etre sois le mail sois le reel login

        try {

            $stmt = Connexion::$bdd->prepare("SELECT password FROM LaRuche.admin WHERE login='" .$login. "' ");
            $resultat = $this->executeQuery($stmt);


            if(isset($resultat[0]["password"]) && $this->checkMdp($resultat,$mdp)){
                return [3,$login];  //admin good
            }else{

                $stmt = Connexion::$bdd->prepare("SELECT * FROM LaRuche.users WHERE login='" .$login. "' or mail='" . $login . "' ");
                $resultat = $this->executeQuery($stmt);

                if ($resultat[0]["password"] == "reset"){
                    $_SESSION['idUser'] = $resultat[0]["user_id"];
                    return 45;
                }

                if( isset($resultat[0]["password"]) && $this->checkMdp($resultat,$mdp) ){

                    if($resultat[0]["est_verifier"]){
                        $_SESSION['idUser'] = $resultat[0]["user_id"];
                        return [1,$resultat[0]["login"]];//user good
                    }else{
                        return [2,$resultat[0]["login"]];//user pas encore verifier
                    }
                }
            }

            return -1;//n'existe pas dans la bdd

        } catch (PDOException $e) {
            echo "<script>console.log('erreur:" . $e ."');</script>";
            return -1;
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

                //todo mettre a jour le mdp dans phpmyadmin
            }
        
            return true;
        }
        return false;
    }

    public function setPassword($mdp,$id)
    {
        try {
            $query = "
            UPDATE LaRuche.users
            SET password = '$mdp'
            WHERE user_id = $id
            ";

            $stmt = Connexion::$bdd->prepare($query);
            $this->executeQuery($stmt);

            return true;
        } catch (PDOException $e) {
            echo "<script>console.log('erreur: $e ');</script>";
            return 404;
        }
    }

}