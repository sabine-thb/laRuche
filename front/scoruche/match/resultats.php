<section>
    <h1 class="titlePage">Résultats :</h1>

    <p>
        Total points : <?php echo $totalPoints; ?>
    </p>

    <div class="resultPronos">
        <?php foreach ($matchs as $tuple) {
            $timestamp = strtotime($tuple["date_match"]);
            $date_formattee = date("d/m/Y", $timestamp);
            $equipe1Win = $tuple['resultat_peno'] == 'equipe1' ? "jaune" : "";
            $equipe2Win = $tuple['resultat_peno'] == 'equipe2' ? "jaune" : ""; ?>

            <div class="carteProno element">
                <div class="hautCarte">
                    <p>
                        <?php echo $date_formattee; ?> - <?php echo $tuple['heure']; ?>H
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
                             class="logoEquipeUser right">

                        <h5 class="nomEquipe right <?php echo $equipe1Win; ?>">
                            <?php echo $tuple['nom1']; ?>
                        </h5>

                        <p class="right <?php echo $equipe1Win; ?>">
                            <?php echo $tuple['resultat1']; ?>
                        </p>

                        <p class="centreCard">
                            VS
                        </p>

                        <!-- Équipe 2 -->

                        <p class="left <?php echo $equipe2Win; ?>">
                            <?php echo $tuple['resultat2']; ?>
                        </p>

                        <h5 class="nomEquipe left <?php echo $equipe2Win; ?>">
                            <?php echo $tuple['nom2']; ?>
                        </h5>

                        <img src="<?php echo $tuple['src2']; ?>"
                             alt="image_equipe_droite"
                             class="logoEquipeUser left">
                    </div>
                </div>

                <div>
                    <p class="pointsGagne">
                        <span class="labelEquipe">mon prono :</span>
                        <span>
                            <?php if ($tuple['prono_equipe1'] == null) {
                                echo "aucun pari fait pour ce match.";
                            } elseif ($tuple['prono_equipe1'] == $tuple['prono_equipe2']) {
                                if ($tuple['resultat_peno'] == 'equipe1') {
                                    echo "<span class='jaune'>$tuple[prono_equipe1]</span> - $tuple[prono_equipe2]";
                                } else {
                                    echo "$tuple[prono_equipe1] - <span class='jaune'>$tuple[prono_equipe2]</span>";
                                }
                            } else {
                                echo "$tuple[prono_equipe1] - $tuple[prono_equipe2]";
                            }
                            ?>
                        </span>
                    </p>

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
                        <span><?php echo $tuple['pts_Vainq']; ?> points</span>
                    </p>
                </div>
                <div class="center">
                    <a class="lienBonus special"
                       href="competition.php?id=<?php echo $_GET['id']; ?>&action=stats&idMatch=<?php echo $tuple['match_id']; ?>">
                        voir les stats
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>



