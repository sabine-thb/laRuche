<form class="formPronostics" action="competition.php?action=validationProno&id=<?php echo $_GET['id']; ?>" method="post">

    <div class="topMain">
        <h2>Pronostics</h2>

        <input class="submit" type="submit" value="Enregistrer">
    </div>

    
    <?php foreach ($matchs as $tuple) { ?>

            <div class="container mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <p>
                                <?php echo $tuple['date_match']; ?>
                            </p>
                            <div class="col-md-4">
                                <!-- Équipe 1 -->
                                <h5>
                                    <?php echo $tuple['nom1']; ?>
                                </h5>

                                <img src="<?php echo $tuple['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;">

                                <input type="number" class="form-control" value="<?php echo $tuple['prono_equipe1']; ?>"
                                       name="1prono_match<?php echo $tuple['match_id']; ?>">
                            </div>

                            <div class="col-md-4 d-flex justify-content-center align-items-center">
                                <p>
                                    VS
                                </p>
                            </div>

                            <div class="col-md-4">
                                <!-- Équipe 2 -->
                                <h5>
                                    <?php echo $tuple['nom2']; ?>
                                </h5>

                                <img src="<?php echo $tuple['src2']; ?>" class="img-fluid" style="max-height: 250px; width: auto;">

                                <input type="number" class="form-control" value="<?php echo $tuple['prono_equipe2']; ?>"
                                       name="2prono_match<?php echo $tuple['match_id']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <?php } ?>

</form>
    