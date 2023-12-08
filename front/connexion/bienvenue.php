<?php if (isset($_SESSION["loginActif"])){ ?>
    <p>
        Bon retour parmi nous <? $_SESSION["loginActif"] ?> ! 
    </p>
    
<?php }else{ ?>
    <p class="bienvenue">
        Bienvenue !
    </p>

<?php } ?>