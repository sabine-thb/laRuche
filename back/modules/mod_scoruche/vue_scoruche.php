<?php

if (!defined("BASE_URL")) {
    die("il faut passer par l'index");
}

require_once './back/vue_generique.php';

class VueScorcast extends VueGenerique {

    public function __construct() {
        parent::__construct();
    }

    public function afficheBienvenue() {
        require_once('./front/scoruche/bienvenue.php');
    }

    public function afficheCompetitionDispo($tableau) {
        require_once('./front/scoruche/listeCompetitionDispo.php');
    }

    public function afficheCompetitionActive($tableau) {
        require_once('./front/scoruche/listeCompetitionActive.php');
    }

    public function afficheClassement($classement) {
        require_once('./front/scoruche/Classement.php');
    }

    public function afficheMatchs($matchs) {
        require_once('./front/scoruche/matchs.php');
    }

    public function afficheResultat($matchs, $totalPoints)
    {
        require_once ('./front/scoruche/resultats.php');
    }

    public function afficheInfoUser($data, $competActive)
    {
        require_once('./front/profil/ViewProfil.php');
    }

    public function afficheButton()
    {
        require_once('./front/scoruche/QuestionBonus/boutons.php');
    }

    public function afficheQuestionAttente($questions,$equipes)
    {
        require_once('./front/scoruche/QuestionBonus/listeQuestionsAttente.php');
    }

    public function afficheQuestionEnCours($questions)
    {
        require_once('./front/scoruche/QuestionBonus/listeQuestionsEnCours.php');
    }

    public function afficheQuestionFini($questions)
    {
        require_once('./front/scoruche/QuestionBonus/listeQuestionsFini.php');
    }

    public function afficheFormEdit($data,$competActive)
    {
        $newURL = $this->changeUrl('action','edit');
        $newUrlEditPassword = $this->changeUrl('action','changePassword');
        require_once("./front/profil/EditProfil.php");
    }

    public function afficheFormNouveauMDP()
    {
        $nextPage = $this->changeUrl('action','editProfil');
        require_once('./front/connexion/nouveauPassword.php');
    }

    public function changeUrl($queryParam, $value): string
    {
        $currentURL = $_SERVER['REQUEST_URI'];
        parse_str(parse_url($currentURL, PHP_URL_QUERY), $queryParams);
        $queryParams[$queryParam] = $value;
        $newQueryString = http_build_query($queryParams);
        return strtok($currentURL, '?') . '?' . $newQueryString;
    }

}