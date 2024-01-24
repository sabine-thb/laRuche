
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
                                   <p class="vainqueur"> Qui sera vainqueur au tir au but ?</p>
                                    
                                   <div>
                                        <label for="equipe1"><?php echo $tuple['nom1']; ?></label>
                                        <input class="" type="radio" id="equipe1" name="<?php echo $tuple['match_id']; ?>_toggle" value="'equipe1'" checked />
                                    </div>
                                    <div>
                                        <label for="equipe2"><?php echo $tuple['nom2']; ?></label>
                                        <input class="" type="radio" id="equipe2" name="<?php echo $tuple['match_id']; ?>_toggle" value="'equipe2'" checked />
                                        
                                    </div>
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

                <div>
                    <p class="pointsGagne">
                        <span class="labelEquipe">Bon score :</span> 
                        <span><?php echo $tuple['pts_Exact']; ?> points</span> 
                    </p>

                    <p class="pointsGagne">
                        <span class="labelEquipe">Bon écart + bon vainqueur : </span>
                        <span><?php echo $tuple['pts_Ecart']; ?> points</span>
                </p> 

                    <p class="pointsGagne">
                        <span class="labelEquipe">Bon vainqueur : </span>
                        <span><?php echo $tuple['pts_Vainq']; ?> points</span></p>
                    </div>

            </div>


    <?php }
        if (empty($matchs))
            echo "<p>Aucun match disponible pour le moment</p>";
        else
            echo "<input class='submit' type='submit' value='Enregistrer'>";
    ?>

    </form>


</section>
