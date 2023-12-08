<p>
    voici les competitions disponibles :
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

                <a href="scoruche.php?action=rejoindreCompetition&idCompet=<?php echo $tuple['competition_id']; ?> ">
                    <i class="fa-solid fa-door-open"></i>
                </a>

            </div>
        </div>
    <?php } ?>
</div>