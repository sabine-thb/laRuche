
<section>

    <?php if (!empty($tableau)){?>
        <p class="titleCompet">
            Voici les compétitions disponibles :
        </p>
        <div class="">
            <?php foreach ($tableau as $tuple) { ?>
                <div class="">
                    <div class="">

                        <h5 class="">
                            <?php echo $tuple["nom"] . '  -  ' . $tuple["date_creation"]; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo $tuple["description"]; ?>
                        </p>

                        <a href="scoruche.php?action=rejoindreCompetition&idCompet=<?php echo $tuple['competition_id']; ?> ">
                            <i class="fa-solid fa-door-open"></i>
                        </a>

                    </div>
                </div>
            <?php } ?>
        </div>
    <?php }else{ ?>
        <p>Il n'y a aucune compétition disponible pour le moment</p>
        <iframe src="https://giphy.com/embed/a93jwI0wkWTQs" width="320" height="240" frameBorder="0" ></iframe>
    <?php } ?>
</section>