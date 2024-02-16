<section>
    <h1 class="titlePage">Stats :</h1>

    <div class="resultPronos">

        <div class="carteProno element">
            <p>
                Moyenne :
            </p>
            <div class="Carte">

                <div class="CorpCarte">
                    <!-- Équipe 1 -->
                    <img src="<?php echo $moyene['src1']; ?>"
                         alt="image_equipe_gauche"
                         class="logoEquipeUser right">

                    <h5 class="nomEquipe right <?php echo $equipe1Win; ?>">
                        <?php echo $moyene['nom1']; ?>
                    </h5>

                    <p class="right <?php echo $equipe1Win; ?>">
                        <?php echo $moyene['moyenne_equipe1']; ?>
                    </p>

                    <p class="centreCard">
                        VS
                    </p>

                    <!-- Équipe 2 -->

                    <p class="left <?php echo $equipe2Win; ?>">
                        <?php echo $moyene['moyenne_equipe2']; ?>
                    </p>

                    <h5 class="nomEquipe left <?php echo $equipe2Win; ?>">
                        <?php echo $moyene['nom2']; ?>
                    </h5>

                    <img src="<?php echo $moyene['src2']; ?>"
                         alt="image_equipe_droite"
                         class="logoEquipeUser left">
                </div>
            </div>
        </div>
        <?php foreach ($prono as $tuple) { ?>
            <div class="carteProno element">
                <div>
                    <p class="pointsGagne">
                        <span class="labelEquipe">prono de <?php echo $tuple['login']; ?>:</span>
                        <span>
                            <?php if ($tuple['prono_equipe1'] == null) {
                                echo "aucun pari fait pour ce match.";
                            } elseif ($tuple['prono_equipe1'] == $tuple['prono_equipe2']) {
                                if ($tuple['vainqueur_prono'] == 'equipe1') {
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
                        <span class="labelEquipe">Points gagnés :</span>
                        <span>
                            <?php echo $tuple['point_obtenu']; ?>
                        </span>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
</section>



