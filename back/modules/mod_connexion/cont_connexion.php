<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_connexion.php" ;
require_once "vue_connexion.php" ;

class ContConnexion {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueConnexion();
        $this->modele = new ModeleConnexion();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){
        $_SESSION['error'] = null;
        $this->vue->afficheBienvenue();
    }

    public function afficheFormInsciption(){
        $this->vue->afficheFormulaireInsciption();
    }

    public function ajout() {
        

        if ($this->checkAllInput() ) {
            if ($this->checkForceMdp($_POST['mdp'])) {
                
                $resultat = $this->modele->ajoutDemandeUser($_POST['login'],$_POST['mail'],$_POST['mdp']);

                if ($resultat) {
                    // $_SESSION["loginActif"] = $_POST['login'];
                    echo "une demande a été envoyer a la ruche vous recevrez un mail lorsque la demande sera acceptée.";
                    $_SESSION['error'] = null;
                } else {
                    echo "Erreur lors de la creation de compte.";
                    $_SESSION['error'] = null;
                }
            }else{
                $_SESSION['error'] = 'veullez saisir un mot de passe plus long<br>';
                header('Location: index.php?module=mod_connexion&action=inscription');  
            }
        } else {
            $_SESSION['error'] = 'veullez remplir tout les champ<br>';
            header('Location: index.php?module=mod_connexion&action=inscription');
        }

    }

    private function checkForceMdp($mdp){
        return strlen($mdp) > 5;
    }

    private function checkAllInput(){
        return isset($_POST['login'],$_POST['mdp'],$_POST['mail']) && $_POST['login'] != "" && $_POST['mdp'] != "" && $_POST['mail'] != "" ;
    }

    public function afficheFormConnexion() {
        $_SESSION['error'] = null;
        $this->vue->afficheFormulaireConnexion();

    }

    public function connexion() {

        $_SESSION['error'] = null;

        if (isset($_POST['login'],$_POST['mdp'])){
            

            $resultat = $this->modele->verifUser($_POST['login'],$_POST['mdp']);

            if ($resultat[0] == 1) {
                $_SESSION["loginActif"] = $resultat[1];
                $_SESSION["adminActif"] = false;
                echo "Conexion etablie !<br>";
                echo "redirection en cours";
                echo '<meta http-equiv="refresh" content="3;url=index.php?module=mod_ruche" />';
            }else if($resultat[0] == 2){
                echo "votre demande n'a pas encore été traiter par la ruche !<br>";
                echo "un peu de patience ;)";
                echo '<meta http-equiv="refresh" content="4;url=index.php?module=mod_connexion" />';
            }else if($resultat[0] == 3){
                $_SESSION["loginActif"] = $resultat[1];
                $_SESSION["adminActif"] = true;
                echo "connecter en tant que admin !";
                echo '<meta http-equiv="refresh" content="2;url=index.php?module=mod_admin" />';
            } else {
                echo "Erreur lors de la connexion.";
            }
            
        } else {
            die("veullez remplir tout les champ");
        }

    }

    public function deconnexion() {

        session_destroy();
        header('Location: index.php?module=mod_connexion&action=bienvenue');

    }

}
?>