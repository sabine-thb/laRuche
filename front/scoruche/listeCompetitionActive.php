<p>
    voici les compétitions dont vous faites partis :
</p><br>
<div class="container mt-5">
    <?php foreach ($tableau as $tuple) { ?>
        <div class="card mb-3">
            <div class="card-body">

                <h5 class="card-title">
                    <?php echo $tuple["nom"]; ?>
                </h5>

                <p class="card-text">
                    <?php echo $tuple["description"]; ?> 
                </p>

                <a href="scoruche.php" class="btn btn-primary">
                    faire des paris
                </a>

            </div>
        </div>
    <?php } ?>
</div>