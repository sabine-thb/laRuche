
<?php foreach ($questions as $oneQuestion) { ?>

    <div>
        <form action="#" method="post">
            <input type="hidden" name="idQuestion" value="<?php echo $oneQuestion['question_bonus_id']; ?>">

            <h2>
                <?php echo $oneQuestion['titre']; ?>
            </h2>

            <p>
                <?php echo $oneQuestion['objectif']; ?>
            </p>

            <label for="reponse">Votre reponse :</label>
            <?php //input dynamique en fonction du type de la reponse de la question choisie par l'admin
            switch ($oneQuestion['type']){
                case 'nombre':
                    echo "<input type='number' name='reponse' value='$oneQuestion[reponse]' required>";
                    break;
                case 'string':
                    echo "<input type='text' name='reponse' value='$oneQuestion[reponse]' required>";
                    break;
                case 'equipe':
                    //todo select equipe de la compet
                    break;
                case 'bool':
                    echo "<select name='reponse' id='reponse' required>";
                    echo    "<option value='oui'>oui</option>";
                    echo    "<option value='non'>non</option>";
                    echo "</select>";
                    break;

            } ?>

            <p>
                Bonne reponse = <?php echo $oneQuestion['point_bonne_reponse']; ?>pts
            </p>
    </div>

<?php } ?>