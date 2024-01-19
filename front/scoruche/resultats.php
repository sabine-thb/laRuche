<div>
    <div class="topMain element">
        <h2>Résultats</h2>

        <p>
            Total points : <?php echo $totalPoints; ?>
        </p>
    </div>


    <?php foreach ($matchs as $tuple) { ?>
        <div class="carteProno element">
            <div class="hautCarte">
                <p>
                    <?php echo $tuple['date_match']; ?> - <?php echo $tuple['heure']; ?>H
                </p>

                <div class="custom-pts">
                    <p class="nbPoints">
                        <?php echo $tuple['point_obtenu']; ?>
                    </p>
                    <p>pts</p>
                </div>
            </div>

            <div class="Carte">
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
                        VS
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

        </div>
    <?php } ?>
</div>



