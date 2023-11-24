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
    case "mod_admin":
        if (isset($_SESSION["adminActif"])) {
            include_once ('modules/mod_admin/mod_admin.php');
            Connexion::initConnexion();
            $a = new ModAdmin();
        }else{
            echo" vous n'etes pas connecter en tant que admin !";
            echo '<meta http-equiv="refresh" content="2;url=index.php?module=mod_connexion" />';
        }
        break;
    // case "mod_equipe":
    //     include_once ('modules/mod_equipe/mod_equipes.php');
    //     Connexion::initConnexion();
    //     $a = new ModEquipes();
    //     break;
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