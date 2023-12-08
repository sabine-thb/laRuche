<!-- readme : il faut juste conserver la boucle for sinon on peut tout modifier -->
<div class="container mt-5">
    <? foreach ($tableau as $tuple) { ?> <!-- ici-->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">
                    Login: <? echo $tuple["login"]; ?> 
                </h5>
                <p class="card-text">
                    Mail: <? echo $tuple["mail"]; ?> 
                </p>
                <a href="admin.php?action=valider&id='<? echo $tuple['user_id']; ?>'" class="btn btn-primary">
                    Valider
                </a>
            </div>
        </div>
    <? } ?> <!--et là -->
</div>