<script src="./style/js/profil/editLogo.js"></script>
<link rel="stylesheet" href="./style/css/PageProfil.css">
<div id="content">
    <form action="<?php echo $newURL; ?>" method="post" id="formProfil" enctype="multipart/form-data">

        <div class="topLeft-form">
            <div class="logoInput">
                <img src="./style/img/logoBleu.png" class="imgProfil" alt="image profil" id="logo">
               <!-- <label>

                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                    <input type="file" name="new_logo" accept="image/*" id="inputLogo" onchange="changeLogo()"/>
                </label>-->
            </div>

            <div class="Nom">
                <h2><?php echo $data['login'];?></h2>
            </div>
        </div>

        <div id="description">
            <p>
                <?php echo $data['description']; ?>
            </p>
        </div>

        <div id="input-age-genre">
            <label for="inputAge" >Age :</label>
            <input type="number" name="age" id="inputAge" min="1" max="99" inputmode="numeric"
                   value="<?php echo $data['age']; ?>" oninput="afficheBtnSave()">

            <label for="gender" >Genre :</label>
            <select name="gender" id="gender" onchange="afficheBtnSave()">
                <option value="<?php echo $data["optionGender"]; ?>"><?php echo $data["optionGender"]; ?></option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="autre">autre</option>
                <option value="default">je préfère ne pas dire</option>
                <option value="croissant">I'm a croissant</option>
            </select>
        </div>

        <div id="competActive">
            <h4> Mes compétitions Actives :</h4>
            <?php foreach ($competActive as $tuple) { ?>
                <div class="one-compet" style="display: flex;text-align: center"> <!--attention 'oneCompet' est deja utilisé dans un css-->
                    <h2>
                        <?php echo $tuple['nom']; ?>
                    </h2>
                    <p> - <?php echo $tuple['classement']; ?> e</p>
                </div>
            <?php } ?>
        </div>

        <div id="center">
            <a href="profil.php?action=changePassword" style="text-decoration: none; padding: 5px; background-color: #9b9b9b; border-radius: 10px; cursor: pointer;">
                Changer mon mot de passe
            </a>
        </div>

        <div class="btn-save" style="display: none;" id="btn-save">
            <input class="submit" type="submit" value="Sauvegarder">
        </div>
    </form>
</div>

