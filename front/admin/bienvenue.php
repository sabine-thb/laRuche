<section>
    <h1 class="titlePage">
        Bon retour parmi nous cher <?php echo $_SESSION["loginActif"]; ?>, vous êtes sur votre page d'accueil !
    </h1>
    <p>Choisissez ci-dessous les actions que vous souhaitez effectuer.</p>
    <div class="actionsContainer">
        <div class="actions">
        <a href="admin.php?action=afficherDemande" class="linkAction">
                        <div class="oneAction">Demandes de compte</div>
        </a>
        <a href="admin.php?action=gererComptes" class="linkAction">
                        <div class="oneAction">Gérer les comptes</div>
        </a>
        <a href="admin.php?action=afficheFormCompetition" class="linkAction">
                        <div class="oneAction">Créer une compétition</div>
        </a>
        <a href="admin.php?action=gererCompetition" class="linkAction">
                        <div class="oneAction">Gérer une compétition</div>
        </a>
        <a href="admin.php?action=afficheFormEquipe" class="linkAction">
                        <div class="oneAction">Créer une équipe</div>
        </a>
        <a href="admin.php?action=gererEquipe" class="linkAction">
                        <div class="oneAction">Gérer une équipe</div>
        </a>
        <a href="admin.php?action=afficheFormMatch" class="linkAction">
                        <div class="oneAction">Créer un match</div>
        </a>
        <a href="admin.php?action=gererMatch" class="linkAction">
                        <div class="oneAction">Gérer un match</div>
        </a>
        <a href="admin.php?action=ajouterQuestionBonus" class="linkAction">
            <div class="oneAction">Ajouter une question bonus</div>
        </a>
        <a href="admin.php?action=gererQuestionBonus" class="linkAction">
            <div class="oneAction">Gérer les questions bonus</div>
        </a>
        
    </div>

    </div>
   

</section>
