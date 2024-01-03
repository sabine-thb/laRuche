
document.addEventListener("click",e => {
    let tar = e.target;
    if (tar.classList.contains("toggle"))
        tar.removeAttribute("class");
});

document.addEventListener('DOMContentLoaded', function () {

    const cartePronos = document.getElementsByClassName('carteProno');

    for (let i = 0; i < cartePronos.length; i++) {

        let input1 = cartePronos[i].querySelector('#prono1');
        let input2 = cartePronos[i].querySelector('#prono2');
        let elementVisible = cartePronos[i].querySelector('.selectionFinale');

        function checkEquality() {
            let value1 = parseInt(input1.value, 10);
            let value2 = parseInt(input2.value, 10);

            if (value1 === value2) {
                elementVisible.style.display = 'block';
            } else {
                elementVisible.style.display = 'none';
            }
        }

        // Ajouter des écouteurs d'événements pour les changements dans les champs de saisie
        input1.addEventListener('input', checkEquality);
        input2.addEventListener('input', checkEquality);

        checkEquality();
    }
});

