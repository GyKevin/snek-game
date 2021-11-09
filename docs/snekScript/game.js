import {
    update as updateSnake_1, draw as drawSnake_1, redScore,
    getSnakeHead as getSnakeHead_1, snakeIntersection as snakeIntersection_1
} from './snake.js'

import {
    update as updateSnake_2, draw as drawSnake_2, blueScore,
    getSnakeHead as getSnakeHead_2, snakeIntersection as snakeIntersection_2
} from './snake2.js'

import { update as updateFood, draw as drawFood } from './food.js'
import { GRID_HEIGTH, GRID_WIDTH, outsideGrid } from './grid.js'
import { draw as drawBoard } from './board.js'
import { getCookie, setCookie, getElementByID } from './public.js'

let demoOver = getCookie("demo")

if (getCookie('gamemode') !== null) {
    //const tmp = `repeat(${GRID_SIZE}, 1fr)` 
    var gamemode = "";
    gamemode = getCookie("gamemode")
    
    window.onload = function () {
        gameBoard.style.gridTemplateColumns = `repeat(${GRID_WIDTH}, 1fr)`;
        gameBoard.style.gridTemplateRows = `repeat(${GRID_HEIGTH}, 1fr)`;
        console.log(demoOver)
    };

    const scores = getElementByID('scores');
    let SNAKE_SPEED = 3
    // const SNAKE_SPEED = 
    if (window.location.href.indexOf("index") > -1) { 
        if (gamemode === "speed") {
            SNAKE_SPEED = prompt('type snake speed')
        } else {
            SNAKE_SPEED = 10
        }
        
    }

    // let blueScore = 0;
    // let redScore = 0;

    var timeleft = (60*5);
    var downloadTimer = setInterval(function () {
        if (timeleft <= 0) {
            clearInterval(downloadTimer);
        }
        if (getElementByID("progressBar")) {
            getElementByID("progressBar").value = (60*5) - timeleft;
        }

        timeleft -= 1;
    }, 1000);



    let lastRenderTime = 0
    let redGameOver = false
    let blueGameOver = false
    const gameBoard = getElementByID('game-board')

    window.addEventListener('keydown', e => {

        switch (e.key) {
            case 'g':
                window.location = './gamemode.php'
                break
        }
    })

    //check if gameboard is pressent
    function main(currentTime) {
        if (redGameOver) {
            setCookie("highscore", redScore, "1");
            if (confirm('Red lost! press ok to restart')) {
                window.location = 'highscore.php'
            } else {
                window.location = 'highscore.php'
            }
            return
        }
        if (blueGameOver) {
            setCookie("highscore", blueScore, "1");
            if (confirm('Blue lost! press ok to restart')) {
                window.location = 'highscore.php'
            } else {
                window.location = 'highscore.php'
            }
            return
        }

        window.requestAnimationFrame(main)
        const secondsSinceLastRender = (currentTime - lastRenderTime) / 1000
        if (secondsSinceLastRender < 1 / SNAKE_SPEED) return


        // console.log('Render')

        lastRenderTime = currentTime


        update()
        draw()
        let userid = getCookie('userid')
        if (userid === null) {
            if (timeleft === 0) {
                console.log("time's up")
                setCookie("demo", true, 200)
                if(confirm("Demo time is up")){
                    window.location = "./../accountSystem/login/index.php"
                } else {
                    window.location = "./../accountSystem/login/index.php"
                }
                
            }
        }
        
    }

    window.requestAnimationFrame(main)

    function update() {
        updateSnake_1()
        if (gamemode === "multi") { updateSnake_2() }
        updateFood()
        checkDeath()
        updateScores(redScore, blueScore)

    }

    function draw() {
        gameBoard.innerHTML = ''
        drawBoard(gameBoard)
        drawSnake_1(gameBoard)
        if (gamemode === "multi") { drawSnake_2(gameBoard) }
        drawFood(gameBoard)
    }

    function checkDeath() {

        redGameOver = outsideGrid(getSnakeHead_1()) || snakeIntersection_1()
        blueGameOver = outsideGrid(getSnakeHead_2()) || snakeIntersection_2()
    }
    function updateScores(score1, score2) {
        scores.innerHTML = `Red score: ${score1}, Blue score: ${score2}`

    }
}

function setScore (score1, score2) {
    if(score1<score2) return score2
    if(score2<score1) return score1
}