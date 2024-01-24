<link rel="stylesheet" href="./style/css/PageProfil.css">
<section>
    <a href="competition.php?action=classement&id=<?php echo $_GET['id']; ?>" class="retourClass">Retour au classement</a>
</section>
<section class="viewProfil">
    <div class="flexContainerProfil">
            <div class="inputNom">
                <h2 class="quiEst">Mais qui est <span class="profilUserName"><?php echo $data['login'];?></span> ?</h2>
            </div>



             <p class="descrOtherUser">
                <span class="labelEquipe">Description : </span>
                <span><?php echo $data['description']; ?></span>
            </p>
        

        <p><span class="labelEquipe">Âge : </span><?php echo $data['age']; ?> </p>

        <p ><span class="labelEquipe">Genre : </span><?php echo $data["Gender"]; ?>

        <div id="competActive">
            <h4> Compétitions actives :</h4>
            <?php foreach ($competActive as $tuple) { ?>
                <div class="one-compet labelequipe" style="display: flex;text-align: center"> <!--attention 'oneCompet' est deja utilisé dans un css-->
                        <h2 class="nameCompet">
                            <?php echo $tuple['nom']; ?>
                        </h2>
                        <p class="classementCompet"> - <?php echo $tuple['classement']; ?>ème</p>
                    </div>
            <?php } ?>
        </div>
    </div>



</section>
