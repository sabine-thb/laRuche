<section class="creerCompet">
    <h1 class="titlePage">Créer une question Bonus</h1>
    <form action="admin.php?action=ajouteQuestionBonus" method="post" class="formCompet">
        <p class="nomCompet">
            <label for="nom" class="labelCompet">Titre de la question : </label>
            <input class='' type='text' name='name' id="nom" required>
        </p>

        <p>
            <label for="selectCompet" class="labelCompet">competition :</label>
                <select name="compet" id="selectCompet" required>
                    <nom>Compétition</nom>
                    <?php foreach($comp as $row){
                        echo '<option value="' .$row['competition_id'].'">' .$row['nom'].'</option>';
                    }?>
                </select>
        </p>

        <p class="descrCompet">
            <label for="descr" class="labelCompet">Objectif : </label>
            <textarea class="areaDescr" name="description" id="descr"></textarea>
        </p>

        <label for="typeResultat" class="labelCompet">Type resultat :</label>
        <select name="typeResultat" id="typeResultat" required>
            <option value="nombre">nombre</option>
            <option value="string">nom joueur</option>
            <option value="equipe">equipe</option>
            <option value="bool">reponse fermé (oui/non)</option>
        </select>

        <p>
            <label for="nbPoint" class="labelCompet">Point bonne reponse : </label>
            <input type="number" inputmode="numeric" min="0" name="points" id="nbPoint" required>
        </p>

        <input class="creer" type="submit" value="créer">
    </form>
</section>