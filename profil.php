<?php
session_start();

if (!isset($_SESSION["loginActif"])) {
    header('Location: connexion.php?action=deconnexion');
}

//pour la securité, a revoir
const BASE_URL = "securité";

//on inclue les fichiers de modules correspondant a la page connexion
include_once('back/modules/mod_profil/mod_profil.php');

//connexion bdd
Connexion::initConnexion();

$module = new ModProfil();

//fin du tampon
$affichageModule = $module->afficheModule();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>LaRuche - scoruche</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css/menu.css">
    <link rel="stylesheet" href="style/css/fonts.css">
    <link rel="stylesheet" href="style/css/profil.css">
    <link rel="stylesheet" href="style/css/styleAccAdmin.css">
    <link rel="shortcut icon" type="image/png" href="./style/img/logoBleu.ico"/>
    <script src="./style/js/competition.js"></script>
    <script src="./style/js/profil/editLogo.js"></script>
</head>

<body>

<!-- En-tête -->
<header>
    <a href="scoruche.php" class="linkTitreSite">
        <img src="style/img/abeille.png" alt="logo scoruche" title="retour à mes competitions">
        <h2 class="titreSite">
            scoruche
        </h2>
    </a>

    <div id="navbar">
        <a href="scoruche.php" class="linkNavbar linkDefaut" id="competition">
            Accueil
        </a>
        <a href="connexion.php?action=deconnexion" class="linkNavbar linkDefaut" id="deco">
            Déconnexion
        </a>
    </div>
</header>


<main>
    <?php
    // le code html dynamique, il faut regarder les fichier situé dans front/scoruche pour voir les possibilité d'affichage
    echo $affichageModule;
    ?>
</main>

</body>
</html>

<?php
Connexion::deconnexionBDD();
?>