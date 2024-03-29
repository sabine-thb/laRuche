function rechercherUtilisateur() {

    const pseudo = document.getElementById('search').value;

    if (pseudo !== "") {
        // Effectuer une requête AJAX vers le script PHP côté serveur
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const resultats = JSON.parse(xhr.responseText);
                afficherResultats(resultats);
            }
        };
        xhr.open("GET", "recherche_utilisateur.php?pseudo=" + encodeURIComponent(pseudo), true);
        xhr.send();
    } else {
        const resultatDiv = document.getElementById('resultats');
        resultatDiv.innerHTML = '';
    }
}

function afficherResultats(resultats) {
    const resultatDiv = document.getElementById('resultats');
    resultatDiv.innerHTML = '';

    if (resultats.length > 0) {
        resultats.forEach(function (utilisateur) {
            let verifier = utilisateur.est_verifier ? ' oui ' : ' non ';

            let confirmPwd = 'Est-tu sur de reset le mot de passe de ' + utilisateur.login + ' ? Cela entrainera la ' +
                'suppression definitive de son ancien mot de passe et ' + utilisateur.login + ' pourra créer un nouveau ' +
                'mot de passe lors de sa prochaine connexion.';

            let confirmDelete = 'Est-tu sur de vouloir supprimer ' + utilisateur.login + ' ?';

            let confirmDemande = 'Êtes-vous sûr de vouloir valider ' + utilisateur.login + ' ?';

            let baliseValider;
            if (verifier === ' non ') {
                baliseValider = '<a class="p valid" href="admin.php?action=valider&id=' + utilisateur.user_id + '" ' +
                    'onclick="return confirm(\'' + confirmDemande + '\');">Valider</a> ';
            } else
                baliseValider = "";

            // desolé c'est illisible
            resultatDiv.innerHTML +=
                '<div class="oneUser">' +
                '<p>Prenom : ' + utilisateur.prenom + '</p>' +
                '<p>Pseudo : ' + utilisateur.login + '</p> <p> Mail : ' + utilisateur.mail + ' </p>' +
                '<p>Description : ' + utilisateur.description + '</p> <p> Validé : ' + verifier + '</p>' +
                '<div class="gerer"> ' +
                '<a class="lienResetPwd" href="admin.php?action=resetPwd&idUser=' + utilisateur.user_id + '" ' +
                'onclick="return confirm(\'' + confirmPwd + '\');"> changer le mot de passe</a> ' +
                '<a class="lienDeleteUser" href="admin.php?action=supprimeUser&idUser=' + utilisateur.user_id + '" ' +
                'onclick="return confirm(\'' + confirmDelete + '\');">supprimer</a> ' +
                baliseValider +
                '</div>' +
                '</div>';
        });
    } else {
        resultatDiv.innerHTML = '<p>Aucun utilisateur trouvé.</p>';
    }
}