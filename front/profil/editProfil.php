<form action="profil.php?action=edit" method="post" id="formProfil" enctype="multipart/form-data">

    <div class="topLeft-form">
        <div class="logoInput">
            <img src="<?php echo $data['src_logo_user']; ?>" class="imgProfil" alt="image profil" id="logo">
            <label>

                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input type="file" name="new_logo" accept="image/*" id="inputLogo" onchange="changeLogo()"/>
            </label>
        </div>

        <div class="inputNom">
            <h2><?php echo $data['login'];?></h2>
        </div>
    </div>

    <div id="center">
        <a href="profil.php?action=changePassword" style="text-decoration: none; padding: 5px; background-color: #9b9b9b; border-radius: 10px; cursor: pointer;">
            changer mot de passe
        </a>
    </div>

    <div class="btn-save">
        <input class="submit" type="submit" value="Save">
    </div>
</form>

