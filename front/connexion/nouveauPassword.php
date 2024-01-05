

<form class="formInscription" action="connexion.php?action=changeMDP" method="POST">
    <h2>Entrez un nouveau mot de passe</h2>
    <input type="hidden" value="<?php echo $_SESSION['idUser']; ?>" name="idUser">

    <label for="mdp">Mot de passe :</label>
    <input id="mdp" type="password" name="mdp" minlength="6" autocomplete="new-password"><br>

    <label for="mdp2">Confirmez votre mot de passe :</label>
    <input id="mdp2" type="password" name="mdp2" minlength="6" autocomplete="new-password" onchange=""><br>

    <input class="submit" type="submit" value="Valider">

</form>
