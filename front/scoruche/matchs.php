<form class="formPronostics" action="" method="post">

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

                <input id="prono1" type="number" name="prono1" placeholder="<? echo $tuple['prono_equipe1']; ?>">

                <p>
                     - 
                </p>

                <input id="prono2" type="number" name="prono2" placeholder="<? echo $tuple['prono_equipe2']; ?>">
                
                <h3>
                    <? echo $tuple['nom2']; ?>
                </h3>

                <img src="<? echo $tuple['src2']; ?>" alt="" style="max-width: 250px; height: auto;">

            </div>
        </div>
    <?php } ?>

</form>
    