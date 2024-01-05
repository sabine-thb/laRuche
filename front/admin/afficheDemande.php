
<div class="container mt-5">
    <?php if(!empty($tableau)){ ?>
        <?php foreach ($tableau as $tuple) { ?>
            <div class="card mb-3">
                <div class="card-body">

                    <h5 class="card-title">
                        Login: <?php echo $tuple['login']; ?>
                    </h5>

                    <p class="card-text">
                        Mail: <?php echo $tuple['mail']; ?>
                    </p>

                    <p class="card-text">
                        Description: <?php echo $tuple['description']; ?>
                    </p>

                    <a class="btn btn-primary"
                       href="admin.php?action=valider&id=<?php echo $tuple['user_id']; ?>"
                       onclick="return confirm('Êtes-vous sûr de vouloir valider <?php echo $tuple['login']; ?> ?');"
                    >
                        Valider
                    </a>

                    <a class="btn btn-danger"
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