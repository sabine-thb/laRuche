<section class="creaEquipe">
    <h1 class="titlePage">Je créée un match : </h1>
    <form action="admin.php?action=ajoutMatch" method="post" class="formEquipe">

        <p class="pMatch">
            <label for="equipe1" class="labelEquipe">Équipe 1 :</label>
            <select name="equipe1" id="equipe1">
                <option value="default">...</option>
                <?php foreach ($eq as $row) {
                    echo '<option value="' . $row['equipe_id'] . '">' . $row['nom'] . '</option>';
                } ?>
            </select>
        </p>
        <p class="pMatch">
            <label for="equipe2" class="labelEquipe">Équipe 2 :</label>
            <select name="equipe2" id="equipe2">
                <option value="default">...</option>
                <?php foreach ($eq as $row) {
                    echo '<option value="' . $row['equipe_id'] . '">' . $row['nom'] . '</option>';
                } ?>
            </select>
        </p>
        <p class="pMatch">
            <label for="compet" class="labelEquipe">Compétition :</label>
            <select name="compet" id="compet">
                <nom>Compétition</nom>
                <option value="default">...</option>
                <?php foreach ($comp as $row) {
                    echo '<option value="' . $row['competition_id'] . '">' . $row['nom'] . '</option>';
                } ?>
            </select>
        </p>
        <p class="pMatch">
            <label for="date" class="labelEquipe">Date du Match :</label>
            <input type="date" name="dateMatch" id="date">

        </p>
        <p class="pMatch">
            <label for="heure" class="labelEquipe">Heure du Match :</label>
            <input type="number" name="heure" inputmode="numeric" min="1" max="23" id="heure">
        </p>
        <p class="pMatch">
            <label for="pointEx" class="labelEquipe">Points Score Exact :</label>
            <input type="number" name="ptsExact" inputmode="numeric" min="0" id="pointEx">
        </p>
        <p class="pMatch">
            <label for="pointEc" class="labelEquipe">Points Écart De But :</label>
            <input type="number" name="ptsEcart" inputmode="numeric" min="0" id="pointEc">
        </p>
        <p class="pMatch">
            <label for="pointVainc" class="labelEquipe">Points bon vainqueur :</label>
            <input type="number" name="ptsVainq" inputmode="numeric" min="0" id="pointVainc">
        </p>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <input type="submit" value="créer" class="creerEquipe">
    </form>
</section>