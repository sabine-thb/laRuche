<div class = "container d-flex justify-content-center" >

        <form action="admin.php?action=ajoutEquipe" method="post"  enctype="multipart/form-data" class="align-items-center justify-content-center justify-content-md-between">
                
                <label>Nom de la Team: </label>
                <input class='form-control mr-sm-2' type='text' name='name'><br>

                <label>Logo: </label>   
                <input type="file" name="logo" accept=".jpg,.png,.webp,.svg">

        
                <input type="hidden" name="token" value="<?php echo $token; ?>">

                <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="créer">
        </form>
</div>