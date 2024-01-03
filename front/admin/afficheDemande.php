<!-- readme : il faut juste conserver la boucle for sinon on peut tout modifier -->
<div class="container mt-5">
    <?php foreach ($tableau as $tuple) { ?> <!-- ici-->
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
    <?php } ?> <!--et là -->
</div>