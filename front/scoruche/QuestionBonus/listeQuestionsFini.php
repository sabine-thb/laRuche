<section>
    <h1 class="titlePage">Voici les bonus qui ont expirés :</h1>
    <div class="allQuestions">
        <?php foreach ($questions as $oneQuestion) { ?>

            <div class="oneQuestion">

                <div class="custom-pts-question">
                    <p class="nbPoints">
                        <?php echo $oneQuestion['point_obtenu']; ?>
                    </p>
                    <p>pts</p>
                </div>

                <h2>
                    <?php echo $oneQuestion['titre']; ?>
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
                        <span class="labelEquipe">Ma reponse :</span>
                        <span><?php echo $oneQuestion['reponse'] ?? "pas de pronostic fait pour cette question"; ?></span>
                    </p>

                    <p class="pBonus">
                        <span class="labelEquipe">Bonne réponse :</span>
                        <span><?php echo $oneQuestion['bonne_reponse']; ?></span>
                    </p>

                    <p class="pBonus">
                        <span class="labelEquipe">Point bonne réponse = </span>
                        <span><?php echo $oneQuestion['point_bonne_reponse']; ?>pts<span>
                    </p>

                </div>

            </div>

        <?php } ?>
    </div>

    <div class="bonusContainer">
        <a href="competition.php?action=questionsBonus&id=<?php echo $_GET['id']; ?>&type=attente" class="lienBonus">
            Voir les bonus actuelles
        </a>
    </div>

</section>
