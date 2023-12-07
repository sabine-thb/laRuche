<div class = "container d-flex justify-content-center" >
    <form action="admin.php?module=mod_admin&action=ajoutCompetition" method="post" class="align-items-center justify-content-center justify-content-md-between">
        
        <label>
            nom de la competition:
        </label>
        <input class='form-control mr-sm-2' type='text' name='name'><br>

        <label>
            petite description :
        </label>
        <textarea class="form-control mr-sm-2" name="description" rows="4" cols="50"></textarea><br>

        <p>
            <? echo $erreur; ?>
        </p>

        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="créer">
    </form>
</div>