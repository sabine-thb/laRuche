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
        
    case "mod_admin":
        if (isset($_SESSION["adminActif"])) {
            header('Location: admin.php?module=mod_admin');
            break;
        }else{
            echo" vous n'etes pas connecter en tant que admin !";
            echo '<meta http-equiv="refresh" content="1;url=index.php?module=mod_connexion" />';
        }
        break;

    case "mod_ruche":
        header('Location: ruche.php?module=mod_ruche');
        break;

    case "mod_scoruche":
        header('Location: scoruche.php');
        break;

    default:
        die("Module inconnu");
}

