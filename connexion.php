<?php
session_start();

//pour la securité, a revoir
const BASE_URL = "securité";

//on inclue les fichiers de modules correspondant a la page connexion 
include_once('back/modules/mod_connexion/mod_connexion.php');

//connexion bdd
Connexion::initConnexion();

$module = new ModConnexion();

//fin du tampon
$affichageModule = $module->afficheModule();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    
    <title>LaRuche - connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/css/style.css" >
    <link rel="stylesheet" href="style/css/fonts.css">
    <link rel="stylesheet" href="style/css/styleConnexion.css">
    <link rel="shortcut icon" type="image/png" href="./style/img/logoBleu.ico"/>
    <script src="./style/js/connexion.js"></script>
</head>

<body>

    <!-- En-tête -->
    <div class="blockContainer">
        <img src="./style/img/logo.svg" class="logoLeague" alt="logo champion cup">
        <div class="line"></div>
    </div>

    <main>
        <a href="connexion.php">
            <img src="./style/img/abeille.png" class="abeille" alt="logo abeille">
        </a>
        <?php echo $affichageModule; // le code html pour cette endroit est dans le dossier front/connexion ?>
    </main>


    <p class="credits">Ruche corp. written by Sab / Arsène / BenJ</p>

    
</body>
</html>


