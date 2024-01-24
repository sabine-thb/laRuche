
<div class="container mt-5">
    <?php foreach ($match as $row) { ?>
        <div class="card mb-3" style="background-color: rgba(25,135,84,0.6)">
            <div class="card-body">
                <div class="oneMatch">
                    <p>
                        <?php echo $row['nomCompet']; ?> - <?php echo $row['date_match']; ?> - <?php echo $row['heure']; ?>H
                    </p>
                    <div class="col-md-4 text-center mt-3" >
                        <!-- Équipe 1 -->
                        <h5>
                            <?php echo $row['nom1']; ?>
                        </h5>

                        <img src="<?php echo $row['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;"
                             alt="image gauche ">

                        <p class=" fs-4 ">
                            <?php echo $row['resultat1']; ?>
                        </p>

                    </div>

                    <div class="">
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

                        <p class="text-center fs-4">
                            <?php echo $row['resultat2']; ?>
                        </p>
                    </div>

                </div>

                <div class="container text-center mt-5">
                    <a class="btn btn-info" onclick="return alert('banane');">
                        voir stat
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

