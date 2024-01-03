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
                
                $resultat = $this->modele->ajoutDemandeUser($_POST['login'],$_POST['mail'],$_POST['mdp'],$_POST['description']);

                if ($resultat) {
                    echo "<p class=\"dmdOK\">Une demande a été envoyée à la ruche, vous recevrez un mail lorsque la demande sera acceptée.</p>";
                } else {
                    echo "Erreur lors de la création de compte.";
                }
                $_SESSION['error'] = null;
            }else{
                $_SESSION['error'] = 'Veuillez saisir un mot de passe plus long.<br>';
                header('Location: connexion.php?action=inscription');  
            }
        } else {
            $_SESSION['error'] = '<h3 class="ttChamps">veuillez remplir tout les champs.</h3><br>';
            header('Location: connexion.php?action=inscription');
        }

    }

    private function checkForceMdp($mdp): bool
    {
        return strlen($mdp) > 5;
    }

    private function checkAllInput(): bool
    {
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

            if (isset($resultat[0])&&$resultat[0] == 1) {
                $_SESSION["loginActif"] = $resultat[1];
                $_SESSION["adminActif"] = false;
                echo "<p>Connexion établie !</p>";
                echo "<p>Redirection en cours.</p>";
                echo '<meta http-equiv="refresh" content="3;url=scoruche.php"/>';
            }else if(isset($resultat[0])&&$resultat[0] == 2){
                echo "Votre demande n'a pas encore été traitée par la ruche !<br>";
                echo "Un peu de patience ;)";
                echo '<meta http-equiv="refresh" content="4;url=connexion.php"/>';
            }else if(isset($resultat[0])&&$resultat[0] == 3){
                $_SESSION["loginActif"] = $resultat[1];
                $_SESSION["adminActif"] = true;
                echo "<h3 class=\"coAdmin\">Connecté en tant que admin !</h3>";
                echo '<meta http-equiv="refresh" content="2;url=admin.php"/>';
            } else {
                echo "Erreur lors de la connexion.<br>";                
                echo "redirection en cours";
                echo '<meta http-equiv="refresh" content="1;url=connexion.php?action=connexion"/>';
            }
            
        } else {
            die("veuillez remplir tout les champs");
        }

    }

    public function deconnexion() {

        session_destroy();
        header('Location: connexion.php?action=bienvenue');

    }

}
?>