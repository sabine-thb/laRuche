<div class = "container d-flex justify-content-center" >
    <form action="admin.php?action=ajoutCompetition" method="post" class="align-items-center justify-content-center justify-content-md-between">
        
        <label>
            nom de la competition :
            <input class='form-control mr-sm-2' type='text' name='name'>
        </label>

        <label>
            Courte description :
            <textarea class="form-control mr-sm-2" name="description" rows="4" cols="50"></textarea>
        </label>

        <p>
            <?php echo $erreur; ?>
        </p>

        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="créer">
    </form>
</div>