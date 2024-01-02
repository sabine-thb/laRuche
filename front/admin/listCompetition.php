<p>
    voici les competitions existantes :
</p><br>
<div class="container mt-5">
    <?php foreach ($tableau as $tuple) { ?>
        <div class="card mb-3">
            <div class="card-body">

                <h5 class="card-title">
                    <?php echo $tuple["nom"] . '  -  ' . $tuple["date_creation"]; ?>
                </h5>

                <p class="card-text">
                    <?php echo $tuple["description"]; ?> 
                </p>

                <a class="btn btn-danger"
                   href="admin.php?action=supprimerCompetition&idCompet=<?php echo $tuple['competition_id']; ?>"
                   onclick="return confirm('Êtes-vous sûr de vouloir supprimez la competition <?php echo $tuple['nom']; ?> ?\n' +
                            'Par mesure de securité cette action est impossible si il y a des matchs dans <?php echo $tuple['nom']; ?>.\n' +
                           'Si vous voulez supprimez rapidement <?php echo $tuple['nom']; ?> rendez-vous dans les details de <?php echo $tuple['nom']; ?>');"
                >
                    Supprimez
                </a>

                <!--<a href="admin.php?action=detailCompetition&idCompet=<?php /*echo $tuple['competition_id']; */?> ">
                    <i class="fa-solid fa-calendar-day"></i>
                </a>-->

            </div>
        </div>
    <?php } ?>
</div>