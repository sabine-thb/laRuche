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
    <script src="https://kit.fontawesome.com/239660ff21.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/fonts.css">
    <link rel="stylesheet" href="./style/styleConnexion.css">
    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyCJOQ3MR_a8t614aGdbvc2zAKG_mmXdWdY",
            authDomain: "ruche-5bf42.firebaseapp.com",
            projectId: "ruche-5bf42",
            storageBucket: "ruche-5bf42.appspot.com",
            messagingSenderId: "604285621560",
            appId: "1:604285621560:web:321dbbaa2c5aff870f5dcd"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
    </script>
</head>

<body>

    <!-- En-tête -->
    <div class = "container">
            <div class="blockContainer">
                <img src="./style/img/logo.svg" class="logoLeague">
                <div class="line"></div>
                <div class="form">
                    <a href="connexion.php">
                        <img src="./style/img/abeille.png" class="abeille" alt="">
                    </a>
                    <main>
                        <?php echo $affichageModule; // le code html pour cette endroit est dans le dossier front/connexion ?>
                    </main>
                </div>
            </div>
    </div>

    <p class="credits">Ruche corp. written by Sab / Arsène / BenJ</p>

    
</body>
</html>


