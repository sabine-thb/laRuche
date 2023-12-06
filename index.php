<?php
session_start();

if (isset($_SESSION["loginActif"])) {
    if (isset($_GET['module'])){
        $module = $_GET['module'] ;
    }else{
        $module = "mod_ruche";
    }
}else{
    $module = 'mod_connexion';
}

const BASE_URL = "hello_word";

switch($module) {
    case "mod_connexion":
        include_once 'back/modules/mod_connexion/mod_connexion.php';
        Connexion::initConnexion();
        $a = new ModConnexion();
        break;
    case "mod_admin":
        if (isset($_SESSION["adminActif"])) {
            include_once 'back/modules/mod_admin/mod_admin.php';
            Connexion::initConnexion();
            $a = new ModAdmin();
        }else{
            echo" vous n'etes pas connecter en tant que admin !";
            echo '<meta http-equiv="refresh" content="1;url=index.php?module=mod_connexion" />';
        }
        break;
    case "mod_ruche":
        include_once 'back/modules/mod_ruche/mod_ruche.php';
        Connexion::initConnexion();
        $a = new ModRuche();
        break;
    case "mod_scorcast":
        include_once 'back/modules/mod_scorcast/mod_scorcast.php';
        Connexion::initConnexion();
        $a = new ModScorcast();
        break;
    default:
        die("Module inconnu");
}
//fin du tampon
$affichageModule = $a->afficheModule();

//creation des composants
include_once 'back/composants/menu/comp_menu.php';
$menu = new CompMenu($module);

require_once "template.php";
?>