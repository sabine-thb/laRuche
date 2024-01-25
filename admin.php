<?php
session_start();

//juste pour etre sur on check si la personne est bien admin sinon on la redirige
if (!isset($_SESSION["loginActif"]) || !isset($_SESSION["adminActif"]) ) {
    header('Location: connexion.php?action=deconnexion');
}

//pour la securité, a revoir
const BASE_URL = "securité";

//on inclue les fichiers de modules correspondant a la page connexion 
include_once('back/modules/mod_admin/mod_admin.php');

//connexion bdd
Connexion::initConnexion();

$module = new ModAdmin();

//fin du tampon
$affichageModule = $module->afficheModule();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    
    <title>LaRuche - admin</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link href="style/css/style.css" rel="stylesheet">
    <link href="style/css/fonts.css" rel="stylesheet">
    <link href="style/css/styleAccAdmin.css" rel="stylesheet">
    <link href="style/css/menu.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="./style/img/logoBleu.ico"/>
    <script src="style/js/inputScore.js"></script>
</head>

<body>

    <!-- En-tête -->
    <header>
        <a href="admin.php" class="linkTitreSite">
                <img src="style/img/abeille.png" alt="logo scoruche" title="retour acceuil admin">
                <h2 class="titreSite">
                        scoruche
                </h2>
        </a>

        <div id="navbar">
                <a href="connexion.php?action=deconnexion" class="linkNavbar linkDefaut">
                    Déconnexion
                </a>
        </div>

    

    </header>

    <main>
        <?php 
            // le code html dynamique, il faut regarder les fichier situé dans front/admin pour voir les possibilité d'affichage
            echo $affichageModule;
        ?>
    </main>
    
</body>
</html>


