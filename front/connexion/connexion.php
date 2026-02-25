<form action="connexion.php?action=verificationConnexion" method="post" class="formConnexion">

    <div class="pForm">
        <label for="login-mail">Pseudo / mail</label>
        <input id="login-mail" type='text' name='login' placeholder="Ton pseudo ou ton adresse mail"
               value="<?php echo htmlspecialchars($_SESSION['tempLogin'] ?? ''); ?>" required>
    </div>

    <div class="pForm">
        <label for="mdp">Mot de passe</label>
        <input id="mdp" type="password" name="mdp" placeholder="••••••••"
               autocomplete="current-password"
               value="<?php echo htmlspecialchars($_SESSION['tempPawword'] ?? ''); ?>" required>
    </div>

    <?php echo $_SESSION['error'] ?? null; ?>

    <input type="submit" class="submit" value="Connexion">
</form>

<div class="option">
    Pas de compte ? <a href="connexion.php?action=inscription" class="linkOption"> Inscrivez vous !</a>
</div>