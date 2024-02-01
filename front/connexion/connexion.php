<form action="connexion.php?action=verificationConnexion" method="post" class="formConnexion">

    <label for="login/mail">Pseudo / mail</label>
    <input id="login/mail" type='text' name='login' value="<?php echo $_SESSION['tempLogin'] ?? ''; ?>" required><br>

    <label for="mdp">Mot de passe :</label>
    <input id="mdp" type="password" name="mdp" autocomplete="current-password"
           value="<?php echo $_SESSION['tempPawword'] ?? ''; ?>" required><br>

    <?php echo $_SESSION['error'] ?? null; ?>

    <input type="submit" class="submit" value="Connexion">
</form>

<div class="option">
    Pas de compte ? <a href="connexion.php?action=inscription" class="linkOption"> Inscrivez vous !</a>
</div>