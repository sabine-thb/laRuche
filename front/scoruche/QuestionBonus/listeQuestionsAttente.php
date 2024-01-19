<script src="./style/js/question/questionForm.js"></script>
<?php foreach ($questions as $oneQuestion) { ?>

    <div class="oneQuestion"> <!--la class 'oneQuestion' est utilisé par le js-->
        <form action="#" method="post">
            <input type="hidden" name="idQuestion" value="<?php echo $oneQuestion['question_bonus_id']; ?>">

            <h2>
                <?php echo $oneQuestion['titre']; ?>
            </h2>

            <p>
                <?php echo $oneQuestion['objectif']; ?>
            </p>

            <label>Votre reponse :
            <?php //input dynamique en fonction du type de la reponse de la question choisie par l'admin
            switch ($oneQuestion['type']){
                //les classes 'input' sont utilisé par le js
                case 'nombre':
                    echo "<input type='number' name='reponse' class='input' value='$oneQuestion[reponse]' required>";
                    break;
                case 'string':
                    echo "<input type='text' name='reponse' class='input' value='$oneQuestion[reponse]' required>";
                    break;
                case 'equipe':
                    echo "<select name='reponse' class='input' required>";
                    echo    "<option value=''></option>";
                    foreach ($equipes as $e)
                        echo    "<option value='$e[equipe_id]'>$e[nom]</option>";
                    echo "</select>";
                    break;
                case 'bool':
                    echo "<select name='reponse' class='input' required>";
                    echo    "<option value=''></option>";
                    echo    "<option value='oui'>oui</option>";
                    echo    "<option value='non'>non</option>";
                    echo "</select>";
                    break;

            } ?>
            </label>
            <p>
                Bonne reponse = <?php echo $oneQuestion['point_bonne_reponse']; ?>pts
            </p>

            <input type="submit" name="submit" class="submit" value="enregistrer" style="display: none;">
        </form>
    </div>

<?php } ?>