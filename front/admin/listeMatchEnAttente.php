<link rel="stylesheet" href="style/css/inputScore.css">
<script src="style/js/inputScore.js"></script>

<section class="sectionCard">
    <?php foreach ($match as $row) { 
        $dateMatch = $row['date_match'];

        // Convertir la date au format jj/mm/aaaa
        $dateFormatee = date("d/m/Y", strtotime($dateMatch));?>
            <form class="formPronostics" action="admin.php?action=ajouteResultatMatch&idMatch=<?php echo $row['match_id']; ?>" method="post">
                <div class="allCardMatch carteProno">

                <p class="titleMatch">
                        <?php echo $row['nomCompet']; ?> - <?php echo $dateFormatee ?> - <?php echo $row['heure']; ?>H
                </p>

                    <div class="matchContainer">
                        <input type="hidden" name="match_id" value="<?php echo $row['match_id']; ?>">

                        <div class="equ1">
                            <!-- Équipe 1 -->
                            <h5 class="nameEquipe">
                                <?php echo $row['nom1']; ?>
                            </h5>

                            <img src="<?php echo $row['src1']; ?>" class="img-fluid"
                                 alt="image gauche">


                            <div class="custom-input">
                                <i class="fas fa-angle-up arr-up"></i>
                                <label>
                                    <input type="number" name="resultatEquipe1"
                                           class="inputScore right" min="0" max="45" id="prono1" inputmode="numeric"
                                    >
                                </label>
                                <i class="fas fa-angle-down arr-down"></i>
                            </div>

                        </div>

                        <p class="vs">
                            VS
                        </p>

                        <div class="equ2">
                            <!-- Équipe 2 -->
                            <h5 class="nameEquipe">
                                <?php echo $row['nom2']; ?>
                            </h5>

                            <img src="<?php echo $row['src2']; ?>" class="img-fluid"
                                 alt="image droite">

                            <div class="custom-input">
                                <i class="fas fa-angle-up arr-up"></i>
                                <label>
                                    <input type="number" name="resultatEquipe2"
                                           class="inputScore right" min="0" max="45" id="prono2" inputmode="numeric"
                                    >
                                </label>
                                <i class="fas fa-angle-down arr-down"></i>
                            </div>

                        </div>
                    </div>

                    <div class="selectionFinale">
                        <p class="vainqueur"> Qui gagne au tir au but ?</p>

                        <div>
                            <label for="<?php echo $row['match_id']; ?>_equipe1"><?php echo $row['nom1']; ?></label>
                            <input class="" type="radio" id="<?php echo $row['match_id']; ?>_equipe1"
                                   name="<?php echo $row['match_id']; ?>_toggle" value="'equipe1'" checked/>
                        </div>

                        <div>
                            <label for="<?php echo $row['match_id']; ?>_equipe2"><?php echo $row['nom2']; ?></label>
                            <input class="" type="radio" id="<?php echo $row['match_id']; ?>_equipe2"
                                   name="<?php echo $row['match_id']; ?>_toggle" value="'equipe2'" checked/>
                        </div>
                    </div>

                    <div class="buttons">
                        <a href="admin.php?action=supprimerMatch&idMatch=<?php echo $row['match_id']; ?>"
                           class="oneButton"
                           onclick="return confirm('est-tu sur de vouloir supprimez ce match ?\n');"
                        >
                            Supprimer
                        </a>

                        <input class="oneButton" type="submit" value="Enregistrer"
                               title="les points seront attribué automatiquement"
                               onclick="return confirm('confirme tu le résultat ?\nIl n\'y a pas de retour arrière possible pour l\'instant');"
                        >
                    </div>
                </div>
            </form>
    <?php } ?>




 </section>
 
 