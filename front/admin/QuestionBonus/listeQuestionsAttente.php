<?php foreach ($questions as $oneQuestion) { ?>

    <div class="oneQuestion">

        <h2>
            <?php echo $oneQuestion['nom']; ?> - <?php echo $oneQuestion['titre']; ?>
        </h2>

        <p>
            <?php echo $oneQuestion['objectif']; ?>
        </p>

        <p>
            <?php echo $oneQuestion['type']; ?>
        </p>

        <p>
            Bonne reponse = <?php echo $oneQuestion['point_bonne_reponse']; ?>pts
        </p>

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

<?php } ?>