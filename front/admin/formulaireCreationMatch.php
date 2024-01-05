<div>

    <form action="admin.php?action=ajoutMatch" method="post">
        
        <label>Equipe 1 :
            <select name="equipe1">
                <nom>Equipe 1</nom>
                <option value="default">...</option>
                <?php foreach($eq as $row){
                    echo  '<option value="' .$row['equipe_id'].'">' .$row['nom'].'</option>';
                }?>
            </select>
        </label><br>


        <label>Equipe 2 :
            <select name="equipe2">
                <nom>Equipe 2</nom>
                <option value="default">...</option>
                <?php foreach($eq as $row){
                    echo  '<option value="' .$row['equipe_id'].'">' .$row['nom'].'</option>';
                }?>
            </select>
        </label>

        <br>

        <label>competition :
            <select name="compet">
            <nom>Compétition</nom>
            <option value="default">...</option>
            <?php foreach($comp as $row){
                echo  '<option value="' .$row['competition_id'].'">' .$row['nom'].'</option>';
            }?>
            </select>
        </label><br>


        <label>Date du Match :
            <input type="date" name="dateMatch">
        </label><br>

        <label>Heure du Match :
            <input type="number" name="heure" inputmode="numeric" min="1" max="23">
        </label><br>

        <label>Points Score Exact :
            <input type="number" name="ptsExact" inputmode="numeric" min="0">
        </label><br>

        <label>Points Ecart De But :
            <input type="number" name="ptsEcart" inputmode="numeric" min="0">
        </label><br>

        <label>Points bon vainqueur :
            <input type="number" name="ptsVainq" inputmode="numeric" min="0"><br>
        </label><br>

        <input type="hidden" name="token" value="<?php echo $token; ?>">

        <input type="submit" value="créer">
    </form>
</div>