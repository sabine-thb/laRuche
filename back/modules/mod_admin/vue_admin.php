<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/vue_generique.php';

class VueAdmin extends VueGenerique
{

    public function __construct()
    {
        parent::__construct();
    }

    public function afficheBienvenue()
    {
        require_once("./front/admin/bienvenue.php");
    }

    public function afficheDemande($tableau)
    {
        require_once("./front/admin/userGestion/afficheDemande.php");
    }

    public function afficheListCompet($tableau)
    {
        require_once("./front/admin/competition/listCompetition.php");
    }

    public function afficheFormulaireCompet($erreur)
    {
        require_once("./front/admin/competition/formulaireCompetition.php");
    }

    public function afficheFormCreationMatch($token, $eq, $comp)
    {
        require_once("./front/admin/match/formulaireCreationMatch.php");
    }

    public function afficheFormCreationEquipe($token)
    {
        require_once("./front/admin/equipe/formulaireCreationEquipe.php");
    }

    public function afficheEquipes($eq)
    {
        require_once("./front/admin/equipe/listeEquipes.php");
    }

    public function afficheGereUser()
    {
        require_once("./front/admin/userGestion/gererUsers.php");
    }

    public function afficheModifieEquipe($equipe)
    {
        require_once("./front/admin/equipe/modifieEquipe.php");
    }

    public function afficheButtonMatch()
    {
        require_once("./front/admin/match/bouttonMatch.html");
    }

    public function afficheMatchOuvert($match)
    {
        require_once("./front/admin/match/listeMatchOuvert.php");
    }

    public function afficheMatchEnAttente($match)
    {
        require_once("./front/admin/match/listeMatchEnAttente.php");
    }

    public function afficheMatchFermer($match)
    {
        require_once("./front/admin/match/listeMatchFini.php");
    }

    public function afficheFormQuestionBonus($comp)
    {
        require_once("./front/admin/questionBonus/formQuestionBonus.php");
    }

    public function questionEnregister()
    {
        require_once("./front/admin/questionBonus/SuccesSave.html");
    }

    public function afficheButtonQuestion()
    {
        require_once("./front/admin/questionBonus/bouttonQuestions.html");
    }

    public function getQuestionOuvert($questions)
    {
        require_once('./front/admin/questionBonus/listeQuestionsOuvert.php');
    }

    public function afficheQuestionEnAttente($questions, $equipes)
    {
        require_once('./front/admin/questionBonus/listeQuestionsAttente.php');
    }

    public function afficheQuestionFini($questions)
    {
        require_once('./front/admin/questionBonus/listeQuestionsFini.php');
    }


}
