<div class = "" >
    <form class="formInscription" action="connexion.php?action=ajout" method="post">
        <label for="login">Login :</label> 
        <input type='text' name='login' id="login"><br>
        <label for="mail">Mail :</label> 
            <input id="mail" type='text' name='mail'><br>
        <label for="mdp">Mot de passe :</label> 
            <input id="mdp" type="password" name="mdp"><br>
        <input class="submit" type="submit" value="Créer compte">
        
        <?php if (isset($_SESSION['error'])){
            echo $_SESSION['error']; //message d'erreur si l'utilisateur a fait une erreur dans le formulaire
        } ?>
    
    </form>
</div>

<div class="option">
    Vous avez déjà un compte? <a href="connexion.php?action=connexion" class="linkOption"> Se connecter</a>
</div>