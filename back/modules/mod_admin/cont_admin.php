<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once "modele_admin.php";
require_once "vue_admin.php";

class ContAdmin
{

    private $vue;
    private $modele;

    public function __construct()
    {
        $this->vue = new VueAdmin();
        $this->modele = new ModeleAdmin();
    }

    public function affichage()
    {
        return $this->vue->getAffichage();
    }

    public function bienvenue()
    {
        $this->vue->afficheBienvenue();
    }

    public function afficheDemande()
    {
        $resultat = $this->modele->recupereDemande();
        $this->vue->afficheDemande($resultat);
    }

    public function validerDemande()
    {
        if (isset($_GET["id"])) {
            $resultat = $this->modele->accepteDemande($_GET["id"]);
            if ($resultat) {
                $subjectUser = "Compte scoruche accepté !";

                $mail = $this->modele->getMail($_GET["id"]);
                $mailUser = $mail['mail'];
                $toUser = $mailUser;
                $messageUser = "Ta demande a été acceptée ! 
                    Tu peux désormais te connecter sur la-ruche.eu .
                    ";

                mail($toUser, $subjectUser, $messageUser);

                header('Location: admin.php?action=afficherDemande');

            }
        }
    }

    public function refuserDemande()
    {
        if (isset($_GET["id"])) {
            $resultat = $this->modele->refuseDemande($_GET["id"]);

            if ($resultat) {


                $subjectUserRefused = "Compte scoruche refusé !";

                $mailUserRefused = $_POST['mail'];

                $toUserRefused = $mailUserRefused;

                $messageUserRefused = "Ta demande a été refusée ! 
                Si tu penses qu'elle aurait dû être acceptée, améliore ta description ou contacte nous sur instagram.

                PS: ta desciption sera affichée sur ton profil, donc précise bien qui tu es de facon à ce que tout le monde puisse te reconnaitre 😉
                ";

                mail($toUserRefused, $subjectUserRefused, $messageUserRefused);

                header('Location: admin.php?action=afficherDemande');
            }
        }
    }

    public function supprimerCompetition()
    {
        if (isset($_GET["idCompet"])) {
            $resultat = $this->modele->deleteCompetition($_GET["idCompet"]);

            if ($resultat == -45)
                header('Location: admin.php?action=gererCompetition');
            else if ($resultat = 22000)
                echo "impossible de supprimer la competition car il y a encore des matchs qui en dépendent";
            else
                echo "erreur inconnue - CODE = " . $resultat;

        }
    }

    public function gererComp()
    {
        $competitions = $this->modele->recupereComp();
        $this->vue->afficheListCompet($competitions);
    }

    public function afficheFormCompet()
    {
        $this->vue->afficheFormulaireCompet('');
    }

    public function ajoutCompet()
    {
        if (isset($_POST['name']) && isset($_POST['description']) && $_POST['name'] != "" && $_POST['description'] != "") {

            $result = $this->modele->ajoutCompet($_POST['name'], $_POST['description']);

            if ($result) {
                echo 'la competition ' . $_POST['name'] . ' a bien été ajoutée !<br>';
                echo "allez dans l'onglet 'gerer comp' pour ajouter de nouveaux matchs";
                echo '<meta http-equiv="refresh" content="4;url=admin.php"/>';
            } else {
                $this->vue->afficheFormulaireCompet("erreur serveur veuillez contacter le support ");
            }

        } else {
            $this->vue->afficheFormulaireCompet("veuillez remplir tous les champs !");
        }
    }

    public function ajoutEquipe()
    {
        if (isset($_SESSION['token'], $_POST['token'])) {
            if (null !== ($_SESSION['creationToken'] && time() - $_SESSION['creationToken'] < 60)) {
                if (isset($_POST['name'], $_FILES['logo']['tmp_name'])) {
                    $this->modele->insererEquipe($_POST['name']);
                } else {
                    echo " Remplissez tous les champs et réessayez" . "<br>";
                    echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';
                }
            } else {
                echo " Délai atteint, veuillez réessayer " . "<br>";
                echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';
            }
        } else {
            echo " Erreur de Token, redirection..";
            echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormEquipe"/>';
        }
        unset($_SESSION['token'], $_SESSION['creationToken']);
    }

    public function ajoutMatch()
    {
        if (isset($_SESSION['token'], $_POST['token'])) {
            if (null !== ($_SESSION['creationToken'] && time() - $_SESSION['creationToken'] < 60)) {
                if (isset($_POST['equipe1'], $_POST['equipe2'], $_POST['ptsExact'], $_POST['ptsEcart'], $_POST['ptsVainq'], $_POST['compet'], $_POST['dateMatch'], $_POST['heure'])) {
                    if ($_POST['equipe1'] !== 'default' && $_POST['equipe2'] !== 'default' && $_POST['compet'] !== 'default') {
                        if ($this->modele->insererMatch($_POST['equipe1'], $_POST['equipe2'], $_POST['ptsExact'], $_POST['ptsEcart'], $_POST['ptsVainq'], $_POST['compet'], $_POST['dateMatch'], $_POST['heure'])) {
                            echo " Match bien enregistré ✌️" . "<br>";
//                            echo '<meta http-equiv="refresh" content="3;url=admin.php?action=afficheFormMatch"/>';
                        } else {
                            echo "Erreur lors de l'insertion de l'equipe";
                        }
                        // echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormMatch"/>';
                    } else {
                        echo " Un champ ne peut pas être \"...\"" . "<br>";
                        // echo '<meta http-equiv="refresh" content="1;url=admin.php?action=afficheFormMatch"/>';
                    }
                } else {
                    echo " Remplissez tous les champs et réessayez" . "<br>";
                    echo '<meta http-equiv="refresh" content="5;url=admin.php?action=afficheFormMatch"/>';
                }
            } else {
                echo " Délai atteint, veuillez réessayer";
            }
        } else {
            echo " Erreur de Token, veuillez resseyer";
        }
        unset($_SESSION['token'], $_SESSION['creationToken']);
    }

    public function gererEquipe()
    {
        $eq = $this->modele->getEquipes();
        $this->vue->afficheEquipes($eq);
    }

    public function supprimerEquipe()
    {
        if (isset($_GET["idEquipe"])) {
            $resultat = $this->modele->deleteEquipe($_GET["idEquipe"]);

            if ($resultat) {
                header('Location: admin.php?action=gererEquipe');
            } else {
                echo "erreur lors de la suppression";
            }
        }
    }

    public function supprimerUser()
    {
        if (isset($_GET["idUser"])) {
            $resultat = $this->modele->deleteUser($_GET["idUser"]);

            if ($resultat) {
                header('Location: admin.php?action=gererComptes');
            } else {
                echo "erreur lors de la suppression du compte";
            }
        }

    }

    public function gererMatch()
    {
        $typeMatch = $_GET['type'] ?? 'ouvert';
        $this->vue->afficheButtonMatch();
        $match = $this->recupereMatchEnFonctionType($typeMatch);

        if (!isset($match) || $match == 404)
            echo "<p>Erreur lors de la recherche de matchs</p>";
        else if (count($match) == 0)
            echo "<section><p>Il n'y a aucun match ici actuellement.</p></section>";
        else
            $this->afficheMatchEnFonctionType($typeMatch, $match);
    }

    private function recupereMatchEnFonctionType($type)
    {
        switch ($type) {
            case 'en_attente':
                return $this->modele->getMatchAttente();
            case 'ouvert':
                return $this->modele->getMatchOuvert();
            case 'fini':
                return $this->modele->getMatchfermer();
        }

        return 404; //erreur
    }

    private function afficheMatchEnFonctionType($type, $match)
    {
        switch ($type) {
            case 'en_attente':
                $this->vue->afficheMatchEnAttente($match);
                break;
            case 'ouvert':
                $this->vue->afficheMatchOuvert($match);
                break;
            case 'fini':
                $this->vue->afficheMatchFermer($match);
                break;
        }
    }

    public function afficherFormCreationMatch()
    {
        $token = $this->modele->genereToken(30);
        $eq = $this->modele->getEquipes();
        $compet = $this->modele->getCompet();
        $this->vue->afficheFormCreationMatch($token, $eq, $compet);
    }

    public function afficherFormCreationEquipe()
    {
        $token = $this->modele->genereToken(30);
        $this->vue->afficheFormCreationEquipe($token);
    }

    /*methode private */

    public function miseEnAttenteMatch()
    {
        $res = $this->modele->miseEnAttenteMatch($_GET['idMatch']);

        if ($res)
            header('Location: admin.php?action=gererMatch&type=ouvert');
        else
            echo "<p> Une erreur est survenue.</p>";
    }

    public function ajouteResultatMatch()
    {
        if ($_POST['resultatEquipe1'] != "" && $_POST['resultatEquipe2'] != "") {

            if ($_POST['resultatEquipe1'] == $_POST['resultatEquipe2']) {
                // $equipe_gagnate_peno = array_key_exists("toggle", $_POST) ? "'equipe2'" : "'equipe1'";      ANCIENNE VERSION
                $str_toggle = $_POST['match_id'] . "_toggle";
                array_key_exists($str_toggle, $_POST) ? $equipe_gagnante_peno = $_POST[$str_toggle] : $res = false;
            } else
                $equipe_gagnante_peno = "null";

            $res = $this->modele->miseEnFiniMatch($_POST['match_id'], $_POST['resultatEquipe1'], $_POST['resultatEquipe2'], $equipe_gagnante_peno);
            if ($res)
                header('Location: admin.php?action=gererMatch&type=fermer');
            else
                echo "<p> Une erreur est survenue. </p>";
        } else
            echo "<p> Il manque des inputs </p>";
    }

    public function afficheVueModifieEquipe()
    {
        $equipe = $this->modele->getEquipe($_GET['idEquipe']);

        if ($equipe == 404)
            echo "erreur: équipe introuvable";
        else
            $this->vue->afficheModifieEquipe($equipe[0]);

    }

    public function modifieEquipe()
    {
        $erreur = false;
        $id = $_POST['idEquipe'];
        $newNom = $_POST['name'];

        $this->modele->modifieNomEquipe($newNom, $id);

        if ($_FILES['logo']["tmp_name"] != "") {
            $ancien_src = $this->modele->getSrcLogoEquipe($id);

            if (file_exists($ancien_src))
                unlink($ancien_src);

            $dest = $this->modele->gererLogo();

            if ($dest != null)
                $this->modele->modifielogoEquipe($dest, $id);
            else {
                echo "erreur changement logo";
                $erreur = true;
            }
        }

        if (!$erreur)
            header('Location: admin.php?action=gererEquipe');
    }

    public function afficheRechercheCompte()
    {
        $this->vue->afficheGereUser();
    }

    public function resetPasswordUser()
    {
        $idUser = $_GET['idUser'];

        $rep = $this->modele->resetPasswordUser($idUser);

        if ($rep)
            echo "<section><p>Changement enregistré avec succès.</p></section>";
        else
            echo "<p>erreur</p>";

    }

    public function supprimerMatch()
    {
        if (isset($_GET["idMatch"])) {
            $resultat = $this->modele->deleteMatch($_GET["idMatch"]);

            if ($resultat == -45)
                header('Location: admin.php?action=gererMatch');
            else if ($resultat = 22000)
                echo "impossible de supprimer le match";
            else
                echo "erreur inconnue - CODE = " . $resultat;

        }
    }

    public function afficheFormQuestionBous()
    {
        $compet = $this->modele->getCompet();
        $this->vue->afficheFormQuestionBonus($compet);
    }

    public function ajouteQuestionBonus()
    {
        $titre = $_POST['name'];
        $compet_id = $_POST['compet'];
        $objectif = $_POST['description'];
        $type = $_POST['typeResultat'];
        $pts = $_POST['points'];

        $res = $this->modele->ajouteQuestionBonus($titre, $compet_id, $objectif, $type, $pts);

        if ($res == -45)
            $this->vue->questionEnregister();
        else
            echo "<p>Erreur !</p>";

    }

    public function gererQuestion()
    {
        $type = $_GET['type'] ?? 'ouvert'; // attente - en_cours - fini
        $this->vue->afficheButtonQuestion();
        $question = $this->recupereQuestionEnFonctionType($type);

        if (!isset($question) || $question == 404)
            echo "<p>Erreur lors de la recherche des questions</p>";
        else if (count($question) == 0)
            echo "<section><p>Il n'y a rien a voir ici actuellement.</p></section>";
        else
            $this->afficheQuestionEnFonctionType($type, $question);
    }

    private function recupereQuestionEnFonctionType($type)
    {
        switch ($type) {
            case 'ouvert':
                return $this->modele->getQuestionOuvert();
            case 'en_attente':
                return $this->modele->getQuestionEnAttente();
            case 'fini':
                return $this->modele->getQuestionFini();
            default:
                return 404; //erreur
        }


    }

    private function afficheQuestionEnFonctionType($type, $question)
    {
        switch ($type) {
            case 'ouvert':
                $this->vue->getQuestionOuvert($question);
                break;
            case 'en_attente':
                $equipes = $this->modele->getEquipes();
                $this->vue->afficheQuestionEnAttente($question, $equipes);
                break;
            case 'fini':
                $this->vue->afficheQuestionFini($question);
                break;
            default:
                echo "erreur debug";
        }
    }

    public function miseEnAttenteQuestion()
    {
        $idQuestion = $_GET['idQuestion'];
        $res = $this->modele->miseEnAttenteQuestion($idQuestion);

        if ($res)
            header('Location: admin.php?action=gererQuestionBonus&type=en_attente');
        else
            $this->vue->erreur("un problème inattendu est arrivé, veuillez contacter la ruche au plus vite");
    }

    public function ajouteResultatQuestion()
    {
        if (isset($_POST['reponse']) && isset($_POST['idQuestion'])) {
            $reponse = $_POST['reponse'];
            $idQuestion = $_POST['idQuestion'];

            $res = $this->modele->insertResultatQuestion($idQuestion, $reponse);
            if ($res)
                header('Location: admin.php?action=gererQuestionBonus&type=fini');
            else
                $this->vue->erreur("un problème inattendu est arrivé, veuillez contacter la ruche au plus vite");
        } else
            $this->vue->erreur("impossible de realiser cette action");
    }


}