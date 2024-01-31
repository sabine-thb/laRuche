<script src="./style/js/question/questionForm.js"></script>
<section>
    <h1 class="titlePage">Voici les questions bonus actuelles : </h1>
    <div class="allQuestions">
        <?php foreach ($questions as $oneQuestion) { ?>

        <div class="oneQuestion"> <!--la class 'oneQuestion' est utilisé par le js-->
            <form action="competition.php?action=validationQuestionBonus&id=<?php echo $_GET['id']; ?>" method="post">
                <input type="hidden" name="idQuestion" value="<?php echo $oneQuestion['question_bonus_id']; ?>">

                <h2>
                    <?php echo $oneQuestion['titre']; ?>
                </h2>

                <p>
                    <?php echo $oneQuestion['objectif']; ?>
                </p>

                <p class="quest">
                    <label for="reponse" class="labelEquipe">Votre réponse :</label>
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
                            echo    "<option value='$oneQuestion[reponse]'>$oneQuestion[reponse]</option>";
                            foreach ($equipes as $e)
                                echo    "<option value='$e[nom]'>$e[nom]</option>";
                            echo "</select>";
                            break;
                        case 'bool':
                            echo "<select name='reponse' class='input' required>";
                            echo    "<option value='$oneQuestion[reponse]'>$oneQuestion[reponse]</option>";
                            echo    "<option value='oui'>oui</option>";
                            echo    "<option value='non'>non</option>";
                            echo "</select>";
                            break;

                    } ?>
                
                </p>
                
                <p>
                    <span class="labelEquipe">Bonne réponse : </span> <?php echo $oneQuestion['point_bonne_reponse']; ?>
                    pts
                </p>

                <input type="submit" name="submit" class="envoyerForm submit" value="Enregistrer">
            </form>
        </div>

        <?php } ?>
    </div>
    <div class="bonusContainer">
        <a href="competition.php?action=questionsBonus&id=<?php echo $_GET['id']; ?>&type=fini" class="lienBonus">
                Voir les bonus terminés
        </a>
    </div>
    
</section>
