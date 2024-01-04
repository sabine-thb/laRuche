<form action="admin.php?action=modifieEquipe" method="post"
      enctype="multipart/form-data">

    <label>
        Nom de la Team:
        <input type='text' name='name' value="<?php echo $equipe['nom']; ?>" required/>
    </label><br>

    <img src="<?php echo $equipe['srcLogo']; ?>" alt="logo de l'equipe">

    <label>
        Logo (max 2 Mo):
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
        <input type="file" name="logo" accept="image/*"/>
    </label>


    <input type="hidden" name="idEquipe" value="<?php echo $equipe['equipe_id']; ?>"/>
    <input type="submit" value="modifier"/>
</form>