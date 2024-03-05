const cases = [];
const casesRemplies = new Array(9).fill(false)
for (const nb of ["1", "2", "3", "4", "5", "6", "7", "8", "9"]) {
    cases.push(document.getElementById(nb));
}
for (const cell of cases) {
    cell.addEventListener("click", function () {
        let currentCell = this;
        if (currentCell.classList.contains('hulk')) {
            new Audio('./style/img/mini-jeu/hulkV45/meurt.mp3').play()
            currentCell.classList.remove('hulk');
            currentCell.classList.add('hulkMort');
            setTimeout(function () {
                currentCell.classList.remove('hulkMort');
                casesRemplies[parseInt(currentCell.id, 10) - 1] = false
            }, 300)
            score++;
            updateScore();
            if (score === 45) {
                endGame()
            }
        }
    });
}

var button = document.getElementById("startGameButton");
var jeu = document.getElementById("Game");
var txtAndButton = document.getElementById("gameStart");
var game;
var score = 0;

function endGame() {
    jeu.style.display = "none";
    txtAndButton.style.display = "block";
    document.getElementById("txt").textContent = "Bravo ! Ton score est de 45. Rdv Dimanche pour voir le massacre des Hulks"
    clearInterval(game);
    score = 0;
    updateScore();
}

function updateScore() {
    document.getElementById("score").textContent = "Score: " + score;
}

function randomEvent() {
    let randomIndex = Math.floor(Math.random() * cases.length);
    while (casesRemplies[randomIndex] === true) {
        randomIndex = Math.floor(Math.random() * cases.length);
    }
    const randomCell = cases[randomIndex];
    randomCell.classList.add("hulk");
    casesRemplies[randomIndex] = true;
    setTimeout(() => {
        randomCell.classList.remove("hulk");
        casesRemplies[randomIndex] = false;
    }, Math.floor((Math.random() * (3000 - 600)) + 600)); // retirer le hulk

}

button.addEventListener("click", function () {
    jeu.style.display = "block";
    txtAndButton.style.display = "none";
    updateScore();
    setTimeout(endGame, 60000); // 1 minute
    game = setInterval(randomEvent, 300); // Interval en millisecondes
});
