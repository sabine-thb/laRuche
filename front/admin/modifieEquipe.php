<section>
    <form action="admin.php?action=modifieEquipe" method="post"
        enctype="multipart/form-data">

        <label for="nomEquipe">Nom de la Team:</label>
            <input type='text' name='name' id="nomEquipe" value="<?php echo $equipe['nom']; ?>" required/>
        

        <img src="<?php echo $equipe['srcLogo']; ?>" alt="logo de l'equipe">

        <label for="logo">Logo (max 2 Mo):</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" id="logo">
            <input type="file" name="logo" accept="image/*"/>
        


        <input type="hidden" name="idEquipe" value="<?php echo $equipe['equipe_id']; ?>"/>
        <input type="submit" value="modifier"/>
    </form>

</section>
