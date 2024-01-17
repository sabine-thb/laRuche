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