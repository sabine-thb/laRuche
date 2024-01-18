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
        $isUser = $_SESSION['idUser'];

        $data = $this->modele->getInfo($isUser);
        $competActive = $this->modele->getCompetAndClassement($isUser);
        switch ($data['Gender']){
            case 'homme':
                $data["optionGender"] = "Homme";
                break;
            case 'femme':
                $data["optionGender"] = "Femme";
                break;
            case 'autre':
                $data["optionGender"] = "autre";
                break;
            case 'default':
                $data["optionGender"] = "je prefere ne pas dire";
                break;
            case 'croissant':
                $data["optionGender"] = "I'm a croissant";
                break;
        }

        $this->vue->afficheFormEdit($data,$competActive);
    }

    public function recupFormEdit()
    {
        $idUser = $_SESSION['idUser'];

        if (isset($_FILES['new_logo']['tmp_name'])){
            $dest = $this->gererLogo();
            if ($dest == null) {
                echo "erreur";
            }else {
                $res = $this->modele->changeLogo($dest,$idUser);
                if (!$res)
                    echo "<p>Erreur changement logo</p>";
                else {
                    $_SESSION['srcLogoUser'] = $dest;
                }
            }
        }if (isset($_POST['age'])){
            $this->modele->editAge($_POST['age'],$idUser);
        }if (isset($_POST['gender'])){
            $this->modele->editGenre($_POST['gender'],$idUser);
        }

        header('Location: profil.php?action=editProfil');
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

    public function afficheFormMdp()
    {
        $this->vue->afficheFormNouveauMDP();
    }

}