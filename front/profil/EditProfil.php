<script src="./style/js/profil/editLogo.js"></script>
<link rel="stylesheet" href="./style/css/PageProfil.css">
<section id="secProf">
    <h1 class="titlePage">Mes infos de profil :  </h1>
    <div class="flexContainer">
        <form action="<?php echo $newURL; ?>" method="post" id="formProfil" enctype="multipart/form-data">
            <div class="infosPers">
                <p>
                    <span class="label">Mon Prenom :</span> <?php echo $data['prenom'];?>
                </p>
                <p>
                        <span class="label">Mon Pseudo :</span> <?php echo $data['login'];?>
                </p>
                
                <p>
                        <span class="label">Ma description :</span> <?php echo $data['description']; ?>
                </p>

                <div id="input-age-genre">
                    <p >
                        <label for="inputAge" class="label">Mon âge :</label>
                    <input type="number" name="age" id="inputAge" min="1" max="99" inputmode="numeric"
                        value="<?php echo $data['age']; ?>" oninput="afficheBtnSave()">

                    </p>
                    <p class="pForm">
                        <label for="gender" class="label">Mon genre :</label>
                        <select name="gender" id="gender" onchange="afficheBtnSave()">
                            <option value="<?php echo $data["optionGender"]; ?>"><?php echo $data["optionGender"]; ?></option>
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                            <option value="autre">autre</option>
                            <option value="default">Je préfère ne pas dire</option>
                            <option value="croissant">I'm a croissant</option>
                        </select>

                    </p>
                </div>

            </div>

            

            <div id="competActive">
                <p class="label"> Mes compétitions actives :</p>
                <?php foreach ($competActive as $tuple) { ?>
                    <div class="one-compet labelequipe" style="display: flex;text-align: center"> <!--attention 'oneCompet' est deja utilisé dans un css-->
                        <h2 class="nameCompet">
                            <?php echo $tuple['nom']; ?>
                        </h2>
                        <p class="classementCompet"><?php echo $tuple['classement']; ?>ème</p>
                    </div>
                <?php } ?>
            </div>

            <a href="<?php echo $newUrlEditPassword; ?>" class="mdp">
                    Changer mon mot de passe
            </a>
            

            <div class="btn-save" style="display: none;" id="btn-save">
                <input class="submit" type="submit" value="Sauvegarder">
            </div>
        </form>

    </div>
    
</section>

