<section>
    <h1 class="titlePage">Entrez un nouveau mot de passe :</h1>
    <div class="flexContainer">
        <form action="connexion.php?action=changeMDP" method="POST" class="formEquipe">
            <p class="pForm">
                <input type="hidden" value="<?php echo $_SESSION['idUser']; ?>" name="idUser">
                <input type="hidden" value="<?php echo $nextPage; ?>" name="nextPage">

            </p>
            <p class="pForm">
                <label for="mdp" class="labelEquipe">Nouveau mot de passe :</label>
                <input id="mdp" type="password" name="mdp" minlength="6" autocomplete="new-password"></p>
            <p class="pForm">
                <label for="mdp2" class="labelEquipe">Confirmez votre mot de passe :</label>
                <input id="mdp2" type="password" name="mdp2" minlength="6" autocomplete="new-password" onchange="">
            </p>
            


            <input class="creerEquipe" type="submit" value="Valider" class="submit">

        </form>

    </div>
    


</section>
