<section>

    <p class="titleCompet">
        Voici les compétitions dont vous faites partie :
    </p><br>
    <div class="container mt-5">
        <?php foreach ($tableau as $tuple) { ?>
            <div class="card mb-3">
                <div class="cardCompet">

                    <h2 class="cardTitle">
                        <?php echo $tuple["nom"]; ?>
                    </h2>

                    <p class="card-text">
                        <?php echo $tuple["description"]; ?> 
                    </p>

                    <a href="competition.php?action=classement&id=<?php echo $tuple['competition_id']; ?>" class="btn btn-primary">
                        faire des paris
                    </a>

                </div>
            </div>
        <?php } ?>
    </div>

</section>
