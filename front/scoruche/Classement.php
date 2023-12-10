<h3>
    classement général
</h3><br>

<? 
    $numero = 1;
    foreach ($classement as $personne) {
?>

    <div>
        <p class="numero">
            <? echo $numero; ?>
        </p>

        <!-- a faire plus tard : image du profile ici  -->

        <h2>
            <? echo $personne["login"]; ?>
        </h2>

        <p class ="point">
            <? echo $personne["points"]; ?>
        </p>
    </div>

<? 
    $numero++;
    }
?>
