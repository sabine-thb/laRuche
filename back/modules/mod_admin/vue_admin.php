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
        require_once("./front/admin/afficheDemande.php");
    }

    public function afficheListCompet($tableau)
    {
        require_once("./front/admin/listCompetition.php");
    }

    public function afficheFormulaireCompet($erreur)
    {
        require_once("./front/admin/formulaireCompetition.php");
    }

    public function afficheFormCreationMatch($token, $eq, $comp)
    {
        require_once("./front/admin/formulaireCreationMatch.php");
    }

    public function afficheFormCreationEquipe($token)
    {
        require_once("./front/admin/formulaireCreationEquipe.php");
    }

    public function afficheEquipes($eq)
    {
        require_once("./front/admin/listeEquipes.php");
    }

    public function afficheGereUser()
    {
        require_once("./front/admin/gererUsers.php");
    }

    public function afficheModifieEquipe($equipe)
    {
        require_once("./front/admin/modifieEquipe.php");
    }

    public function afficheButtonMatch()
    {
        require_once("./front/admin/bouttonMatch.html");
    }

    public function afficheMatchOuvert($match)
    {
        require_once("./front/admin/listeMatchOuvert.php");
    }

    public function afficheMatchEnAttente($match)
    {
        require_once("./front/admin/listeMatchEnAttente.php");
    }

    public function afficheMatchFermer($match)
    {
        require_once("./front/admin/listeMatchFini.php");
    }

    public function afficheFormQuestionBonus($comp)
    {
        require_once("./front/admin/QuestionBonus/formQuestionBonus.php");
    }

    public function questionEnregister()
    {
        require_once("./front/admin/QuestionBonus/SuccesSave.html");
    }

    public function afficheButtonQuestion()
    {
        require_once("./front/admin/QuestionBonus/bouttonQuestions.html");
    }

    public function getQuestionOuvert($questions)
    {
        require_once('./front/admin/QuestionBonus/listeQuestionsOuvert.php');
    }

    public function afficheQuestionEnAttente($questions, $equipes)
    {
        require_once('./front/admin/QuestionBonus/listeQuestionsAttente.php');
    }

    public function afficheQuestionFini($questions)
    {
        require_once('./front/admin/QuestionBonus/listeQuestionsFini.php');
    }


}
