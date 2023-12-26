<h3>
    classement général
</h3><br>

<?php
    $numero = 1;
    foreach ($classement as $personne) {
?>

    <div>
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
