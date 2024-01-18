
<section>

    <?php if(!empty($tableau)){ ?>
        <p class="titleCompet">
            Voici les compétitions disponibles :
        </p>
        <div>
            <?php foreach ($tableau as $tuple) { ?>
                <div>
                    <div>

                        <h5>
                            <?php echo $tuple["nom"] . '  -  ' . $tuple["date_creation"]; ?>
                        </h5>
                        <p>
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
        <img src="./style/gif/pageVideHomer.gif" width="320" height="240" frameBorder="0" alt="gif de homer"/>
    <?php } ?>
</section>