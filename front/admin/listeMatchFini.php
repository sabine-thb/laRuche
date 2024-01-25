
<section class="sectionCard">
    <?php foreach ($match as $row) { 
        $dateMatch = $row['date_match'];

        // Convertir la date au format jj/mm/aaaa
        $dateFormatee = date("d/m/Y", strtotime($dateMatch));?>
        <div class="allCardMatch" >
            <div class="card-body">
                <p class="titleMatch">
                    <?php echo $row['nomCompet']; ?> - <?php echo $dateFormatee; ?> - <?php echo $row['heure']; ?>H
                </p>
                    
                        <!-- Équipe 1 -->
                
                <div class="matchContainer">
                    <div class="equ1">
                        <h5 class="nameEquipe">
                            <?php echo $row['nom1']; ?>
                        </h5>
                        <img src="<?php echo $row['src1']; ?>" class="img-fluid" style="max-height: 250px; width: auto;"
                             alt="image gauche ">

                        <p class=" resultMatch">
                            <?php echo $row['resultat1']; ?>
                        </p>

                    </div>

                        


                    <div class="vs">
                        <p class="fs-4">
                            VS
                        </p>
                    </div>

                    <div class="equ2">
                        <!-- Équipe 2 -->
                        <h5 class="nameEquipe">
                            <?php echo $row['nom2']; ?>
                        </h5>

                        <img src="<?php echo $row['src2']; ?>" class="img-fluid" style="max-height: 250px; width: auto;"
                             alt="image droite">

                        <p class="resultMatch">
                            <?php echo $row['resultat2']; ?>
                        </p>
                    </div>

                </div>

                <div class="stat">
                    <a class="btn btn-info" onclick="return alert('banane');">
                        voir stat
                    </a>
                </div>
            </div>
        </div>
    <?php } ?>
<section>

