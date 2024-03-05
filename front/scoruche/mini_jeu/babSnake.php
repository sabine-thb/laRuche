<section>
    <div id="div-container">

        <h5>BabSnake</h5>
        <h4>score: <span id="score">0</span>pts</h4>

        <div class="container-center">
            <h2>Cliquez sur espace pour commencer/mettre pause</h2>

            <div class="game-container">
                <canvas id="gameCanvas" width="750" height="450"></canvas>
            </div>
        </div>
    </div>

    <div id="fenetre-fin-cacher">
        <h3>Bien jouez ! vous avez détruit les babtous !</h3>
        <div>
            <a class="btn-fin" id="rejouez" onclick="resetGame();">Rejouez</a>
            <a class="btn-fin" id="quitter" href="competition.php?action=classement&id=<?php echo $_GET['id']; ?>">Quitter</a>
        </div>
    </div>

    <script src="./style/js/mini_jeu/babSnake.js"></script>
    <link rel="stylesheet" href="./style/css/babSnake.css">
</section>

