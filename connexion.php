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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <script src="https://kit.fontawesome.com/239660ff21.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/fonts.css">
    <link rel="stylesheet" href="./style/styleConnexion.css">
</head>

<body>

    <!-- En-tête -->
    <div class = "container">
            <div class="blockContainer">
                <img src="./style/img/championsLeague.svg" class="logoLeague">
                <div class="line"></div>
                <div class="form">
                    <img src="./style/img/abeille.png" class="abeille"alt="">
                    
                    <main>
                        <?php echo $affichageModule; // le code html pour cette endroit est dans le dossier front/connexion ?>
                    </main>
                    
                    <button type="button" class="bouton">
                        <a href="connexion.php?module=mod_connexion&action=connexion" class="nav-link px-2"> 
                            Se connecter
                        </a>
                    </button>

                    <button type="button" class="bouton">
                        <a href="connexion.php?module=mod_connexion&action=inscription" class="nav-link px-2">
                            S'inscrire
                        </a>
                    </button>
                </div>
            </div>
    </div>

    <!-- Pied de page -->
    <!-- <footer class="bg-dark text-white text-center py-3 fixed-bottom">
        <p>Coordonnées de contact / Informations légales</p>
    </footer> -->

    
</body>
</html>


