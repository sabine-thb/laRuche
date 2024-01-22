
<section>
    <?php if(!empty($tableau)){ ?>
        <p class="titleCompet">
            Voici les compétitions disponibles :
        </p>
        <div class="allCompet">
            <?php foreach ($tableau as $tuple) { 
                    $timestamp = strtotime($tuple["date_creation"]);
                    $date_formattee = date("d/m/Y", $timestamp);?>
                    
                    <div class="oneCompet">

                        <p class="competTitle">
                                <?php echo $tuple["nom"] . '  -  ' . $date_formattee ?>
                        </p>
                            <p>
                                <?php echo $tuple["description"]; ?>
                            </p>

                            <a href="scoruche.php?action=rejoindreCompetition&idCompet=<?php echo $tuple['competition_id']; ?> " class="rejoindre">
                                Rejoindre
                            </a>

                    </div>

                <?php } ?>

        </div>
            
    <?php }else{ ?>
        <p>Il n'y a aucune compétition disponible pour le moment.</p>
        <div class="gifContainer">
           <img src="./style/gif/pageVideHomer.gif" width="320" height="240" frameBorder="0" alt="gif de homer"/>

        </div>
        
    <?php } ?>
</section>