<?php if (isset($_SESSION["loginActif"])){ ?>
    <p>
        Bon retour parmi nous <? $_SESSION["loginActif"] ?> ! 
    </p>
    
<?php }else{ ?>
    <p>
        bienvenue sur le site de la ruche !<br>
        veuillez vous connectez ou créez un compte pour continuer
    </p>
        
<? } ?>