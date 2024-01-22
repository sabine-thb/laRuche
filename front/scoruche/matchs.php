
<section class="secPronos">
    <h1 class="titlePage">Mes pronostics :</h1>
        
    <form class="formPronostics" action="competition.php?action=validationProno&id=<?php echo $_GET['id']; ?>" method="post">

    <?php foreach ($matchs as $tuple) { 
        $timestamp = strtotime($tuple["date_match"]);
        $date_formattee = date("d/m/Y", $timestamp);?>

        <div class="carteProno " onload="">
            <p>
                <?php echo $date_formattee ?> - <?php echo $tuple['heure']; ?>H
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
                            class="logoEquipeUser right">

                        <h5 class="nomEquipe right">
                            <?php echo $tuple['nom1']; ?>
                        </h5>

                        <div class="custom-input">
                            <i class="fas fa-angle-up arr-up"></i>
                            <input type="number" name="<?php echo $tuple['match_id']; ?>_prono_equipe1"
                                class="inputScore right" min="0" max="45" id="prono1" inputmode="numeric"
                                value="<?php echo $tuple['prono_equipe1']; ?>"
                            >
                            <i class="fas fa-angle-down arr-down"></i>
                        </div>

                        <p class="centreCard">
                            VS
                        </p>

                        <!-- Équipe 2 -->
                        <div class="custom-input">
                            <i class="fas fa-angle-up arr-up"></i>
                            <input type="number" name="<?php echo $tuple['match_id']; ?>_prono_equipe2"
                                class="inputScore left" min="0" max="45" id="prono2" inputmode="numeric"
                                value="<?php echo $tuple['prono_equipe2']; ?>"
                            >
                            <i class="fas fa-angle-down arr-down"></i>
                        </div>

                        <h5 class="nomEquipe left">
                            <?php echo $tuple['nom2']; ?>
                        </h5>

                        <img src="<?php echo $tuple['src2']; ?>"
                            alt="image_equipe_droite"
                            class="logoEquipeUser left">
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
                    Bon score : <?php echo $tuple['pts_Exact']; ?> points <br> Bon écart + bon vainqueur : <?php echo $tuple['pts_Ecart']; ?> points<br> Bon vainqueur : <?php echo $tuple['pts_Vainq']; ?> points
                </p>

            </div>


    <?php } ?>
    <input class="submit" type="submit" value="Enregistrer">

    </form>


</section>
