<section>

    <p class="titleCompet">
        Voici les compétitions dont vous faites partie :
    </p><br>
    <div class="cardContainer">
        <?php foreach ($tableau as $tuple) { ?>
            <div class="cardCompet">

                <h2 class="cardTitle">
                    <?php echo $tuple["nom"]; ?>
                </h2>

                <p class="cardDescr">
                    <?php echo $tuple["description"]; ?>
                </p>

                <a href="competition.php?action=classement&id=<?php echo $tuple['competition_id']; ?>" class="lienPari">
                    Accéder à la Compet'
                </a>

            </div>
        <?php } ?>
    </div>

</section>
