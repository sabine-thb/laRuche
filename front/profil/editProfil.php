<form action="profil.php?action=edit" method="post" id="formProfil" enctype="multipart/form-data">

    <div class="topLeft-form">
        <div class="logoInput">
            <img src="<?php echo $data['src_logo_user']; ?>" class="imgProfil" alt="image profil">
            <label>

                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input type="file" name="new_logo" accept="image/*"/>
            </label>
        </div>

        <div class="inputNom">
            <label for="login"></label>
            <input type='text' name='login' id="login" inputmode="text" value="<?php echo $data['login'];?>">
        </div>
    </div>

    <div class="btn-save">
        <input class="submit" type="submit" value="Save">
    </div>
</form>

