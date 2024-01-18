<section class="creerCompet">
    <h1 class="titlePage">Créer un pari special</h1>
    <form action="#" method="post" class="formCompet">
        <p class="nomCompet">
            <label for="nom" class="labelCompet">Nom du pari : </label>
            <input class='' type='text' name='name' id="nom">
        </p>

        <p>
            <label for="selectCompet" class="labelCompet">competition :</label>
                <select name="compet" id="selectCompet">
                    <nom>Compétition</nom>
                    <?php foreach($comp as $row){
                        echo '<option value="' .$row['competition_id'].'">' .$row['nom'].'</option>';
                    }?>
                </select>
        </p>

        <p class="descrCompet">
            <label for="descr" class="labelCompet">Objectif du pari : </label>
            <textarea class="areaDescr" name="description" id="descr"></textarea>
        </p>

        <p>
            <label for="nbPoint" class="labelCompet">Point bonne reponse : </label>
            <input type="number" inputmode="numeric" min="0" name="points" id="nbPoint">
        </p>

        <input class="creer" type="submit" value="créer">
    </form>
</section>