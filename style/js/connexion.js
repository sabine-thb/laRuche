document.addEventListener('DOMContentLoaded', function () {
    const inputDescription = document.getElementById('description');
    const label = document.querySelector('#btn-info');

    inputDescription.addEventListener('blur', function () {
        label.classList.remove('bouge');
    });
});

function afficherErreurInscription() {

    function checkChampVide(a) {
        a.classList.remove('erreurInputVide');

        if (a.value.trim() === "") {
            a.classList.add('erreurInputVide');
            return true;
        }
        return false;
    }

    let champs = [
        document.getElementById('login'),
        document.getElementById('mail'),
        document.getElementById('description'),
        document.getElementById('mdp')
    ];

    let erreur = true;

    champs.forEach(e => {
        if (checkChampVide(e))
            erreur = false;
    });

    return erreur;
}

function showTitle(element) {

    if (window.innerWidth <= 880) {
        const titleText = element.getAttribute('title');
        alert(titleText);
    }
}

function ajouteAnimationBouttonInfo() {
    const info = document.querySelector('#btn-info');
    info.classList.add('bouge');
}