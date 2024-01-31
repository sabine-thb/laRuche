document.addEventListener('DOMContentLoaded', function() {

    // Obtenez les paramètres de requête de l'URL actuelle
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    let monElement;

    switch (action){
        case 'classement':
            monElement = document.getElementById('classement');
            break;
        case 'affichePronostic':
        case 'validationProno':
            monElement = document.getElementById('prono');
            break;
        case 'questionsBonus':
            monElement = document.getElementById('questions');
            break;
        case 'editProfil':
            monElement = document.getElementById('editProfil');
            break;
        case 'resultat':
            monElement = document.getElementById('resultats');
            break;
        case 'competitionDisponible':
            monElement = document.getElementById('competDispo');
            break;
        case 'afficheMesCompet':
            monElement = document.getElementById('competActive');
            break;
    }

    // Ajoutez une classe speciale pour savoir sur quelle page on se trouve
    monElement.classList.remove('linkDefaut');
    monElement.classList.add('linkActive');
});

function afficherMenuProfil(){
    const menu = document.querySelector('.profilDetails');
    menu.style.display = menu.style.display === "flex" ? "none" : "flex";
}