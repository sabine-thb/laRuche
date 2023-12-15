<p>
    voici les Match existants :
</p><br>
<div class="container mt-5">
    <?php foreach ($match as $row) { ?>
        <div class="card mb-3">
            <div class="card-body">

                <h5 class="card-title">
                    <?php echo $row["equipe1_id"] ."VS" . $row["equipe2_id"] ; ?>
                </h5>
                <p class="card-text">
                    <img src="<?php echo $row['date_max_pari'];?>" /> 
                </p>
                <a href="admin.php?action=supprimerMatch&idMatch= <?php echo $row['match_id']; ?> ">
                    <i class="fa-solid fa-trash"></i>
                </a>
                <a href="admin.php?action=detailMatch&idMatch= <?php echo $row['match_id']; ?> ">
                    <i class="fa-solid fa-calendar-day"></i>
                </a>

            </div>
        </div>
    <?php } ?>
</div>

