<section class="allQuestions">
    <?php foreach ($questions as $oneQuestion) { ?>

        <div class="oneQuestion">

            <h2>
                <span class="nomCompet"><?php echo $oneQuestion['nom']; ?></span> - <?php echo $oneQuestion['titre']; ?>
            </h2>

            <div class="descrBonus">
                <p class="pBonus">
                    <span class="labelEquipe">Objectif :</span>
                    <span><?php echo $oneQuestion['objectif']; ?></span>
                </p>

                <p class="pBonus">
                    <span class="labelEquipe">Type de réponse :</span>
                    <span><?php echo $oneQuestion['type']; ?></span>
                </p>

                <p class="pBonus">
                    <span class="labelEquipe">Bonne réponse :</span>
                    <span><?php echo $oneQuestion['bonne_reponse']; ?></span>
                </p>

                <p class="pBonus">
                    <span class="labelEquipe">Point bonne réponse : </span>
                    <span><?php echo $oneQuestion['point_bonne_reponse']; ?>pts<span>
                </p>

            </div>

        </div>

    <?php } ?>

</section>
