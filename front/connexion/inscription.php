<div class = "container d-flex justify-content-center" >
    <form class="form-inline align-items-center justify-content-center justify-content-md-between" action="connexion.php?action=ajout" method="post">
        login: 
            <input class='form-control mr-sm-2' type='text' name='login' placeholder='nom utilisateur unique'><br>
        mail: 
            <input class='form-control mr-sm-2' type='text' name='mail' placeholder='mail'><br>
        mot de passe: 
            <input class="form-control mr-sm-2" type="password" name="mdp" placeholder="mot de passe"><br>
        <input class="btn btn-outline-success my-2 my-sm-0" type="submit" value="Créer compte">
        
        <?php if (isset($_SESSION['error'])){
            echo $_SESSION['error']; //message d'erreur si l'utilisateur a fait une erreur dans le formulaire
        } ?>
    
    </form>
</div>