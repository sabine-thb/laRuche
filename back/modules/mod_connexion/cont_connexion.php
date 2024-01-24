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
        

        if ($this->checkAllInput()) {
            if ($this->checkForceMdp($_POST['mdp'])) {
                
                $resultat = $this->modele->ajoutDemandeUser($_POST['prenom'],$_POST['login'],$_POST['mail'],$_POST['mdp'],$_POST['description']);

                if ($resultat) {
                    echo "<p class=\"dmdOK\">Une demande a été envoyée à la ruche, vous recevrez un mail lorsque la demande sera acceptée.</p>";
                    
                    
                    $subjectRuche="Demande de compte Scoruche";
            
                    $mailRuche="laruchelive@gmail.com";

                    $to = $mailRuche;

                    $messageRuche="Nouvelle demande ! 
                    Login:". $_POST['login'] . 
                    "Description :". $_POST['description'] . "
                    Veuillez accepter ou refuser cette demande.
                    ";  
                                
                    mail($to, $subjectRuche, $messageRuche);
            
                } else {
                    echo "Erreur lors de la création de compte.";
                }
                $_SESSION['error'] = null;
            }else{
                $_SESSION['error'] = 'Veuillez saisir un mot de passe plus long.<br>';
                header('Location: connexion.php?action=inscription');  
            }
        } else {
            $_SESSION['error'] = '<h3 class="ttChamps">Veuillez remplir tous les champs.</h3><br>';
            header('Location: connexion.php?action=inscription');
        }

    }

    private function checkForceMdp($mdp): bool
    {
        return strlen($mdp) > 5;
    }

    private function checkAllInput(): bool
    {
        return isset($_POST['login'],$_POST['mdp'],$_POST['mail'],$_POST['prenom']) && $_POST['login'] != "" && $_POST['mdp'] != "" && $_POST['mail'] != "" && $_POST['prenom'] != "" ;
    }

    public function afficheFormConnexion() {
        $this->vue->afficheFormulaireConnexion();
    }

    public function connexion() {
        
        $_SESSION['error'] = null;

        $loginTemp = $_POST['login'];
        $mdpTemp = $_POST['mdp'];

        if (isset($_POST['login'],$_POST['mdp'])){

            $resultat = $this->modele->verifUser($loginTemp,$mdpTemp);

            if (isset($resultat[0])&&$resultat[0] == 1) {
                $_SESSION["loginActif"] = $resultat[1];
                $_SESSION["adminActif"] = false;
                echo "<p>Connexion établie !</p>";
                echo "<p>Redirection en cours.</p>";
                echo '<meta http-equiv="refresh" content="3;url=scoruche.php"/>';
            }else if(isset($resultat[0])&&$resultat[0] == 2){
                echo "<p>Votre demande n'a pas encore été traitée par la ruche !</p>";
                echo "Un peu de patience ;)";
                echo '<meta http-equiv="refresh" content="4;url=connexion.php"/>';
            }else if(isset($resultat[0])&&$resultat[0] == 3){
                $_SESSION["loginActif"] = $resultat[1];
                $_SESSION["adminActif"] = true;
                echo "<h3 class=\"coAdmin\">Connecté en tant qu'admin !</h3>";
                echo '<meta http-equiv="refresh" content="2;url=admin.php"/>';
            } else if ($resultat == -1){
                $_SESSION['error'] = "Login ou mot de passe incorrect.";
                $_SESSION["tempLogin"] = $loginTemp;
                $_SESSION["tempPawword"] = $mdpTemp;
                header('Location: connexion.php?action=connexion');
            }else if ($resultat == 45){
                header('Location: connexion.php?action=resetPassword');
            }
            
        } else {
            die("Veuillez remplir tous les champs.");
        }

    }

    public function deconnexion() {

        session_destroy();
        header('Location: connexion.php?action=bienvenue');

    }

    public function nouveauPassword()
    {
        $this->vue->afficheFormNouveauMDP();
    }

    public function setPassword()
    {
        $newMdp = $_POST['mdp'];
        $idUser = $_POST['idUser'];
        $res = $this->modele->setPassword($newMdp,$idUser);

        $link = $_POST['nextPage'];

        if ($res) {
            if ($link == "connexion.php?action=connexion"){ //pas beau du tout mais pas le temps de faire mieux
                echo "<p>Changement enregistrer avec succes</p>";
                echo "<p>Cliquez <a href='$link'>ici</a> pour vous connecter si la redirection auto est fatigué</p>";
                echo "<meta http-equiv='refresh' content='3;url=$link'/>";
            }else
                header("Location: $link");
        } else
            echo "<p>erreur</p>";
    }

}