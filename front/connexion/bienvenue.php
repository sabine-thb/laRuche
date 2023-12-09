<?php if (isset($_SESSION["loginActif"])){ ?>
    <p>
        Bon retour parmi nous <? $_SESSION["loginActif"] ?> ! 
    </p>
    
<?php }else{ ?>
    <p class="bienvenue">
        Bienvenue !
    </p>

<?php } ?>

<div>
    <button type="button" class="bouton">
        <a href="connexion.php?action=connexion" class="nav-link px-2"> 
            Se connecter
        </a>
    </button>

    <button type="button" class="bouton">
        <a href="connexion.php?action=inscription" class="nav-link px-2">
            S'inscrire
        </a>
    </button>

</div>
