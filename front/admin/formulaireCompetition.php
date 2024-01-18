<section class="creerCompet">
    <h1 class="titlePage">Créer une nouvelle compétition</h1>
    <form action="admin.php?action=ajoutCompetition" method="post" class="formCompet">
        <p class="nomCompet">
            <label for="nom" class="labelCompet">Nom de la compétition : </label>
            <input class='' type='text' name='name' id="nom">

        </p>
        
        <p class="descrCompet">
            <label for="descr" class="labelCompet">Courte description : </label>
            <textarea class="areaDescr" name="description" id="descr"></textarea>

        </p>
        

        <p>
            <?php echo $erreur; ?>
        </p>

        <input class="creer" type="submit" value="créer">
    </form>
</section>