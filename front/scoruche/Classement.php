<div id="topClassement">
    <h2>
        Classement général
    </h2>
</div>


<?php
    $numero = 1;
    foreach ($classement as $personne) {
?>

    <div class="classement">
        <p class="numero">
            <?php echo $numero; ?>
        </p>

        <!-- a faire plus tard : image du profile ici  -->

        <h2>
            <?php echo $personne["login"]; ?>
        </h2>

        <p class ="point">
            <?php echo $personne["points"]; ?>
        </p>
    </div>

        <?php
    $numero++;
    }
?>
