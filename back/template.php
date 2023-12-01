<!DOCTYPE html>
<html lang="fr">
<head>
    
    <title>LaRuche</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/239660ff21.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">
</head>
</head>

<body>

    <!-- En-tête -->
    <div class = "container">
    <?php
        echo $menu->afficheMenu();
    ?>
    
    </div>
    
    <main class="text-center">

    <?php
        echo $affichageModule;
    ?>

    </main>

    <!-- Pied de page -->
    <footer class="bg-dark text-white text-center py-3 fixed-bottom">
        <p>Coordonnées de contact / Informations légales</p>
    </footer>

    
</body>
</html>


