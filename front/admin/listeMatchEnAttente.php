 <section class="sectionCard">
    <?php foreach ($match as $row) { 
        $dateMatch = $row['date_match'];

        // Convertir la date au format jj/mm/aaaa
        $dateFormatee = date("d/m/Y", strtotime($dateMatch));?>
            <form class="formPronostics" action="admin.php?action=ajouteResultatMatch&idMatch=<?php echo $row['match_id']; ?>" method="post">
                <div class="allCardMatch">

                <p class="titleMatch">
                        <?php echo $row['nomCompet']; ?> - <?php echo $dateFormatee ?> - <?php echo $row['heure']; ?>H
                </p>
                    
                        <div class="matchContainer">
                            <input type="hidden" name="match_id" value="<?php echo $row['match_id']; ?>" >
                            
                            <div class="equ1">
                                <!-- Équipe 1 -->
                                <h5 class="nameEquipe">
                                    <?php echo $row['nom1']; ?>
                                </h5>

                                <img src="<?php echo $row['src1']; ?>" class="img-fluid"
                                    alt="image gauche">

                                <label for="prono1">Score :</label>
                                <input type="number" class="form-control" name="resultatEquipe1" min="0" id="prono1" inputmode="numeric">
                                
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

                                <label for="prono2">Score : </label>
                                <input type="number" class="form-control" name="resultatEquipe2" min="0" id="prono2" inputmode="numeric">
                                
                            </div>

                            <!-- <div class="container text-center mt-1 selectionFinale">
                                <label></label>
                                <input class="pristine toggle" type="checkbox" name="toggle" value="on">
                                
                            </div> -->

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
                            <!-- <a href="#"
                            class="btn btn-info"
                            >
                                Modifier
                            </a> -->
                        </div>
                </div>
            </form>
        <?php } ?>




 </section>
 
 