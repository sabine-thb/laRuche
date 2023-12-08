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
                <a href="admin.php?action=valider&id='<?php echo $tuple['user_id']; ?>'" class="btn btn-primary">
                    Valider
                </a>
                <a href="admin.php?action=refuser&id='<?php echo $tuple['user_id']; ?>'" class="btn btn-primary">
                    Refuser
                </a>
            </div>
        </div>
    <?php } ?> <!--et là -->
</div>