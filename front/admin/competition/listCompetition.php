<section class="listCompet">
    <h1 class="titlePage">
        Voici les compétitions existantes :
    </h1>
    <?php foreach ($tableau as $tuple) {
        $date_creation = $tuple["date_creation"];
        $dateFormatee = date("d/m/Y", strtotime($date_creation)); ?>
        <div class="oneCardCompet">

            <p class="competTitle">
                <?php echo $tuple["nom"] . '  -  ' . $dateFormatee; ?>
            </p>

            <p class="competDescr">
                <?php echo $tuple["description"]; ?>
            </p>

            <a class="supprCompet"
               href="admin.php?action=supprimerCompetition&idCompet=<?php echo $tuple['competition_id']; ?>"
               onclick="return confirm('Êtes-vous sûr de vouloir supprimez la competition <?php echo $tuple['nom']; ?> ?\n' +
                       'Cette action est definitive !');"
            >
                Supprimer
            </a>

            <!--<a href="admin.php?action=detailCompetition&idCompet=<?php /*echo $tuple['competition_id']; */ ?> ">
                        <i class="fa-solid fa-calendar-day"></i>
                    </a>-->

        </div>
    <?php } ?>


</section>
