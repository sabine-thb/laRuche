<div >

        <form action="admin.php?action=ajoutEquipe" method="post"
              enctype="multipart/form-data" class="align-items-center justify-content-center justify-content-md-between">
                
            <label>
                Nom de la Team:
                <input class='form-control mr-sm-2' type='text' name='name' required/>
            </label><br>

            <label>
                Logo (max 2 Mo):
                <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                <input type="file" name="logo" accept="image/*"/>
            </label>


            <input type="hidden" name="token" value="<?php echo $token; ?>"/>

            <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="créer"/>
        </form>
</div>