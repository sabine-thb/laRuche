<form class="formPronostics" action="competition.php?action=validationProno&id=<?php echo $_GET['id']; ?>" method="post">

    <div class="topMain">
        <h2>Pronostics</h2>

        <input class="submit" type="submit" value="Enregistrer">
    </div>

    
    <?php foreach ($matchs as $tuple) { ?>

        <div class="carteProno" onload="">
            <p>
                <?php echo $tuple['date_match']; ?>
            </p>
                <div class="Carte">
                    <div class="CorpCarte">
                        <input type="hidden"
                               value="<?php echo $tuple['match_id']; ?>"
                               name="<?php echo $tuple['match_id']; ?>_match_id"
                        >
                        <!-- Équipe 1 -->
                        <img src="<?php echo $tuple['src1']; ?>"
                             alt="image_equipe_gauche"
                             class="logoEquipe right">

                        <h5 class="right">
                            <?php echo $tuple['nom1']; ?>
                        </h5>

                        <input type="number" name="<?php echo $tuple['match_id']; ?>_prono_equipe1"
                               class="inputScore right" min="0" id="prono1" inputmode="numeric"
                               value="<?php echo $tuple['prono_equipe1']; ?>"
                        >

                        <p class="centreCard">
                            VS
                        </p>

                        <!-- Équipe 2 -->

                        <input type="number" name="<?php echo $tuple['match_id']; ?>_prono_equipe2"
                               class="inputScore left" min="0" id="prono2" inputmode="numeric"
                               value="<?php echo $tuple['prono_equipe2']; ?>"
                        >

                        <h5 class="left">
                            <?php echo $tuple['nom2']; ?>
                        </h5>

                        <img src="<?php echo $tuple['src2']; ?>"
                             alt="image_equipe_droite"
                             class="logoEquipe left">
                    </div>

                    <div class="selectionFinale">
                        <label>
                            <input class="pristine toggle" type="checkbox" id="<?php echo $tuple['match_id']; ?>_toggle"
                                   name="<?php echo $tuple['match_id']; ?>_toggle" value="on">
                        </label>

                        <?php
                        if($tuple['vainqueur_prono'] != null && $tuple['vainqueur_prono'] == "equipe2"){
                            $idTemp = $tuple["match_id"] . "_toggle";
                            echo '<script>';
                            echo "document.getElementById('$idTemp').click();";
                            echo '</script>';
                        }
                        ?>
                    </div>
                </div>

                <p>
                    Bon score : <?php echo $tuple['pts_Exact']; ?> <br> Bonne ecart + bon vainqueur : <?php echo $tuple['pts_Ecart']; ?> <br> Bon vainqueur : <?php echo $tuple['pts_Vainq']; ?>
                </p>

            </div>


    <?php } ?>

</form>
    