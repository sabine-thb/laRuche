<form class="formPronostics" action="competition.php?action=validationProno&id=<? echo $_GET['id']; ?>" method="post">

    <div>
        <h2>Pronostics</h2>

        <input class="submit" type="submit" value="Enregistrer">
    </div>

    
    <?php foreach ($matchs as $tuple) { ?>
        <div>
            <p>
                <? echo $tuple['date_max_pari']; ?>
            </p>

            <div style="display:flex;">

                <img src="<? echo $tuple['src1']; ?>" alt="" style="max-width: 250px; height: auto;">

                <h3>
                    <? echo $tuple['nom1']; ?>
                </h3>

                <input class="prono" type="number" name="prono1_match<? echo $tuple['match_id']; ?>" placeholder="<? echo $tuple['prono_equipe1']; ?>">

                <p>
                     - 
                </p>

                <input class="prono" type="number" name="prono2_match<? echo $tuple['match_id']; ?>" placeholder="<? echo $tuple['prono_equipe2']; ?>">
                
                <h3>
                    <? echo $tuple['nom2']; ?>
                </h3>

                <img src="<? echo $tuple['src2']; ?>" alt="" style="max-width: 250px; height: auto;">

            </div>
        </div>
    <?php } ?>

</form>
    