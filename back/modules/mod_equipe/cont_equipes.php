<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_equipes.php" ;
require_once "vue_equipes.php" ;

class ContEquipes  {

    private $vue;
    private $modele;

    public function __construct() {

        $this->vue = new VueEquipes();
        $this->modele = new ModeleEquipes();

    }

    public function liste(){

        $tab = $this->modele->getListe();

        $this->vue->affiche_liste($tab);

    }

    public function bienvenue(){

        echo "salut vous etes sur le module equipes !";

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function afficheMenu() {
        $this->vue->menu();
    }

    public function afficheModifEquipe() {
        $tab = $this->modele->getDetailsEquipe($_GET['id']);

        $token = $this->modele->genereToken(10);
        $_SESSION['token'] = $token;
        $_SESSION['token_creation_time'] = time();

        $this->vue->modif($tab,$token);
    }

    public function details(){

        $tab = $this->modele->getDetailsEquipe($_GET['id']);

        $this->vue->affiche_details($tab);

    }

    public function afficheForm(){
        
        $token = $this->modele->genereToken(10);
        $_SESSION['token'] = $token;
        $_SESSION['token_creation_time'] = time();
        $this->vue->afficheFormulaire($token);

    }

    public function ajout(){

        if (isset($_POST['nom']) && isset($_POST['annee']) && isset($_POST['description']) && isset($_POST['pays']) && isset($_POST['token'])) {

            if ($this->checkToken()) {

                $logo = $this->gereLogo();

                $resultat = $this->modele->ajoutEquipe($_POST['nom'],$_POST['annee'],$_POST['description'],$_POST['pays'],$logo);

                if ($resultat) {
                    echo "equipe ajouté avec succès.";
                } else {
                    echo "Erreur lors de l'ajout de l'equipe.<br>";
                }
            }else{
                echo "le token n'est plus valide veullez resseyez ";
            }
        }

    }

    public function modif() {

        if (isset($_POST['nom']) && isset($_POST['annee']) && isset($_POST['description']) && isset($_POST['pays']) && isset($_POST['token'])) {

            if ($this->checkToken()) {

                if(isset($_POST["logo"])) {
                    $logo = $this->gereLogo();
                    $resultat = $this->modele->modif($_GET['id'],$_POST["nom"],$_POST['annee'],$_POST['description'],$_POST['pays'],$logo);
                }else {
                    $resultat = $this->modele->modif($_GET['id'],$_POST["nom"],$_POST['annee'],$_POST['description'],$_POST['pays'],null);
                }

                if ($resultat) {
                    echo "equipe modifié avec succès.";
                } else {
                    echo "Erreur lors de la modif de l'equipe.<br>";
                }
            }else{
                echo "le token n'est plus valide veullez resseyez ";
            }
        }


    }

    private function checkToken() {
    
        return $_POST['token'] == $_SESSION['token'] && (time() - $_SESSION['token_creation_time']) < 300  ;
    
    }

    private function gereLogo(){

        // Dossier de destination pour les logos
        $dossier_destination = 'modules/mod_equipe/logo/';
        // Chemin du fichier temporaire
        $fichier_temporaire = $_FILES['logo']['tmp_name'];
        // Nom du fichier d'origine

        $nom_fichier = $_FILES['logo']['name'];
        //nouveau chemin complet a ajouter a la bd
        $new_path = $dossier_destination . $nom_fichier;

        // Vérifie que le fichier est un fichier image (vous pouvez ajouter d'autres vérifications si nécessaire)
        $extensions_autorisees = array('jpg', 'jpeg', 'png', 'gif');
        $extension_fichier = strtolower(pathinfo($nom_fichier, PATHINFO_EXTENSION));
        if (in_array($extension_fichier, $extensions_autorisees)) {
            // Déplace le fichier temporaire vers le dossier de destination
            if (move_uploaded_file($fichier_temporaire, $new_path)) {
                echo 'Le fichier a été téléchargé avec succès.';
                return $new_path;
            } else {
                echo 'Erreur lors du téléchargement du fichier.';
            }
        } else {
            echo 'Type de fichier non autorisé. Seules les images sont autorisées (jpg, jpeg, png, gif).';
        }
    }
    

}


?>