<section class="secDmd">
    <h1 class="titlePage">Demandes de compte : </h1>
    <div class="dmdContainer">
        <?php if(!empty($tableau)){ ?>
            <?php foreach ($tableau as $tuple) { ?>
                    <div class="oneDemande">

                        <p class=" p login">
                            <span class="underline">Login :</span> <?php echo $tuple['login']; ?>
                        </p>

                        <p class="p mail">
                            <span class="underline">Mail :</span> <?php echo $tuple['mail']; ?>
                        </p>

                        <p class="p descr">
                            <span class="underline">Description :</span> <?php echo $tuple['description']; ?>
                        </p>

                        <div class="choice">
                            <a class="p valid"
                            href="admin.php?action=valider&id=<?php echo $tuple['user_id']; ?>"
                            onclick="return confirm('Êtes-vous sûr de vouloir valider <?php echo $tuple['login']; ?> ?');"
                            >
                                Valider
                            </a>

                            <a class="p refuse"
                            href="admin.php?action=refuser&id=<?php echo $tuple['user_id']; ?>"
                            onclick="return confirm('Êtes-vous sûr de vouloir refusez <?php echo $tuple['login']; ?> ?');"
                            >
                                Refuser
                            </a>

                        </div>
                        

                    </div>
            <?php } ?>
        <?php }else{ ?>
            <p>Il n'y a aucune demande de compte pour le moment </p>
            <img src="./style/gif/pageVideHomer.gif" width="320" height="240" frameBorder="0" alt="gif de homer"/>
        <?php } ?>
    </div>

</section>
