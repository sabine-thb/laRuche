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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/239660ff21.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</head>

<body>

    <!-- En-tête -->
    <header>

    <div class="col-md-3 text-end">
        <button  type="button" class="btn btn-outline-primary me-2">
            <a href="scoruche.php?action=afficheMesCompet" class="nav-link px-2">
                retour à mes competitions
            </a>
        </button>

        <button  type="button" class="btn btn-outline-primary me-2">
            <a href="competition.php?action=classement&id=<?php echo $_GET['id']; ?>" class="nav-link px-2">
                classement
            </a>
        </button>

        <button  type="button" class="btn btn-outline-primary me-2">
            <a href="competition.php?action=affichePronostic&id=<?php echo $_GET['id']; ?>" class="nav-link px-2">
                Pronostics
            </a>
        </button>

        <button  type="button" class="btn btn-outline-primary me-2">
            <a href="competition.php?action=resultat&id=<?php echo $_GET['id']; ?>" class="nav-link px-2">
                Resultats
            </a>
        </button>

        <button  type="button" class="btn btn-outline-primary me-2">
            <a href="scoruche.php" class="nav-link px-2">
                Parametres
            </a>
        </button>
    </div>

    <div class="col-md-3 text-end">
        <button  type="button" class="btn btn-outline-primary me-2">
            <a href="connexion.php?action=deconnexion" class="nav-link px-2">
                deconnexion
            </a>
        </button>
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