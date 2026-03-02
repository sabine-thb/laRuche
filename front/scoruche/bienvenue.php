<div class="msgArv">
    <p class="bienvenue">Bienvenue <?php echo htmlspecialchars($_SESSION["loginActif"]); ?> !</p>
    <p class="descr">Que veux-tu faire ?</p>
    <div class="ctaContainer">
        <a href="scoruche.php?action=afficheMesCompet" class="ctaBtn">
            Mes compétitions
        </a>
        <a href="scoruche.php?action=competitionDisponible" class="ctaBtn ctaBtnSecondaire">
            Rejoindre une compétition
        </a>
    </div>
    <img src="./style/img/logoBleu.png" class="logo" alt="">
</div>
