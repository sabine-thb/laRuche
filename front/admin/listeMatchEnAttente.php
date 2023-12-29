
<div class="container mt-5">
    <?php foreach ($match as $row) { ?>
        <form class="formPronostics" action="admin.php" method="post">
            <div class="card mb-3" style="background-color: #c7e0ff">
                <div class="card-body">
                    <div class="row">
                        <p>
                            <?php echo $row['nomCompet']; ?> - <?php echo $row['date_match']; ?>
                        </p>
                        <div class="col-md-4">
                            <!-- Équipe 1 -->
                            <h5>
                                <?php echo $row['nom1']; ?>
                            </h5>

                            <img src="<?php echo $row['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;"
                                 alt="image gauche">

                            <input type="number" class="form-control" name="1resultat_match<?php echo $row['match_id']; ?>">
                        </div>

                        <div class="col-md-4 d-flex justify-content-center align-items-center">
                            <p>
                                VS
                            </p>
                        </div>

                        <div class="col-md-4">
                            <!-- Équipe 2 -->
                            <h5>
                                <?php echo $row['nom2']; ?>
                            </h5>

                            <img src="<?php echo $row['src2']; ?>" class="img-fluid" style="max-height: 250px; width: auto;"
                                 alt="image droite">

                            <input type="number" class="form-control" name="2resultat_match<?php echo $row['match_id']; ?>">
                        </div>

                    </div>

                    <div class="container text-center mt-5">
                        <input class="btn btn-success" type="submit" value="Enregistrer">
                    </div>
                </div>
            </div>
        </form>
    <?php } ?>
</div>

