<?php
session_start();

if (isset($_SESSION["loginActif"])) {

    if (isset($_SESSION["adminActif"]) && $_SESSION["adminActif"]){
        $module = "mod_admin" ;
    }
    else if (isset($_GET['module'])){
        $module = $_GET['module'];
    }else{
        $module = "mod_scoruche";
    }

}else{
    $module = 'mod_connexion';
}

const BASE_URL = "securité";

switch($module) {
    case "mod_connexion":
        header('Location: connexion.php?module=mod_connexion');
        break;
        // include_once 'back/modules/mod_connexion/mod_connexion.php';
        // Connexion::initConnexion();
        // $a = new ModConnexion();
        
    case "mod_admin":
        if (isset($_SESSION["adminActif"])) {
            header('Location: admin.php?module=mod_admin');
            break;
            // include_once 'back/modules/mod_admin/mod_admin.php';
            // Connexion::initConnexion();
            // $a = new ModAdmin();
        }else{
            echo" vous n'etes pas connecter en tant que admin !";
            echo '<meta http-equiv="refresh" content="1;url=index.php?module=mod_connexion" />';
        }
        break;
    case "mod_ruche":
        header('Location: ruche.php?module=mod_ruche');
        break;
        // include_once 'back/modules/mod_ruche/mod_ruche.php';
        // Connexion::initConnexion();
        // $a = new ModRuche();
        // break;
    case "mod_scoruche":
        header('Location: scoruche.php');
        break;
        // include_once 'back/modules/mod_scorcast/mod_scorcast.php';
        // Connexion::initConnexion();
        // $a = new ModScorcast();
        // break;
    default:
        die("Module inconnu");
}
// //fin du tampon
// $affichageModule = $a->afficheModule();

// //creation des composants
// include_once 'back/composants/menu/comp_menu.php';
// $menu = new CompMenu($module);

// require_once "template.php";
?>