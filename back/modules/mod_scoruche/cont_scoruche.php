<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_scoruche.php";
require_once "vue_scoruche.php";

class ContScorcast
{

    private $vue;
    private $modele;

    public function __construct()
    {
        $this->vue = new VueScorcast();
        $this->modele = new ModeleScorcast();
    }

    public function affichage()
    {
        return $this->vue->getAffichage();
    }

    public function bienvenue()
    {
        $this->vue->afficheBienvenue();
    }

    public function recupereCompetitionDisponible()
    {

        $compets = $this->modele->recupereComp($_SESSION['idUser']);

        $this->vue->afficheCompetitionDispo($compets);

    }

    public function rejoindreCompetition()
    {

        if (isset($_GET['idCompet'])) {
            $result = $this->modele->rejoindreCompet($_GET['idCompet'], $_SESSION['idUser']);

            if ($result) {
                echo "<section>Vous avez rejoint la competiton avec succès.</section>";
            } else {
                echo "<section>Erreur, impossible de rejoindre la compétition.</section>";
            }

        }

    }

    public function afficheCompetActive()
    {
        $compets = $this->modele->recupereCompActive($_SESSION['idUser']);
        $this->vue->afficheCompetitionActive($compets);
    }

    public function afficheClassement()
    {
        //le 'id' dans le get correspond a l'id de la competition
        $classement = $this->modele->recupereClassement($_GET['id']);

        if ($classement == 404)
            echo "<p> Erreur lors de la récuperation du classement </p>";
        else
            $this->vue->afficheClassement($classement);
    }

    public function afficheMatchApronostique()
    {
        $matchs = $this->modele->recupereMatch($_GET['id'], $_SESSION['idPronostiqueur']);
        $this->vue->afficheMatchs($matchs);
    }

    public function valideProno()
    {

        $totalBool = true;

        foreach ($_POST as $key => $value) {

            if (strpos($key, "match_id")) {
                $idMatch = $value;
                $str_input1 = $idMatch . "_prono_equipe1";
                $str_input2 = $idMatch . "_prono_equipe2";
                $input1 = $_POST["$str_input1"];
                $input2 = $_POST["$str_input2"];

                if ($input1 != "" && $input2 != "") {
                    if ($input1 == $input2) {
                        $str_toggle = $idMatch . "_toggle";
                        array_key_exists($str_toggle, $_POST) ? $equipe_gagnante_peno = $_POST[$str_toggle] : $totalBool = false;
                    } else
                        $equipe_gagnante_peno = "null";

                    $res = $this->modele->modifProno($idMatch, $input1, $input2, $equipe_gagnante_peno, $_SESSION['idPronostiqueur']);

                    if (!$res)
                        $totalBool = false;
                }
            }
        }

        if (!$totalBool)
            echo "Erreur pendant au moins une modification";
        else
            header("Location: competition.php?action=affichePronostic&id=$_GET[id]&save");
    }

    public function valideQuestionBonus()
    {
        if (isset($_POST['reponse'])) {
            $prono = $_POST['reponse'];
            $idQuestion = $_POST['idQuestion'];
            $idPronostiqueur = $_SESSION['idPronostiqueur'];

            $res = $this->modele->updatePronoQuestionBonus($idPronostiqueur, $idQuestion, $prono);

            if (!$res)
                echo "<p>Erreur !</p>";
            else
                header("Location: competition.php?action=questionsBonus&id=$_GET[id]");

        }
    }

    public function recupLogoUser()
    {
        $srcLogoUser = $this->modele->getSrcLogo($_SESSION['idUser']);

        if ($srcLogoUser)
            $_SESSION['srcLogoUser'] = $srcLogoUser;
    }

    public function recupIdPronostiqueur()
    {
        $id = $this->modele->PronostiqueurIdActuelle($_SESSION['idUser'], $_GET['id']);

        if ($id)
            $_SESSION['idPronostiqueur'] = $id;
        else
            die("erreur lors de la recuperation de l'id pronostiqueur");
    }

    public function afficheResultat()
    {
        $matchs = $this->modele->recupereMatchFini($_GET['id'], $_SESSION['idPronostiqueur']);

        if ($matchs == 404)
            echo "<p> Erreur lors de la recupération des résultats </p>";
        else {
            $totalPoints = $this->modele->totalPoint($_SESSION['idPronostiqueur'], $_GET['id']);
            $this->vue->afficheResultat($matchs, $totalPoints);
        }

    }

    public function afficheInfoUser()
    {
        $idUser = $_GET['userId'];

        $data = $this->modele->getInfo($idUser);
        $competActive = $this->modele->getCompetAndClassement($idUser);
        $this->vue->afficheInfoUser($data, $competActive);
    }

    public function questionsBonus()
    {
        $type = $_GET['type'] ?? 'attente'; // attente - en_cours - fini
        $this->vue->afficheButton();
        $question = $this->recupereQuestionEnFonctionType($type);

        if (!isset($question) || $question == 404)
            echo "<p>Erreur lors de la recherche des questions</p>";
        else
            $this->afficheQuestionEnFonctionType($type, $question);
    }

    private function recupereQuestionEnFonctionType($type)
    {
        $id = $_SESSION['idPronostiqueur'];
        switch ($type) {
            case 'attente':
                return $this->modele->getQuestionAttente($id);
            case 'en_cours':
                return $this->modele->getQuestionEnCours($id);
            case 'fini':
                return $this->modele->getQuestionFini($id);
        }

        return 404; //erreur
    }

    private function afficheQuestionEnFonctionType($type, $question)
    {
        switch ($type) {
            case 'attente':
                $equipes = $this->modele->getEquipes();
                $this->vue->afficheQuestionAttente($question, $equipes);
                break;
            case 'en_cours':
                $this->vue->afficheQuestionEnCours($question);
                break;
            case 'fini':
                $this->vue->afficheQuestionFini($question);
                break;
        }
    }

    public function editProfil()
    {
        $isUser = $_SESSION['idUser'];

        $data = $this->modele->getInfo($isUser);
        $competActive = $this->modele->getCompetAndClassement($isUser);
        switch ($data['Gender']) {
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

        $this->vue->afficheFormEdit($data, $competActive);
    }

    public function recupFormEdit()
    {
        $idUser = $_SESSION['idUser'];

        if (isset($_FILES['new_logo']['tmp_name'])) {
            $dest = $this->gererLogo();
            if ($dest == null) {
                echo "erreur";
            } else {
                $res = $this->modele->changeLogo($dest, $idUser);
                if (!$res)
                    echo "<p>Erreur changement logo</p>";
                else {
                    $_SESSION['srcLogoUser'] = $dest;
                }
            }
        }
        if (isset($_POST['age'])) {
            $this->modele->editAge($_POST['age'], $idUser);
        }
        if (isset($_POST['gender'])) {
            $this->modele->editGenre($_POST['gender'], $idUser);
        }
        $newUrl = $this->vue->changeUrl('action', 'editProfil');
        header("Location: $newUrl");
    }

    public function gererLogo()
    {
        $taille = strlen(basename($_FILES["new_logo"]["name"]));

        $taille > 20 ?
            $nom = substr(basename($_FILES["new_logo"]["name"]), -20) :
            $nom = basename($_FILES["new_logo"]["name"]);

        $temp_name = $_FILES["new_logo"]["tmp_name"];

        $nom_dossier = "./style/img/imageProfil/$_SESSION[loginActif]";

        if (!is_dir($nom_dossier))
            mkdir($nom_dossier);

        $destination = "./style/img/imageProfil/$_SESSION[loginActif]/$nom";

        // Déplacer le fichier téléchargé vers un répertoire sur le serveur
        if (!move_uploaded_file($temp_name, $destination)) {
            echo "Une erreur s'est produite lors du téléchargement de l'image.<br>";
            return null;
        } else
            return $destination;
    }

    public function afficheFormMdp()
    {
        $this->vue->afficheFormNouveauMDP();
    }

    public function afficheStats()
    {
        $matchId = $_GET['idMatch'];
        $prono = $this->modele->getProno($matchId);
        $moyene = $this->modele->getMoyene($matchId);
        $this->vue->afficheStats($prono, $moyene);
    }

    public function afficheMiniJeu()
    {
        $this->vue->afficheMiniJeu();
    }

    public function afficheBabSnake()
    {
        $this->vue->afficheBabSnake();
    }

    public function afficheHulkV45()
    {
        $this->vue->afficheHulkV45();
    }

}