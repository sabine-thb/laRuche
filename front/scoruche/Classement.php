<section>

    <?php if (!empty($prochainMatch)) { ?>
    <div class="prochainMatchBlock">
        <p class="prochainMatchLabel">Prochain match à l'affiche</p>
        <div class="prochainMatchEquipes">
            <div class="prochainMatchEquipe">
                <?php if (!empty($prochainMatch['src1'])): ?>
                    <img src="<?php echo htmlspecialchars($prochainMatch['src1']); ?>" alt="<?php echo htmlspecialchars($prochainMatch['nom1']); ?>" class="prochainMatchLogo">
                <?php endif; ?>
                <span><?php echo htmlspecialchars($prochainMatch['nom1']); ?></span>
            </div>
            <div class="prochainMatchVs">
                <span class="prochainMatchDate"><?php echo date('d/m/Y', strtotime($prochainMatch['date_match'])); ?></span>
                <span class="prochainMatchHeure"><?php echo substr($prochainMatch['heure'], 0, 5); ?></span>
            </div>
            <div class="prochainMatchEquipe">
                <?php if (!empty($prochainMatch['src2'])): ?>
                    <img src="<?php echo htmlspecialchars($prochainMatch['src2']); ?>" alt="<?php echo htmlspecialchars($prochainMatch['nom2']); ?>" class="prochainMatchLogo">
                <?php endif; ?>
                <span><?php echo htmlspecialchars($prochainMatch['nom2']); ?></span>
            </div>
        </div>
        <a href="scoruche.php?action=affichePronostic&id=<?php echo (int)$_GET['id']; ?>" class="prochainMatchBtn">
            Pronostiquer
        </a>
    </div>
    <?php } ?>

    <h1 class="titlePage">
        Classement général :
    </h1>

    <div class="classementContainer">

        <?php if (!empty($classement)) { ?>
        <?php foreach ($classement as $personne) {
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
        <?php } else { ?>
            <p>Le classement est vide pour le moment.</p>
            <div class="gifContainer">
                <img src="./style/gif/pageVideHomer.gif" width="320" height="240" frameBorder="0" alt="gif de homer"/>
            </div>
        <?php } ?>

    </div>

</section>
    




