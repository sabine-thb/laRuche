<section>
    <h1 class="titlePage">
        Classement général :
    </h1>

    <div class="classementContainer">

        <?php
        foreach ($classement as $personne) {
            $goodUser = $_SESSION['idUser'] == $personne["id"] ? "bleu" : "classic";
            ?>

            <div class="classement ">
                <div class="<?php echo $goodUser; ?> case-classement">
                    <div class="numero">
                        <?php echo $personne['position']; ?>
                    </div>

                    <?php if ($goodUser == "classic")
                        echo "<a href='competition.php?action=detailUser&id=$_GET[id]&userId=$personne[id]' style='text-decoration: none;color: initial;'>"; ?>
                    <h2 class="loginUser">
                        <span title="<?php echo $personne["description"]; ?>"
                              class="loginUser"><?php echo $personne["login"]; ?></span>
                    </h2>
                    <?php if ($goodUser == "classic")
                        echo "</a>"; ?>

                    <p class="point">
                        <?php echo $personne["points"]; ?>
                    </p>
                </div>
            </div>
        <?php } ?>

    </div>

</section>
    




