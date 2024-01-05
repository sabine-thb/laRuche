function rechercherUtilisateur() {

    const pseudo = document.getElementById('search').value;

    if (pseudo !== "") {
        // Effectuer une requête AJAX vers le script PHP côté serveur
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var resultats = JSON.parse(xhr.responseText);
                afficherResultats(resultats);
            }
        };
        xhr.open("GET", "recherche_utilisateur.php?pseudo=" + encodeURIComponent(pseudo), true);
        xhr.send();
    }else{
        const resultatDiv = document.getElementById('resultats');
        resultatDiv.innerHTML = '';
    }
}

function afficherResultats(resultats) {
    const resultatDiv = document.getElementById('resultats');
    resultatDiv.innerHTML = '';

    if (resultats.length > 0) {
        resultats.forEach(function (utilisateur) {
            resultatDiv.innerHTML += '<p>Nom: ' + utilisateur.login + ', Pseudo: ' + utilisateur.mail + '</p>';
        });
    } else {
        resultatDiv.innerHTML = '<p>Aucun utilisateur trouvé.</p>';
    }
}