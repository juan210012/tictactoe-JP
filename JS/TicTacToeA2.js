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

// X always gets to go first
var player;
var selectedPlayer;
var winner;

// keep track of how many cells are empty at any time
var empty = 9;

// keep track of game status - false if still playing
var gameOver = false;


var difficulty
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
        // Each time an appropriate cell is clicked, function checkWin() runs and sees if there is a win.
        checkWin(); 
        //Like an if statement, it checks if the player is "X". If it is true it changes to "O". I false it changes to "X".   
        player = (player === "X") ? "O" : "X";
        //Changes the "Player _ Go!" to the appropriate turn.
        document.getElementById("player").innerHTML = player;
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
//Event listener for reset game button
document.getElementById("reset").addEventListener("click", resetGame);
//event listener for end message block. It dismisses end message pops up that says "click anywhere in the box..."
message.addEventListener("click", function() {
    displayWin(false);
});

//event listener with for loop that checks the board to see which cell got clicked and inputs it to the cellClicked function.
for ( i = 0; i < board.length; i++) {
    board[i].addEventListener("click", function() {
        cellClicked(this);
    });
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