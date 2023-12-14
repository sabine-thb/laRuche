<form action="admin.php?action=ajoutMatch" method="post" class="align-items-center justify-content-center justify-content-md-between">
    

    <input type="select">
         <nom>Equipe 1</nom>

        <?php foreach($eq as $row){
            echo  '<option valeur="' .$row['nom'].'">' .$row['nom'].'</option>';
         }?>
    </input>     

    <input type="select">
        <nom>Equipe 2</nom>
        <?php foreach($eq as $row){
            echo  '<option valeur="' .$row['nom'].'">' .$row['nom'].'</option>';
         }?>
        <p>Ps : non, on ne peut pas mettre 2 fois la même equipe..</p>
    </input>


    <input type="hidden" name="token" value="<?php echo $token; ?>">
    <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="créer">
</form>