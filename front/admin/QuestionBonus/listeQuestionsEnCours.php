<section class="allQuestions">
    <?php foreach ($questions as $oneQuestion) { ?>

    <div class="oneQuestion">

        <h2>
            <span class="nomCompet"><?php echo $oneQuestion['nom']; ?> </span>- <?php echo $oneQuestion['titre']; ?>
        </h2>

        <div class="descrBonus">
            <p  class="pBonus">
                <span class="labelEquipe">Objectif :</span> 
                <span><?php echo $oneQuestion['objectif']; ?></span>
            </p>

            <p  class="pBonus">
                <span class="labelEquipe">Type de réponse :</span> 
                <span><?php echo $oneQuestion['type']; ?></span>
            </p>

            <p class="pBonus">
                <span class="labelEquipe">Bonne réponse = </span> 
                <span><?php echo $oneQuestion['point_bonne_reponse']; ?>pts<span>
            </p>

        </div>

        <div class="twoButtons">

            <a class="btn" style="text-decoration: none;"
            href="admin.php?action=miseEnAttenteQuestion&idQuestion=<?php echo $oneQuestion['question_bonus_id']; ?>"
            onclick="return confirm('est-tu sur de vouloir mettre en attente cette question ?\nIl n\'y a pas de retour arrière possible pour l\'instant');">
                Fermer les paris
            </a>

            <a class="btn" style="text-decoration: none;"
            onclick="return confirm('est-tu sur de vouloir supprimez ce match ?\n');">
                Supprimer
            </a>

        </div>

        

        
    </div>

<?php } ?>


</section>
