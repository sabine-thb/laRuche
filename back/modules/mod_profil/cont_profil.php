<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_profil.php" ;
require_once "vue_profil.php" ;

class ContProfil {

    private $vue;
    private $modele;
    
    public function __construct(){

        $this->vue = new VueProfil();
        $this->modele = new ModeleProfil();

    }

    public function affichage() {
        return $this->vue->getAffichage();
    }

    public function bienvenue(){
        $this->vue->afficheBienvenue();
    }

    public function editProfil()
    {
        $data = $this->modele->getInfo($_SESSION['idUser']);
        $this->vue->afficheFormEdit($data);
    }

    public function recupFormEdit()
    {
        if (isset($_FILES['new_logo']['tmp_name'])){
            $dest = $this->gererLogo();
            if ($dest == null) {
                echo "erreur";
            }else {
                $res = $this->modele->changeLogo($dest);
                if (!$res)
                    echo "<p>Erreur changement logo</p>";
                else {
                    $_SESSION['srcLogoUser'] = $dest;
                    header('Location: profil.php?action=editProfil');
                }
            }
        }
    }

    public function gererLogo()
    {
        $taille = strlen(basename($_FILES["new_logo"]["name"]));

        $taille> 20 ?
            $nom = substr(basename($_FILES["new_logo"]["name"]), -20) :
            $nom = basename($_FILES["new_logo"]["name"]);

        $temp_name = $_FILES["new_logo"]["tmp_name"];

        $nom_dossier = "./style/img/imageProfil/$_SESSION[loginActif]";

        if (!is_dir($nom_dossier))
            mkdir($nom_dossier);

        $destination = "./style/img/imageProfil/$_SESSION[loginActif]/$nom";

        // Déplacer le fichier téléchargé vers un répertoire sur le serveur
        if (!move_uploaded_file($temp_name, $destination)){
            echo "Une erreur s'est produite lors du téléchargement de l'image.<br>";
            return null;
        }else
            return $destination;
    }

}