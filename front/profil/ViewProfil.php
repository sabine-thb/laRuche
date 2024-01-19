<link rel="stylesheet" href="./style/css/PageProfil.css">
<div id="content">
    <div class="topLeft-form">
        <div class="logoInput">
            <img src="<?php echo $data['src_logo_user']; ?>" class="imgProfil" alt="image profil" id="logo">
        </div>

        <div class="inputNom">
            <h2><?php echo $data['login'];?></h2>
        </div>
    </div>

    <div id="description">
        <p>
            <?php echo $data['description']; ?>
        </p>
    </div>

    <p>Age : <?php echo $data['age']; ?> </p>

    <p>Genre : <?php echo $data["Gender"]; ?>

    <div id="competActive">
        <h4> Compétition Active :</h4>
        <?php foreach ($competActive as $tuple) { ?>
            <div class="oneCompet">
                <h2>
                    <?php echo $tuple['nom']; ?>
                </h2>
                <p> - <?php echo $tuple['classement']; ?> e</p>
            </div>
        <?php } ?>
    </div>
</div>

