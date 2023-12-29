
<div>
    <h2>Resultats</h2>

    <p>
        Total points : <?php echo $totalPoints; ?>
    </p>
</div>

<?php foreach ($matchs as $tuple) { ?>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <p>
                        <?php echo $tuple['date_match']; ?>
                    </p>
                    <div class="col-md-4 text-center mt-3">
                        <!-- Équipe 1 -->
                        <h5>
                            <?php echo $tuple['nom1']; ?>
                        </h5>

                        <img src="<?php echo $tuple['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;">

                        <p>
                            <?php echo $tuple['resultat1']; ?>
                        </p>

                    </div>

                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <p class="fs-4 text-success">
                            + <?php echo $tuple['point_obtenu']; ?>
                        </p>
                    </div>

                    <div class="col-md-4 text-center mt-3">
                        <!-- Équipe 2 -->
                        <h5>
                            <?php echo $tuple['nom2']; ?>
                        </h5>

                        <img src="<?php echo $tuple['src2']; ?>" class="img-fluid" style="max-height: 250px; width: auto;">

                        <p>
                            <?php echo $tuple['resultat2']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>

