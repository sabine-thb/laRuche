function afficherErreurInscription() {

    function checkChampVide(a){
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

    champs.forEach( e => {
        if (checkChampVide(e))
            erreur = false;
    });

    return erreur;
}