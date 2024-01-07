
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
                }else if (value2 > value1) {
                    input2.style.color = "#21d99b";
                    input1.style.color = "#ff1717";
                }
            }
        }

        customNum.forEach( num => {
            const numInput = num.querySelector('.inputScore');
            const arrUp = num.querySelector('.arr-up');
            const arrDown = num.querySelector('.arr-down');

            function checkMinMax(){
                const value = parseInt(numInput.value);
                const max = parseInt(numInput.max);
                const min = parseInt(numInput.min);

                if(value === max) {
                    num.style.paddingTop = "0.8em";
                    num.style.height = "5em";
                    arrUp.style.display = "none";

                    num.style.paddingBottom = "0";
                    arrDown.style.display = "block";
                }else if ( value === min) {
                    num.style.paddingBottom = "0.8em";
                    num.style.height = "5em";
                    arrDown.style.display = "none";

                    num.style.paddingTop = "0";
                    arrUp.style.display = "block";
                }else {
                    num.style.padding = "0";
                    num.style.height = "7em";
                    arrUp.style.display = "block";
                    arrDown.style.display = "block";
                }
            }

            arrUp.addEventListener('click', () =>{
                numInput.stepUp();
                checkMinMax();
                checkEquality();
            });

            arrDown.addEventListener('click', () =>{
                numInput.stepDown();
                checkMinMax();
                checkEquality();
            });
        });

        // Ajouter des écouteurs d'événements pour les changements dans les champs de saisie
        input1.addEventListener('input', checkEquality);
        input2.addEventListener('input', checkEquality);

        input1.addEventListener('change', checkEquality);
        input2.addEventListener('change', checkEquality);

        checkEquality();
    }
});

