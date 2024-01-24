<section>
    <?php foreach ($match as $row) { ?>
        <div class="" style="background-color: rgba(11,94,215,0.6)">
                    <p>
                        <?php echo $row['nomCompet']; ?> - <?php echo $row['date_match']; ?> - <?php echo $row['heure']; ?>H
                    </p>
                <div class="matchContainer">
                    
                    <div class="equ1">
                        <!-- Équipe 1 -->
                        <h5>
                            <?php echo $row['nom1']; ?>
                        </h5>

                        <img src="<?php echo $row['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;" alt="logo equipe gauche">

                    </div>

                    
                    <p class="fs-4">
                            VS
                    </p>
                    

                    <div class="equ2">
                        <!-- Équipe 2 -->
                        <h5>
                            <?php echo $row['nom2']; ?>
                        </h5>

                        <img src="<?php echo $row['src2']; ?>" class="img-fluid" style="max-height: 250px; width: auto;" alt="logo equipe droite">
                    </div>
                </div>

                <div class="container text-center mt-5">

                    <a href="admin.php?action=supprimerMatch&idMatch=<?php echo $row['match_id']; ?>"
                       class="btn btn-danger"
                       onclick="return confirm('est-tu sur de vouloir supprimez ce match ?\n');"
                    >
                        Supprimer
                    </a>


                    <a href="admin.php?action=miseEnAttenteMatch&idMatch=<?php echo $row['match_id']; ?>"
                       class="btn btn-secondary"
                       onclick="return confirm('est-tu sur de vouloir mettre en attente ce match ?\nIl n\'y a pas de retour arrière possible pour l\'instant');"
                    >
                        Fermer les paris
                    </a>

                </div>
        </div>
    <?php } ?>
</section>

