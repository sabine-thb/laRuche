<div class="topMain element classement-titre">
    <h2>
        Classement général
    </h2>
</div>


<?php
    $numero = 1;
    foreach ($classement as $personne) {
        $goodUser = $_SESSION['idUser'] == $personne["id"] ? "bleu" : "classic";
?>

    <div class="classement element">
        <div class="<?php echo $goodUser; ?> case-classement">
            <p class="numero">
                <?php echo $numero; ?>
            </p>

            <img src="<?php echo $personne["src_logo_user"]; ?>" alt="logo" class="logo-classement">

            <!-- a faire plus tard : image du profile ici  -->

            <h2>
                <?php echo $personne["login"]; ?>
            </h2>

            <p class ="point">
                <?php echo $personne["points"]; ?>
            </p>
        </div>
    </div>

        <?php
    $numero++;
    }
?>
