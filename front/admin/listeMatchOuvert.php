<section class="sectionCard">
    <?php foreach ($match as $row) { 
        $dateMatch = $row['date_match'];

        // Convertir la date au format jj/mm/aaaa
        $dateFormatee = date("d/m/Y", strtotime($dateMatch));?>
        <div class="allCardMatch" >
                    <p class="titleMatch">
                        <?php echo $row['nomCompet']; ?> - <?php echo $dateFormatee ?> - <?php echo $row['heure']; ?>H
                    </p>
                <div class="matchContainer">
                    
                    <div class="equ1">
                        <!-- Équipe 1 -->
                        <h5 class="nameEquipe">
                            <?php echo $row['nom1']; ?>
                        </h5>

                        <img src="<?php echo $row['src1']; ?>" class="img-fluid"  alt="logo equipe gauche">

                    </div>

                    
                    <p class="vs">
                            VS
                    </p>
                    

                    <div class="equ2">
                        <!-- Équipe 2 -->
                        <h5 class="nameEquipe">
                            <?php echo $row['nom2']; ?>
                        </h5>

                        <img src="<?php echo $row['src2']; ?>" class="img-fluid"  alt="logo equipe droite">
                    </div>
                </div>

                <div class="buttons">

                    <a href="admin.php?action=supprimerMatch&idMatch=<?php echo $row['match_id']; ?>"
                       class="oneButton"
                       onclick="return confirm('est-tu sur de vouloir supprimez ce match ?\n');"
                    >
                        Supprimer
                    </a>


                    <a href="admin.php?action=miseEnAttenteMatch&idMatch=<?php echo $row['match_id']; ?>"
                       class="oneButton"
                       onclick="return confirm('est-tu sur de vouloir mettre en attente ce match ?\nIl n\'y a pas de retour arrière possible pour l\'instant');"
                    >
                        Fermer les paris
                    </a>

                </div>
        </div>
    <?php } ?>
</section>

