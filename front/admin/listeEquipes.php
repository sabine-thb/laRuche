
<!-- <?php echo $row['nom'] . '<img src="'.$row["srcLogo"].'" />'. '<br>';?> -->


<p>
    voici les Equipes existantes :
</p><br>
<div class="container mt-5">
    <?php foreach ($eq as $row) { ?>
        <div class="card mb-3">
            <div class="card-body">

                <h5 class="card-title">
                    <?php echo $row["nom"] ; ?>
                </h5>
                <p class="card-text">
                    <img src="<?php echo $row['srcLogo'];?>" /> 
                </p>
                <a href="admin.php?action=supprimerEquipe&idEquipe=<?php echo $row['equipe_id']; ?> ">
                    <i class="fa-solid fa-trash"></i>
                </a>
                <a href="admin.php?action=detailEquipe&idEquipe=<?php echo $row['equipe_id']; ?> ">
                    <i class="fa-solid fa-calendar-day"></i>
                </a>

            </div>
        </div>
    <?php } ?>
</div>


