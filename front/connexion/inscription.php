
<form class="formInscription" action="connexion.php?action=ajout" method="post">
    <div class="flexContainer1">
        <div>
            <p class="pForm">
                <label for="prenom">Prénom :</label>
<<<<<<< HEAD
                <input type='text' name='prenom' id="prenom" inputmode="text" maxlength="24">
=======
                <input type='text' name='prenom' id="prenom" inputmode="text" maxlength="24" required>
>>>>>>> Prod
            </p>

            <p class="pForm">
                <label for="login">Pseudo :</label>
                <input type='text' name='login' maxlength="49" id="login" inputmode="text" required>
            </p>
        
            <p class="pForm">
                <label for="mail">Mail :</label>
                <input id="mail" type='email' name='mail' maxlength="49" inputmode="email" required>

            </p>
        

        </div>
        <div>
            <p class="pForm">
                <label for="description" class="description"> Description : <span class="info" id="btn-info" title="La description est envoyée à l'admin pour qu'il puisse valider votre inscription. Identifiez-vous en une seule phrase (ex: 'Je suis le fils de Donald Trump')" onclick="showTitle(this)"> i </span>  </label>
<<<<<<< HEAD
                <input id="description" type='text' name='description' onfocus="ajouteAnimationBouttonInfo()" autocomplete="off">
=======
                <input id="description" type='text' name='description' maxlength="499"
                       onfocus="ajouteAnimationBouttonInfo()" autocomplete="off" required>
>>>>>>> Prod
            </p>
            <p class="pForm">
                <label for="mdp">Mot de passe :</label>
                <input id="mdp" type="password" name="mdp" minlength="6" maxlength="25" autocomplete="new-password"
                       required>
            
            </p>
        </div>

    </div>
    
        
    <input class="submit" type="submit" value="Créer compte" onclick="return afficherErreurInscription();">

<<<<<<< HEAD
    <?php echo $_SESSION['error'] ?? null ; ?>
=======
    <?php echo $_SESSION['error'] ?? null; ?>
>>>>>>> Prod

</form>


<div class="option">
    Vous avez déjà un compte ? <a href="connexion.php?action=connexion" class="linkOption">Se connecter</a>
</div>