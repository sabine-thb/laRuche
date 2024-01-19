<div class="container mt-5">
    <?php foreach ($match as $row) { ?>
        <div class="card mb-3" style="background-color: rgba(11,94,215,0.6)">
            <div class="card-body">

                <div class="row">
                    <p>
                        <?php echo $row['nomCompet']; ?> - <?php echo $row['date_match']; ?> - <?php echo $row['heure']; ?>H
                    </p>
                    <div class="col-md-4 text-center mt-3">
                        <!-- Équipe 1 -->
                        <h5>
                            <?php echo $row['nom1']; ?>
                        </h5>

                        <img src="<?php echo $row['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;" alt="logo equipe gauche">

                    </div>

                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <p class="fs-4">
                            VS
                        </p>
                    </div>

                    <div class="col-md-4 text-center mt-3">
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
                        Supprimez
                    </a>


                    <a href="admin.php?action=miseEnAttenteMatch&idMatch=<?php echo $row['match_id']; ?>"
                       class="btn btn-secondary"
                       onclick="return confirm('est-tu sur de vouloir mettre en attente ce match ?\nIl n\'y a pas de retour arrière possible pour l\'instant');"
                    >
                        mettre en attente (fémer les parie)
                    </a>

                </div>

            </div>
        </div>
    <?php } ?>
</div>

