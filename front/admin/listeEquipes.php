
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
                    <img src="<?php echo $row['srcLogo'];?>"  alt="logo equipe"/>
                </p>
                <a href="admin.php?action=supprimerEquipe&idEquipe=<?php echo $row['equipe_id']; ?> "
                   style="text-decoration: none; padding: 9px; border-radius: 15px; background-color: #c77b7b; color: #ebedf1"
                   onclick="return confirm('est-tu sur de vouloir supprimez <?php echo $row["nom"] ; ?> ?\nCette action n\'est pas possible si <?php echo $row["nom"] ; ?> fait partie d\'un match existant');"
                >
                    supprimer
                </a>
                <a href="admin.php?action=modifierEquipe&idEquipe=<?php echo $row['equipe_id']; ?> "
                   style="text-decoration: none; padding: 9px; border-radius: 15px; background-color: #7b9cc7; color: #ebedf1"
                >
                    modifier
                </a>

            </div>
        </div>
    <?php } ?>
</div>


