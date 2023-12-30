<form class="formPronostics" action="competition.php?action=validationProno&id=<?php echo $_GET['id']; ?>" method="post">

    <div class="topMain">
        <h2>Pronostics</h2>

        <input class="submit" type="submit" value="Enregistrer">
    </div>

    
    <?php foreach ($matchs as $tuple) { ?>

        <div class="carteProno">
            <p>
                <?php echo $tuple['date_match']; ?>
            </p>

            <div class="CorpCarte">
                <!-- Équipe 1 -->
                <img src="<?php echo $tuple['src1']; ?>"
                     alt="image_equipe_gauche"
                     class="logoEquipe right">

                <h5 class="right">
                    <?php echo $tuple['nom1']; ?>
                </h5>

                <input type="number" value="<?php echo $tuple['prono_equipe1']; ?>"
                       name="1prono_match<?php echo $tuple['match_id']; ?>"
                        class="inputScore right">

                <p class="centreCard">
                    VS
                </p>

                <!-- Équipe 2 -->

                <input type="number" value="<?php echo $tuple['prono_equipe2']; ?>"
                       name="2prono_match<?php echo $tuple['match_id']; ?>"
                       class="inputScore left">

                <h5 class="left">
                    <?php echo $tuple['nom2']; ?>
                </h5>

                <img src="<?php echo $tuple['src2']; ?>"
                     alt="image_equipe_droite"
                     class="logoEquipe left">
            </div>

            <p>
                Bon score : <?php echo $tuple['pts_Exact']; ?> <br> Bonne ecart + bon vainqueur : <?php echo $tuple['pts_Ecart']; ?> <br> Bon vainqueur : <?php echo $tuple['pts_Vainq']; ?>
            </p>

        </div>


    <?php } ?>

</form>
    