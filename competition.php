<?php
session_start();

if (!isset($_SESSION["loginActif"]) ) {
    header('Location: connexion.php?action=deconnexion');
}

//ici on parle de l'id de la competition
//si elle n'est pas presente dans l'url il faut rediriger l'utilisateur
//car il y aura des erreurs par la suite
//todo mettre ce id dans la variable globale de session
if (!isset($_GET["id"]) ) {
    header('Location: scoruche.php');
}


//pour la securité, a revoir
const BASE_URL = "securité";

//on inclue les fichiers de modules correspondant a la page scoruche
include_once('back/modules/mod_scoruche/mod_scoruche.php');

//connexion bdd
Connexion::initConnexion();

$module = new ModScorcast();

$_SESSION['idPronostiqueur'] = $module->getPronostiqueurIdActuelle();
$module->start();

//fin du tampon
$affichageModule = $module->afficheModule();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>LaRuche - scoruche</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/239660ff21.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style/menu.css">
    <link rel="stylesheet" href="./style/compet.css">
    <link rel="stylesheet" href="./style/fonts.css">
    <script src="./style/js/competition.js"></script>
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
            <a href="competition.php?action=classement&id=<?php echo $_GET['id']; ?>" class="linkNavbar linkDefaut"  id="classement">
                    Classement
            </a> 
            <a href="competition.php?action=affichePronostic&id=<?php echo $_GET['id']; ?>" class="linkNavbar linkDefaut" id="prono">
                    Pronostics
            </a>
            <a href="scoruche.php" class="linkNavbar linkDefaut" id="resultats">
                    Résultats
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
    

    <!-- Pied de page -->
    <!-- <footer class="bg-dark text-white text-center py-3 fixed-bottom">
        <p>Coordonnées de contact / Informations légales</p>
    </footer> -->

    
</body>
</html>