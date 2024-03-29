document.addEventListener("click", e => {
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
        let customNum = cartePronos[i].querySelectorAll('.custom-input');

        function checkEquality() {
            let value1 = parseInt(input1.value, 10);
            let value2 = parseInt(input2.value, 10);

            if (value1 === value2) {
                elementVisible.style.display = 'block';
                input1.style.color = "#2567f5";
                input2.style.color = "#2567f5";
            } else {
                elementVisible.style.display = 'none';
                if (value1 > value2) {
                    input1.style.color = "#21d99b";
                    input2.style.color = "#ff1717";
                } else if (value2 > value1) {
                    input2.style.color = "#21d99b";
                    input1.style.color = "#ff1717";
                }
            }
        }

        customNum.forEach(num => {
            const numInput = num.querySelector('.inputScore');
            const arrUp = num.querySelector('.arr-up');
            const arrDown = num.querySelector('.arr-down');

            function checkMinMax() {
                const value = parseInt(numInput.value);
                const max = parseInt(numInput.max);
                const min = parseInt(numInput.min);

                const heightReduit = window.innerWidth < 850 ? "3.3em" : "5em";
                const paddingReduit = window.innerWidth < 850 ? "0.3em" : "0.8em";

                const heightDefaut = window.innerWidth < 850 ? "100px" : "120px";

                if (value === max) {
                    num.style.paddingTop = paddingReduit;
                    num.style.height = heightReduit;
                    arrUp.style.display = "none";

                    num.style.paddingBottom = "8px";
                    arrDown.style.display = "block";
                } else if (value === min) {
                    num.style.paddingBottom = paddingReduit;
                    num.style.height = heightReduit;
                    arrDown.style.display = "none";

                    num.style.paddingTop = "0";
                    arrUp.style.display = "block";
                } else {
                    num.style.padding = "0";
                    num.style.paddingBottom = "8px";
                    num.style.height = heightDefaut;
                    arrUp.style.display = "block";
                    arrDown.style.display = "block";
                }
            }

            arrUp.addEventListener('click', () => {
                numInput.stepUp();
                checkMinMax();
                checkEquality();
            });

            arrDown.addEventListener('click', () => {
                numInput.stepDown();
                checkMinMax();
                checkEquality();
            });
        });

        // Ajouter des écouteurs d'événements pour les changements dans les champs de saisie
        input1.addEventListener('input', checkEquality);
        input2.addEventListener('input', checkEquality);

        checkEquality();
    }
});

