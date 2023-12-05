<p>
    voici les competitions existanteeeee :
</p><br>
<div class="container mt-5">
    <?php foreach ($tableau as $tuple) { ?>
        <div class="card mb-3">
            <div class="card-body">

                <h5 class="card-title">
                    <?php echo $tuple["nom"] . '-' . $tuple["date_creation"]; ?>
                </h5>
                <p class="card-text">
                    <?php echo $tuple["description"]; ?> 
                </p>
                <a href="index.php?module=mod_admin&action=supprimerCompetition&idCompet= <?php echo $tuple['competition_id']; ?> ">
                    <i class="fa-solid fa-trash"></i>
                </a>
                <a href="index.php?module=mod_admin&action=detailCompetition&idCompet= <?php echo $tuple['competition_id']; ?> ">
                    <i class="fa-solid fa-calendar-day"></i>
                </a>

            </div>
        </div>
    <?php } ?>
</div>