function changeLogo() {
    const image = document.getElementById('logo');
    const input = document.getElementById('inputLogo');

    const file = input.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            image.src = e.target.result;

        };

        reader.readAsDataURL(file);
    } else {
        // Si aucun fichier n'est sélectionné, vous pouvez également réinitialiser l'image image.
        image.src = "#";
    }
}

function afficheBtnSave() {
    // Récupérer les éléments
    const inputNombre = document.getElementById("inputAge");
    const selectElement = document.getElementById("gender");
    const maDiv = document.getElementById("btn-save");

    // Vérifier si l'input de nombre est modifié ou une option est sélectionnée
    if (inputNombre.value !== "" || selectElement.value !== "") {
        maDiv.style.display = "block";
    } else {
        maDiv.style.display = "none";
    }
}