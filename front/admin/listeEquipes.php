
<!-- <?php echo $row['nom'] . '<img src="'.$row["srcLogo"].'" />'. '<br>';?> -->

<section>
    <h1 class="titlePage">
        Voici les équipes existantes :
    </h1>
    <div class="gridContainer">
        <?php foreach ($eq as $row) { ?>
            <div class="oneEquipe">

                    <h5 class="card-title">
                        <?php echo $row["nom"] ; ?>
                    </h5>
                    <p class="card-text">
                        <img src="<?php echo $row['srcLogo'];?>"  class="logoEquipe" alt="logo equipe"/>
                    </p>
                    <div class="linkActions">
                        <a href="admin.php?action=supprimerEquipe&idEquipe=<?php echo $row['equipe_id']; ?> "
                        onclick="return confirm('Est-tu sur de vouloir supprimez <?php echo $row['nom'] ; ?> ? Cette action n\'est pas possible si <?php echo $row['nom'] ; ?> fait partie d\'un match existant.');"
                        class="link supprEquipe">
                            Supprimer
                        </a>
                        <a href="admin.php?action=modifierEquipe&idEquipe=<?php echo $row['equipe_id']; ?> " class="link modifEquipe">
                            Modifier
                        </a>

                    </div>
                    
            </div>
        <?php } ?>
    </div>

</section>




