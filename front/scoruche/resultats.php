<div class="topMain">
    <h2>Resultats</h2>

    <p>
        Total points : <?php echo $totalPoints; ?>
    </p>
</div>


<?php foreach ($matchs as $tuple) { ?>

    <div class="carteProno">
        <p>
            <?php echo $tuple['date_match']; ?> - <?php echo $tuple['heure']; ?>H
        </p>

        <div class="CorpCarte">
            <!-- Équipe 1 -->
            <img src="<?php echo $tuple['src1']; ?>"
                 alt="image_equipe_gauche"
                 class="logoEquipe right">

            <h5 class="right">
                <?php echo $tuple['nom1']; ?>
            </h5>

            <p class="right">
                <?php echo $tuple['resultat1']; ?>
            </p>

            <p class="centreCard">
                + <?php echo $tuple['point_obtenu']; ?>
            </p>

            <!-- Équipe 2 -->

            <p class="left">
                <?php echo $tuple['resultat2']; ?>
            </p>

            <h5 class="left">
                <?php echo $tuple['nom2']; ?>
            </h5>

            <img src="<?php echo $tuple['src2']; ?>"
                 alt="image_equipe_droite"
                 class="logoEquipe left">
        </div>


    </div>


<?php } ?>



