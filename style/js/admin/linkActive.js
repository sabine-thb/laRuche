document.addEventListener('DOMContentLoaded', function () {

    // Obtenez les paramètres de requête de l'URL actuelle
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('type') || "ouvert";
    let monElement;

    switch (action) {
        case 'ouvert':
            monElement = document.getElementById('linkOuvert');
            break;
        case 'en_attente':
            monElement = document.getElementById('linkEnAttente');
            break;
        case 'fini':
            monElement = document.getElementById('linkFini');
            break;
    }

    // Ajoutez une classe speciale pour savoir sur quelle page on se trouve
    monElement.classList.add('buttonMatchActive');
});