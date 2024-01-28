
<form class="formInscription" action="connexion.php?action=ajout" method="post">
    <div class="flexContainer1">
        <div>
            <p class="pForm">
                <label for="prenom">Prénom :</label>
                <input type='text' name='prenom' id="prenom" inputmode="text" maxlength="24">
            </p>

            <p class="pForm">
                <label for="login">Pseudo :</label>
                <input type='text' name='login' id="login" inputmode="text">
            </p>
        
            <p class="pForm">
                <label for="mail">Mail :</label>
                <input id="mail" type='email' name='mail' inputmode="email">

            </p>
        

        </div>
        <div>
            <p class="pForm">
                <label for="description" class="description"> Description : <span class="info" id="btn-info" title="La description est envoyée à l'admin pour qu'il puisse valider votre inscription. Identifiez-vous en une seule phrase (ex: 'Je suis le fils de Donald Trump')" onclick="showTitle(this)"> i </span>  </label>
                <input id="description" type='text' name='description' onfocus="ajouteAnimationBouttonInfo()" autocomplete="off">
            </p>
            <p class="pForm">
                <label for="mdp">Mot de passe :</label>
                <input id="mdp" type="password" name="mdp" minlength="6" autocomplete="new-password">
            
            </p>
        </div>

    </div>
    
        
    <input class="submit" type="submit" value="Créer compte" onclick="return afficherErreurInscription();">

    <?php echo $_SESSION['error'] ?? null; ?>

</form>


<div class="option">
    Vous avez déjà un compte ? <a href="connexion.php?action=connexion" class="linkOption">Se connecter</a>
</div>