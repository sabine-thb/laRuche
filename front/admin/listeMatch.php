<div class="container mt-5">
    <?php foreach ($match as $row) { ?>
        <div class="card mb-3">
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

                        <img src="<?php echo $row['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;" alt="logo equipe gauche">

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

                        <img src="<?php echo $row['src2']; ?>" class="img-fluid" style="max-height: 250px; width: auto;" alt="logo equipe droite">
                    </div>
                </div>

                <div class="container text-center mt-5">

                    <a href="admin.php?" onclick="return confirm('est-tu sur de vouloir supprimez ce match ?\n');" >
                        <button class="btn btn-danger" >
                            Supprimez
                        </button>
                    </a>


                    <a>
                        <button class="btn btn-secondary">
                            mettre en attente (fémer les parie)
                        </button>
                    </a>

                </div>

            </div>
        </div>
    <?php } ?>
</div>

