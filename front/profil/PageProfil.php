<link rel="stylesheet" href="./style/css/PageProfil.css">
<!--<form action="profil.php?action=edit" method="post" id="formProfil" enctype="multipart/form-data">-->
<div id="content">
    <div class="topLeft-form">
        <div class="logoInput">
            <img src="<?php echo $data['src_logo_user']; ?>" class="imgProfil" alt="image profil" id="logo">
<!--            <label>

                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input type="file" name="new_logo" accept="image/*" id="inputLogo" onchange="changeLogo()"/>
            </label>-->
        </div>

        <div class="inputNom">
            <h2><?php echo $data['login'];?></h2>
        </div>
    </div>

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
<!--    <div class="btn-save">
        <input class="submit" type="submit" value="Save">
    </div>
</form>-->

