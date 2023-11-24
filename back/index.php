<?php
session_start();

if (isset($_SESSION["loginActif"])) {
    if (isset($_GET['module'])){
        $module = $_GET['module'] ;
    }// else{
    //     $module = "mod_acceuil";
    // }
}else{
    $module = 'mod_connexion';
}

const BASE_URL = "hello_word";

switch($module) {
    case "mod_connexion":
        include_once ('modules/mod_connexion/mod_connexion.php');
        Connexion::initConnexion();
        $a = new ModConnexion();
        break;
    case "mod_joueur":
        include_once ('modules/mod_joueur/mod_joueurs.php');
        Connexion::initConnexion();
        $a = new ModJoueurs();
        break;
    case "mod_equipe":
        include_once ('modules/mod_equipe/mod_equipes.php');
        Connexion::initConnexion();
        $a = new ModEquipes();
        break;
    default:
        die("Module inconnu");
}
//fin du tampon
$affichageModule = $a->afficheModule();

//creation des composants
include_once ('composants/menu/comp_menu.php');
$menu = new CompMenu($module);

require_once "template.php";
?>