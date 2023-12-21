<div class = "container d-flex justify-content-center" >

    <form action="admin.php?action=ajoutMatch" method="post" class="align-items-center justify-content-center justify-content-md-between ">
        
        <label>Equipe 1 :</label>
        <select name="equipe1">

            <nom>Equipe 1</nom>
            <option value="default">...</option>

            <?php foreach($eq as $row){
                echo  '<option value="' .$row['equipe_id'].'">' .$row['nom'].'</option>';
            }?>
        </select>     


        <label>Equipe 2 :</label>
        <select name="equipe2">
            <nom>Equipe 2</nom>
            <option value="default">...</option>
            <?php foreach($eq as $row){
                echo  '<option value="' .$row['equipe_id'].'">' .$row['nom'].'</option>';
            }?>
        </select>
            <p>Ps : non, on ne peut pas mettre 2 fois la même equipe..</p>


            <select name="compet">
            <nom>Compétition</nom>
            <option value="default">...</option>
            <?php foreach($comp as $row){
                echo  '<option value="' .$row['competition_id'].'">' .$row['nom'].'</option>';
            }?>
        </select>


        <label >Date du Match ( les paris seront fermés le jour d'avant à 00:00) :</label>
        <input type="date" name="dateMatch">

        <label>Points Score Exact :</label>
        <input type="text" name="ptsExact" maxlength="2" size="1">        

        <label>Points Ecart De But :</label>
        <input type="text" name="ptsEcart" maxlength="2" size="1">        

        <label>Points bon vainqueur :</label>
        <input type="text" name="ptsVainq" maxlength="2" size="1"><br>



        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="créer">
    </form>
</div>