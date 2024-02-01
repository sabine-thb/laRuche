<section class="creaEquipe">
    <h1 class="titlePage">Je créé une nouvelle équipe : </h1>
    <form action="admin.php?action=ajoutEquipe" method="post"
          enctype="multipart/form-data" class="formEquipe">
        <p class="p equipe">
            <label for="nomEquipe" class="labelEquipe">Nom de la Team : </label>
            <input class='form-control mr-sm-2' type='text' name='name' id="nomEquipe" required/>
        </p>
        <p class="p equipe">
            <label for="logo" class="labelEquipe">Logo (max 2 Mo) :</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="2000000" id="logo">
            <input type="file" name="logo" accept="image/*" required/>

        </p>

        <input type="hidden" name="token" value="<?php echo $token; ?>"/>

        <input class="creerEquipe" type="submit" value="créer"/>
    </form>
</section>