<div class = "container" >

    <form action="admin.php?action=ajoutMatch" method="post" class="align-items-center justify-content-center justify-content-md-between ">
        
        <label class="mb-2 mt-4">Equipe 1 :
            <select name="equipe1">

                <nom>Equipe 1</nom>
                <option value="default">...</option>

                <?php foreach($eq as $row){
                    echo  '<option value="' .$row['equipe_id'].'">' .$row['nom'].'</option>';
                }?>
            </select>
        </label><br>


        <label class="mb-2">Equipe 2 :
            <select name="equipe2">
                <nom>Equipe 2</nom>
                <option value="default">...</option>
                <?php foreach($eq as $row){
                    echo  '<option value="' .$row['equipe_id'].'">' .$row['nom'].'</option>';
                }?>
            </select>
            <p>Ps : non, on ne peut pas mettre 2 fois la même equipe..</p>
        </label>

        <br>

        <label class="mb-2">competition :
            <select name="compet">
            <nom>Compétition</nom>
            <option value="default">...</option>
            <?php foreach($comp as $row){
                echo  '<option value="' .$row['competition_id'].'">' .$row['nom'].'</option>';
            }?>
            </select>
        </label><br>


        <label class="mb-2">Date du Match :
            <input type="date" name="dateMatch">
        </label><br>

        <label class="mb-2">Points Score Exact :
            <input type="number" name="ptsExact" maxlength="2" size="1">
        </label><br>

        <label class="mb-2">Points Ecart De But :
            <input type="number" name="ptsEcart" maxlength="2" size="1">
        </label><br>

        <label class="mb-2">Points bon vainqueur :
            <input type="number" name="ptsVainq" maxlength="2" size="1"><br>
        </label><br>

        <input type="hidden" name="token" value="<?php echo $token; ?>">

        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="créer">
    </form>
</div>