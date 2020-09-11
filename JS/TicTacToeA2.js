/* 
Name: Juan Estupinan
Student Number: 991593151
*/
// Gets element by message ID
var message = document.getElementsByName("message")[0];
// Gets element of winner ID
var winner = document.getElementById("winner");
// Gets all the elements in table cells
var board = document.getElementsByClassName("cellPart");

// assuming we index the 9 tic tac toe cells from left to right, top to
// bottom, as 0-8, these would be all of the winning combinations:
var winSets = [[0, 1, 2], [3, 4, 5], [6, 7, 8], [0, 3, 6], [1, 4, 7], [2, 5, 8], [0, 4, 8], [2, 4, 6]];
//0 if empty, 1 if X, 2 if O
let cellClickedArray = [
    [[0, 0, 0],
     [0, 0, 0],
     [0, 0, 0]],
    [[10, 11, 12],
     [20, 21, 22],
     [30, 31, 32]]
    ];

// X always gets to go first
var player;
var selectedPlayer;
var aiPlayer;
var winner;

// keep track of how many cells are empty at any time
var empty = 9;

// keep track of game status - false if still playing
var gameOver = false;

var difficulty;

var boardVals = 10;
for (i=0;i<board.length;i++) {
    board[i].value = boardVals;
    if (boardVals === 12 || boardVals === 22 || boardVals === 33) {
        boardVals = boardVals+8;
    } else {
        boardVals++;
    }
}
/* Function resetGame() is called when user clicks on the "game reset" button
 1. sets content of all 9 cells to nothing
 2. sets the starting player (this version, X always starts the game)
 3. updates the message to the current player
 4. resets the number of empty cells to 9
 5. sets the game over flag to false to indicate that the game is in progress
 */

function resetGame() {

    //for loop checks every cell and sets it to nothing
    for (i = 0; i < board.length; i++) {
        board[i].innerHTML = "";
    }
    //Sets parameters to default values
    player = selectedPlayer;
    gameOver = false;
    empty = 9;
    cellClickedArray = [
                  [[0, 0, 0],
                   [0, 0, 0],
                   [0, 0, 0]],
                  [[10, 11, 12],
                   [20, 21, 22],
                   [30, 31, 32]]
                  ];
    //Sets the player _ Go! to X
    document.getElementById("player").innerHTML = player;
}

/* Function cellClicked() is called
 when the event listeners for the "td" cells fire which occurs
 when the user clicks on one of the nine cells of the board
 1. decreases # of empty cells by 1
 2. sets the content of the clicked cell to the current player's mark
 3. checks whether or not there is a winner
 4. flips (changes) the current player
 5. updates the message to the current player
 */
function cellClicked(cell) {
    //Will execute only if the space is empty, empty variable is equal or greater than 0, or if gameOver is set to false.
    if (cell.innerHTML === "" && empty >= 0 && gameOver === false) {
        cell.innerHTML = player;
        empty -= 1;
        //look at this
        
        switch (cell.value) {
            case 10:
                if (player === "X") {
                    cellClickedArray[0][0][0] = 1;
                } else {cellClickedArray[0][0][0] = 2;}
                break;
            case 11:
                if (player === "X") {
                    cellClickedArray[0][0][1] = 1;
                } else {cellClickedArray[0][0][1] = 2;}
                break;
            case 12:
                if (player === "X") {
                    cellClickedArray[0][0][2] = 1;
                } else {cellClickedArray[0][0][2] = 2;}
                break;
            case 20:
                if (player === "X") {
                    cellClickedArray[0][1][0] = 1;
                } else {cellClickedArray[0][1][0] = 2;}
                break;
            case 21:
                if (player === "X") {
                    cellClickedArray[0][1][1] = 1;
                } else {cellClickedArray[0][1][1] = 2;}
                break;
            case 22:
                if (player === "X") {
                    cellClickedArray[0][1][2] = 1;
                } else {cellClickedArray[0][1][2] = 2;}
                break;
            case 30:
                if (player === "X") {
                    cellClickedArray[0][2][0] = 1;
                } else {cellClickedArray[0][2][0] = 2;}
                break;
            case 31:
                if (player === "X") {
                    cellClickedArray[0][2][1] = 1;
                } else {cellClickedArray[0][2][1] = 2;}
                break;
            case 32:
                if (player === "X") {
                    cellClickedArray[0][2][2] = 1;
                } else {cellClickedArray[0][2][2] = 2;}
                break;
        }
        // Each time an appropriate cell is clicked, function checkWin() runs and sees if there is a win.
        checkWin(); 
        //Like an if statement, it checks if the player is "X". If it is true it changes to "O". I false it changes to "X".   
        player = (player === "X") ? "O" : "X";
        //Changes the "Player _ Go!" to the appropriate turn.
        document.getElementById("player").innerHTML = player;
        
       if (aiPlayer === player) {
        setTimeout(aiTurn, 1000);
       }
    }
}

/* Function checkWin() is called to check all winning combinations and display results
 */
function checkWin() {

    //For loop runs through winSets 2d array length. 
    //It goes through all the winning sets and checks if the html doc has the winning sets.
    //It does this by referencing the winSets array numbers into the boards array.
    //It uses the winSets array numbers to check if there are the same "X" or same "O" in the same positions as winSets.
    for ( i = 0; i < winSets.length; i++) {
        if (board[winSets[i][0]].innerHTML == board[winSets[i][1]].innerHTML 
            && board[winSets[i][1]].innerHTML == board[winSets[i][2]].innerHTML 
            && board[winSets[i][0]].innerHTML != "") {  
                message.style.display = 'block';
                gameOver = true;
                winner.innerHTML = player+" Wins!";
                winner = player;
                sendPHP();
                displayWin(true);
                break;
        }
    }
    //Displays message for no one winning
    if (empty == 0) {
        gameOver = true;
        message.style.display = 'block';
        winner.innerHTML = "No one wins! :(";
        displayWin(true);
    } 
}
//Event listener for reset game button
document.getElementById("reset").addEventListener("click", resetGame);
//event listener for end message block. It dismisses end message pops up that says "click anywhere in the box..."
message.addEventListener("click", function() {
    displayWin(false);
});

//event listener with for loop that checks the board to see which cell got clicked and inputs it to the cellClicked function.
if (player === selectedPlayer) {
    for ( i = 0; i < board.length; i++) {
        board[i].addEventListener("click", function() {
            cellClicked(this);
        });
    }
}
// displays the results window with the winner inside it: the method will
// either show the results or hide them (displayWin(true) shows and 
// displayWin(false) hides)
function displayWin(show) {
    if (show) {
        message.style.visibility = "visible";
        document.getElementById("overlay").style.display = "block";
    } else {
        message.style.visibility = "hidden";
        document.getElementById("overlay").style.display = "none";
    }
}
/*
-------------------------------Sending Wins to Server Code-----------------------------------------------------
*/
function sendPHP() {
    if (winner === selectedPlayer) {
        if (difficulty === "easy") {
            $.get("../PHP/PHP-Wins/easyWin.php");
            return false;
        } else if (difficulty === "normal") {
            $.get("../PHP/PHP-Wins/normalWin.php");
            return false;
        } else if (difficulty === "hard") {
            $.get("../PHP/PHP-Wins/hardWin.php");
            return false;
        }
    }
}
/*
-------------------------------Difficulty Selector Code --------------------------------------------------------
*/
document.getElementById("changeDiff").addEventListener("click", function () {
    document.getElementsByClassName("container2")[0].style.visibility = "visible";
    document.getElementById("overlay").style.display = "block";
    resetGame();
});

document.getElementById("confirm").addEventListener("click", playerDifficulty);
function playerDifficulty() {
    if ((document.getElementById("Xselect").checked == true || document.getElementById("Oselect").checked == true) 
        && (document.getElementById("easy").checked == true || document.getElementById("normal").checked == true ||
        document.getElementById("hard").checked == true)) {
        document.getElementsByClassName("container2")[0].style.visibility = "hidden";
        document.getElementById("overlay").style.display = "none";
        for (i=0; i<document.getElementsByName("playerSelect").length; i++) {
            if (document.getElementsByName("playerSelect")[i].checked) {
                player = document.getElementsByName("playerSelect")[i].value;
                selectedPlayer = document.getElementsByName("playerSelect")[i].value;
                aiPlayer = (selectedPlayer === "X") ? "O" : "X";
                document.getElementById("player").innerHTML = selectedPlayer;
            }
        }
        for (i=0; i<document.getElementsByName("difficulty").length; i++) {
            if (document.getElementsByName("difficulty")[i].checked) {
                difficulty = document.getElementsByName("difficulty")[i].value;
            }
        }
    } else {
        document.getElementsByClassName("break")[0].innerHTML = "Please Select a Player and Difficulty";
        document.getElementsByClassName("break")[0].style.color = "red";
    }
}

/*
-------------------------------AI CODE BELOW-------------------------------------------------------------------
*/

function aiTurn() {
    switch (difficulty) {
        case "easy":
            var getBoard = document.getElementsByClassName("cellPart");
            var aiSelected = easySelect();
            for(i=0; i<getBoard.length; i++) {
                if(getBoard[i].value === aiSelected) {
                    cellClicked(getBoard[i]);
                }
            }
            break;
        case "normal":
            normalSelect();
            break;
        case "hard":
            hardSelect();
            break;
    }
}

function pathAI () {
    var score = 0;
    return score;
}

function easySelect () {
    var emptyCells = [];
    var selectedCell;
    //This part will cycle through all the cells and put the empty cells in the array above with the corresponding cell value.
    for (i=0; i<3; i++) {
        for(j=0; j<3; j++) {
            if (cellClickedArray[0][i][j] === 0) {
                emptyCells.push(cellClickedArray[1][i][j]);
            }
        }
    }
    var num = Math.floor(Math.random() * emptyCells.length);
    
    selectedCell = emptyCells[num];
    return selectedCell;
}


function hardSelect () {
    let game = new aiPath();
    let gameBoard = [];
    let ba = [];
    let bb = [];
    let bc = [];
    for (i = 0; i<3; i++) {
        for (j=0; j<3; j++) {
            if (i == 0) {
                ba.push(cellClickedArray[0][i][j]);
            } else if (i == 1) {
                bb.push(cellClickedArray[0][i][j]);
            } else if (i == 2) {
                bc.push(cellClickedArray[0][i][j]);
            }
        }
    }
    gameBoard.push(ba, bb, bc);
    console.log(game.bestMove(gameBoard));
    console.log(game.nodeMap);
}

class aiPath {
    constructor (maxDepth = -1) {
        this.maxDepth = maxDepth;
        this.nodeMap = new Map();
        this.j = 0;
        this.s = 0;
    }
    bestMove(board, max = true, callBack = () => {}, depth = 0) {

        if (depth == 0 ) {
            this.nodeMap.clear();
        }
        
        let valu = checkforWin(board);
        if (valu[0] == true || depth == this.maxDepth) {
            if (valu[1] === 1) {
                return 100 - depth;
            } else if (valu[1] === 2) {
                return -100 + depth;
            }
            return 0;
        }
        if (max) {
            let best = -100;
            board.forEach(function (index, i) {
                for (let x = 0; x < 3; x++) {
                    if(index[x] == 0) {
                        let child = board.slice();
                        //the for each will return an index number of the 2d array but it is combined into a string
                        child[i][x] = 1;
                        //TODO: fix bottom. is undefined for some reason
                        let nodeVal = this.bestMove(child, false, callBack, depth + 1);
                        best = Math.max(best, nodeVal);
                        break;
                    }
                }
                if (depth == 0) {
                    console.log("here3");
                    var moves = this.nodeMap.has(nodeVal) ? `${this.nodeMap.get(nodeVal)}.${index}` : index;
                    console.log("here4");
                    this.nodeMap.set(nodeVal, moves);
                    console.log("here5");
                }

            });

            if (depth == 0) {
                if (typeof this.nodeMap.get(best) == 'string') {
                    console.log("here6");
                    var arr = this.nodeMap.get(best).split('.');
                    var rand = Math.floor(Math.random() * arr.length);
                    var ret = arr[rand];
                } else {
                    console.log("here7");
                    ret = this.nodeMap.get(best);
                }
                callBack(ret);
                return ret;
            }

            return best;       
        }
        if (!max) {
            let best = 100;
            board.forEach(function (index, i) {
                for (let x=0;x<3;x++) {
                    if(index[x] == 0) {
                        let child = board.slice();
                        //the for each will return an index number of the 2d array but it is combined into a string
                        child[i][x] = 2;
                        console.log(child);
                        let nodeVal = this.bestMove(child, true, callBack, depth + 1);
                        console.log("here9");
                        best = Math.min(best, nodeVal);
                        break;
                    }
                }
                if (depth == 0) {
                    console.log("here10");
                    var moves = this.nodeMap.has(nodeVal) ? this.nodeMap.get(nodeVal) +'.' + index : index;
                    console.log("here11");
                    this.nodeMap.set(nodeVal, moves);
                    console.log("here12");
                }
            });
            //If it's the main call, return the index of the best move or a random index if multiple indicies have the same value
			if(depth == 0) {
				if(typeof this.nodesMao.get(best) == 'string') {
                    console.log("here13");
					var arr = this.nodeMap.get(best).split('.');
					var rand = Math.floor(Math.random() * arr.length);
                    var ret = arr[rand];
                    console.log("here14");
				} else {
                    console.log("here15");
					ret = this.nodeMap.get(best);
				}
				//run a callback after calculation and return the index
				callback(ret);
				return ret;
			}
			//If not main call (recursive) return the heuristic value for next calculation
			return best;
        }
    } 
}
//    [[0, 0, 0],
  //   [0, 0, 0],
    // [0, 0, 0]]

//[[0, 1, 2], [3, 4, 5], [6, 7, 8], [0, 3, 6], [1, 4, 7], [2, 5, 8], [0, 4, 8], [2, 4, 6]]
function checkforWin(board) {
    for ( i = 0; i < winSets.length; i++) {
        if (board[winSets[i][0]] == board[winSets[i][1]] 
            && board[winSets[i][1]] == board[winSets[i][2]] 
            && board[winSets[i][0]] != 0) {  
                return [true, board[winSets[i][0].innerHTML]];
        } else {
            return [false, null];
        }
    }
}