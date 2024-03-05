// canvas
const canvas = document.getElementById("gameCanvas");
const ctx = canvas.getContext("2d");
const backgroundImage = new Image();
backgroundImage.src = './style/img/mini-jeu/babSnake/terrain.jpg';

// general
let isPaused = true;
let intervalIdMain;
let intervalIdApple;
const updateIntervalMain = 17; //60fps
const canvasHeight = 450;
const canvasWidth = 750;

// snake
let snake = [];
let direction;
let speed = 3;
const tableauImgSnake = []
let score;
const sizeSnake = 80;

// apple
let applePosition = [];
const cooldownApple = 1500; // 3s
const tableauImgApple = []
const sizeApple = 65;

const hitBox = sizeSnake - sizeApple;

async function loadImagesFromDirectory() {
    //todo je n'ai pas trouvé le moyen de parcourir toutes les images d'un meme repertoire...
    async function loadOneImg(cheminBabtouName, tab) {
        let img = new Image();
        img.src = cheminBabtouName;
        await new Promise(resolve => {
            img.onload = () => resolve();
        });
        tab.push(img);
    }

    await loadOneImg("./style/img/mini-jeu/babSnake/apple/ayme.png", tableauImgApple);
    await loadOneImg("./style/img/mini-jeu/babSnake/apple/charlito.png", tableauImgApple);
    await loadOneImg("./style/img/mini-jeu/babSnake/apple/daniel.png", tableauImgApple);
    // await loadOneImg("img/apple/gabi.png", tableauImgApple);
    await loadOneImg("./style/img/mini-jeu/babSnake/apple/justin.png", tableauImgApple);
    await loadOneImg("./style/img/mini-jeu/babSnake/apple/gabii.png", tableauImgApple);
    await loadOneImg("./style/img/mini-jeu/babSnake/apple/theo.png", tableauImgApple);
    await loadOneImg("./style/img/mini-jeu/babSnake/apple/arno.png", tableauImgApple);
    await loadOneImg("./style/img/mini-jeu/babSnake/apple/jonas.png", tableauImgApple);

    await loadOneImg("./style/img/mini-jeu/babSnake/snake/zlatan.png", tableauImgSnake);
    await loadOneImg("./style/img/mini-jeu/babSnake/snake/zlatan 1.png", tableauImgSnake);
    await loadOneImg("./style/img/mini-jeu/babSnake/snake/zlatan 2.png", tableauImgSnake);
    await loadOneImg("./style/img/mini-jeu/babSnake/snake/zlatan 3.png", tableauImgSnake);
    await loadOneImg("./style/img/mini-jeu/babSnake/snake/zlatan 4.png", tableauImgSnake);
}

function drawSnake() {
    ctx.drawImage(backgroundImage, 0, 0, canvasWidth, canvasHeight);
    snake.forEach(segment => {
        ctx.drawImage(tableauImgSnake[Math.floor(score / 10)], segment.x, segment.y, sizeSnake, sizeSnake);
    });
}

function drawApple() {
    applePosition.forEach(segment => {
        ctx.filter = "drop-shadow(4px 3px 3px dodgerblue)";
        ctx.drawImage(segment.img, segment.x, segment.y, sizeApple, sizeApple);
        ctx.filter = "none";
    });
}

function updateDraw() {
    drawSnake();
    drawApple();
    checkAppleCollision();
}

function moveSnake() {
    const head = {
        x: snake[0].x + (direction === "left" ? -speed : direction === "right" ? speed : 0),
        y: snake[0].y + (direction === "up" ? -speed : direction === "down" ? speed : 0)
    };
    head.x = head.x > canvasWidth - sizeSnake ? canvasWidth - sizeSnake : head.x < 0 ? 0 : head.x;
    head.y = head.y > canvasHeight - sizeSnake ? canvasHeight - sizeSnake : head.y < 0 ? 0 : head.y;
    snake.unshift(head);
    snake.pop();
}

function main() {
    if (!isPaused) {
        updateDraw();
        moveSnake();
    }
}

function gagnePoint(value) {
    score += value;
    document.getElementById("score").textContent = score;

    if (score === 45) {
        isPaused = true;
        clearInterval(intervalIdMain);
        clearInterval(intervalIdApple);
        document.removeEventListener("keydown", changeDirection);
        document.removeEventListener("keydown", pause);
        document.getElementById('fenetre-fin-cacher').id = 'fenetre-fin-display';
    }
}

function resetGame() {
    snake = [{x: 10, y: 10}];
    isPaused = true;
    direction = "right";
    score = 0;
    applePosition = [];
    document.addEventListener("keydown", changeDirection);
    document.addEventListener("keydown", pause);
    drawSnake();
    document.getElementById('fenetre-fin-display').id = 'fenetre-fin-cacher';
}

function generateRandomPosition() {
    const x = Math.floor(sizeApple + (Math.random() * (canvasWidth - sizeApple * 2)));
    const y = Math.floor(sizeApple + (Math.random() * (canvasHeight - sizeApple * 2)));
    const img = tableauImgApple[Math.floor(Math.random() * tableauImgApple.length)]
    return {x, y, img};
}

function checkAppleCollision() {
    function haveCollision(e1, e2) {
        return ((e1.x + hitBox >= e2.x &&
                    e1.x - hitBox <= (e2.x + sizeApple)) ||
                (e1.x + sizeSnake + hitBox) >= e2.x &&
                (e1.x + sizeSnake - hitBox) <= (e2.x + sizeApple)) &&

            ((e1.y + hitBox >= e2.y &&
                    e1.y - hitBox <= (e2.y + sizeApple)) ||
                (e1.y + sizeSnake + hitBox) >= e2.y &&
                (e1.y + sizeSnake - hitBox) <= (e2.y + sizeApple));
    }

    applePosition.forEach((apple, index) => {
        if (haveCollision(snake[0], apple)) {
            gagnePoint(1);
            applePosition.splice(index, 1);
            // placeApple();
        }
    });
}

function placeApple() {
    const newPosition = generateRandomPosition();

    if (!snake.some(segment => segment.x === newPosition.x && segment.y === newPosition.y)) {
        applePosition.unshift(newPosition);
        if (applePosition.length > 3) applePosition.pop()
    } else {
        placeApple();
    }
}

function pause(event) {
    if (event.key === " ") {
        event.preventDefault();
        isPaused = !isPaused;
        if (isPaused) {
            clearInterval(intervalIdMain);
            clearInterval(intervalIdApple);
        } else {
            intervalIdMain = setInterval(main, updateIntervalMain);
            intervalIdApple = setInterval(placeApple, cooldownApple);
        }
    }
}

function changeDirection(event) {
    event.preventDefault();
    const keyPressed = event.key;
    if (keyPressed === "ArrowUp") {
        direction = "up";
    } else if (keyPressed === "ArrowDown") {
        direction = "down";
    } else if (keyPressed === "ArrowLeft") {
        direction = "left";
    } else if (keyPressed === "ArrowRight") {
        direction = "right";
    }
}

loadImagesFromDirectory("chemin/vers/ton/repertoire").then(() => {
    resetGame();
});
