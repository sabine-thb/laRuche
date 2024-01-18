<?php
session_start();

if (!isset($_SESSION["loginActif"]) ) {
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
    <script src="https://kit.fontawesome.com/239660ff21.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/css/menu.css">
    <link rel="stylesheet" href="style/css/fonts.css">
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
                Competitions
            </a>
            <li class="drop-menu">
                <img src="<?php echo $_SESSION['srcLogoUser'];?>"
                     alt="logo de <?php echo $_SESSION['loginActif']; ?>"
                     id="logoUser" ondragover="afficherMenuProfil()" onclick="afficherMenuProfil()">
                <ul>
                    <div class="profilDetails">
                        <a href="profil.php?action=editProfil" class="linkNavbar linkDefaut" id="editProfil">
                            Edit profil
                        </a>
                        <a href="connexion.php?action=deconnexion" class="linkNavbar linkDefaut" id="deco">
                            Déconnexion
                        </a>
                    </div>
                </ul>
            </li>
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