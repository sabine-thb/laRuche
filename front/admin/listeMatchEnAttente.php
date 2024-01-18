
<div class="container mt-5">
    <?php foreach ($match as $row) { ?>
        <form class="formPronostics" action="admin.php?action=ajouteResultatMatch&idMatch=<?php echo $row['match_id']; ?>" method="post">
            <div class="card mb-3 carteProno" style="background-color: rgba(108,117,125,0.6)">
                <div class="card-body">
                    <div class="row">
                        <input type="hidden" name="match_id" value="<?php echo $row['match_id']; ?>" >
                        <p>
                            <?php echo $row['nomCompet']; ?> - <?php echo $row['date_match']; ?> - <?php echo $row['heure']; ?>H
                        </p>
                        <div class="col-md-4 text-center mt-3">
                            <!-- Équipe 1 -->
                            <h5>
                                <?php echo $row['nom1']; ?>
                            </h5>

                            <img src="<?php echo $row['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;"
                                 alt="image gauche">

                            <label>
                                <input type="number" class="form-control" name="resultatEquipe1" min="0" id="prono1" inputmode="numeric">
                            </label>
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

                            <img src="<?php echo $row['src2']; ?>" class="img-fluid" style="max-height: 250px; width: auto;"
                                 alt="image droite">

                            <label>
                                <input type="number" class="form-control" name="resultatEquipe2" min="0" id="prono2" inputmode="numeric">
                            </label>
                        </div>

                        <div class="container text-center mt-1 selectionFinale">
                            <label>
                                <input class="pristine toggle" type="checkbox" name="toggle" value="on">
                            </label>
                        </div>

                    </div>

                    <div class="container text-center mt-5">
                        <a href="admin.php?action=supprimerMatch&idMatch=<?php echo $row['match_id']; ?>"
                           class="btn btn-danger"
                           onclick="return confirm('est-tu sur de vouloir supprimez ce match ?\n');"
                        >
                            Supprimez
                        </a>
                        <input class="btn btn-success" type="submit" value="Enregistrer"
                               title="les points seront attribué automatiquement"
                               onclick="return confirm('confirme tu le resultat ?\nIl n\'y a pas de retour arrière possible pour l\'instant');"
                        >
                        <a href="#"
                           class="btn btn-info"
                        >
                            modifier
                        </a>
                    </div>
                </div>
            </div>
        </form>
    <?php } ?>
</div>

