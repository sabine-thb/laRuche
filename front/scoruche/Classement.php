<section>
    <h1 class="titlePage">
        Classement général :
    </h1>

    <div class="classementContainer">

        <?php
            $numero = 1;
            foreach ($classement as $personne) {
                $goodUser = $_SESSION['idUser'] == $personne["id"] ? "bleu" : "classic";
        ?>

            <div class="classement ">
                <div class="<?php echo $goodUser; ?> case-classement">
                    <div class="numero">
                        <?php echo $numero; ?>
                    </div>

                    <!-- <a href="competition.php?action=detailUser&id=<?php echo $_GET["id"]; ?>&userId=<?php echo $personne["id"]; ?>">
                        <img src="<?php echo $personne["src_logo_user"]; ?>" alt="logo" class="logo-classement">
                    </a> -->

                    <h2 class="loginUser">
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

    </div>

</section>
    




