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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> 
    <script src="https://kit.fontawesome.com/239660ff21.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="style/style.css" rel="stylesheet">
    <link href="style/checkBox.css" rel="stylesheet">
    <script src="./style/js/tools.js"></script>
</head>

<body>

    <!-- En-tête -->
    <header>

        <div class="col-md-3 text-end">
            <button  type="button" class="btn btn-outline-primary me-2">
                <a href="admin.php?action=afficherDemande" class="nav-link px-2">
                    voir demande compte
                </a>
            </button>
        
        </div>
         
        <div class="col-md-3 text-end">
            <button  type="button" class="btn btn-outline-primary me-2">
                <a href="admin.php?action=afficheFormCompetition" class="nav-link px-2">
                    créer competition
                </a>
            </button>

            <button  type="button" class="btn btn-outline-primary me-2">
                <a href="admin.php?action=gererCompetition" class="nav-link px-2">
                    gerer competition
                </a>
            </button>
        </div>

        <div class="col-md-3 text-end">
            <button  type="button" class="btn btn-outline-primary me-2">
                <a href="admin.php?action=afficheFormEquipe" class="nav-link px-2">
                    créer equipe
                </a>
            </button>
            
            <button  type="button" class="btn btn-outline-primary me-2">
                <a href="admin.php?action=gererEquipe" class="nav-link px-2">
                    gerer equipe
                </a>
            </button> 
        </div>   
        
        <div class="col-md-3 text-end">
            <button  type="button" class="btn btn-outline-primary me-2">
                <a href="admin.php?action=afficheFormMatch" class="nav-link px-2">
                    créer match
                </a>
            </button>     
            
            <button  type="button" class="btn btn-outline-primary me-2">
                <a href="admin.php?action=gererMatch" class="nav-link px-2">
                    gerer match
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
            // le code html dynamique, il faut regarder les fichier situé dans front/admin pour voir les possibilité d'affichage
            echo $affichageModule;
        ?>
    </main>
    
</body>
</html>


