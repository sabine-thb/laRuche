<form class="formInscription" action="connexion.php?action=ajout" method="post">
    <div class="flexContainer1">
        <div class="colInscription">
            <div class="pForm">
                <label for="prenom">Prénom</label>
                <input type='text' name='prenom' id="prenom" inputmode="text"
                       placeholder="Ton prénom" maxlength="24" required>
            </div>

            <div class="pForm">
                <label for="login">Pseudo</label>
                <input type='text' name='login' maxlength="49" id="login" inputmode="text"
                       placeholder="Ton pseudo" required>
            </div>

            <div class="pForm">
                <label for="mail">Adresse mail</label>
                <input id="mail" type='email' name='mail' maxlength="49" inputmode="email"
                       placeholder="exemple@mail.com" required>
            </div>
        </div>

        <div class="colInscription">
            <div class="pForm">
                <label for="description">
                    Description
                    <span class="info" id="btn-info"
                          title="La description est envoyée à l'admin pour qu'il puisse valider votre inscription. Identifiez-vous en une seule phrase (ex: 'Je suis le fils de Donald Trump')"
                          onclick="showTitle(this)"> i </span>
                </label>
                <textarea id="description" name='description' maxlength="499" rows="4"
                          placeholder="En une phrase, qui es-tu ? (l'admin doit pouvoir te reconnaître)"
                          onfocus="ajouteAnimationBouttonInfo()" autocomplete="off" required></textarea>
            </div>

            <div class="pForm">
                <label for="mdp">Mot de passe</label>
                <input id="mdp" type="password" name="mdp" minlength="6" maxlength="25"
                       placeholder="6 caractères minimum" autocomplete="new-password" required>
            </div>
        </div>
    </div>

    <input class="submit" type="submit" value="Créer mon compte" onclick="return afficherErreurInscription();">

    <?php echo $_SESSION['error'] ?? null; ?>

</form>


<div class="option">
    Vous avez déjà un compte ? <a href="connexion.php?action=connexion" class="linkOption">Se connecter</a>
</div>