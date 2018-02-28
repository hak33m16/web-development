/*
    Kent State University
    CS 44105/54105 Web Programming I
    Fall 2017
    Assignment 3
    The World's Hardest Game 2 Remake
    worldshardestgame.js
    Author 1: Abdulkareem Alali, aalali1@kent.edu
    Author 2: Abdel-Hakeem Badran, abadran@kent.edu
*/

//--------------------------------------------------
// CONST VARIABLE DECLARATIONS
//--------------------------------------------------

const GOLD = 'rgb(255, 255, 0)';
const DARKBLUE = 'rgb(0,0,139)';

const BACKGROUND_IMAGE = "images/world-hardest-game-2-bg-level-1.png";
const SCREENS = {
    screen3 : {
        gameCenterWall : {
            top : 100,
            bottom : 355,
            }
    }
}

const BALLS = {
    pair1 : {
        ball1 : ["p1b1", 400, 110, 11, 5, DARKBLUE],
        ball2 : ["p1b2", 443, 110, 11, 5, DARKBLUE]
    },
	pair2 : {
        ball1 : ["p1b3", 485, 350, 11, 5, DARKBLUE],
        ball2 : ["p1b4", 528, 350, 11, 5, DARKBLUE]
	},
	pair3 : {
        ball1 : ["p1b3", 570, 110, 11, 5, DARKBLUE],
        ball2 : ["p1b4", 613, 110, 11, 5, DARKBLUE]
	}
}

var ballPositions = [
	[400, 110, 11],
    [443, 110, 11],
    [485, 350, 11],
    [528, 350, 11],
	[570, 110, 11],
	[613, 110, 11]
];

const COINS = {
	pair1 : {
        coin1 : ["p1c1", 421, 270, 9, 0.3, GOLD, 3],
        coin2 : ["p1c2", 506, 185, 9, 0.3, GOLD, 0],
        coin3 : ["p1c3", 593, 270, 9, 0.3, GOLD, 9]
	}
}

var coinsTaken = [ false, false, false ];

var playerDead = false;


var SOUNDS = [
	new Audio('soundeffects/RealisticPunch.mp3'),
	new Audio('soundeffects/CoinCollect.wav'),
	new Audio('soundeffects/World\'sHardestGame2ThemeSong.mp3')
];

//--------------------------------------------------
// VARIABLE DECLARATIONS
//--------------------------------------------------

var obs;
var cns;
var bkrnd;
var plr;

//Engine
var game = {
    canvas: null,
    context : null,
    init : function() {
        this.canvas = document.querySelector("canvas");
        this.context = this.canvas.getContext("2d");
    },
	start : function() {
        this.interval = setInterval(update, 20);        
	},
    drawBackground: function(){
        if (this.context != undefined){
            var img = new Image;
            img.src = BACKGROUND_IMAGE;
            this.context.drawImage(img, 0, 0);
        }
    },
    stop : function() {
        clearInterval(this.interval);
    },    
    clear : function() {
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
    },
    getContext: function(){
        return this.context;
    }
}

const PLAYER = {
	player1 : {
		info : [240, 210, 30, 4]
	}
}

var MKey = false;
var PKey = false;
var ControlKey = false;
var ArrowUp = false;
var ArrowRight = false;
var ArrowDown = false;
var ArrowLeft = false;

var deaths = 0;
var hasWon = false;

var MUTED = false;
var PAUSED = false;

var DONELOADING = false;

var BEGINCLICKED = false;

//--------------------------------------------------
// EVENT LISTENERS
//--------------------------------------------------

window.addEventListener("load", function(){
    //DOM Loaded
	
	SOUNDS[2].loop = true;

	var el = document.querySelector('p');
	el.children[0].insertAdjacentHTML("afterEnd", "<span><u>M</u>UTE</span>");
	el.children[0].insertAdjacentHTML("afterEnd", "<span><u>P</u>AUSE</span>");
	
	game.init();
	var strt = new startScreen(game);
	strt.draw();
    //startGame();

});

window.addEventListener("keydown", function (event) {
	if (event.defaultPrevented) {
		return; // Do nothing if the event was already processed
	}
	
	switch (event.key) {
	case "ArrowUp":
		ArrowUp = true;
		break;
    case "ArrowRight":
		ArrowRight = true;
		break;
    case "ArrowDown":
		ArrowDown = true;
		break;
    case "ArrowLeft":
		ArrowLeft = true;
		break;
	case "p":
		PKey = true;
		break;
	case "P":
		PKey = true;
		break;
	case "m":
		MKey = true;
		break;
	case "M":
		MKey = true;
		break;
	case "Control":
		ControlKey = true;
		break;
    default:
		return; // Quit when this doesn't handle the key event.
  }

  // Cancel the default action to avoid it being handled twice
  event.preventDefault();
}, true);

window.addEventListener("keyup", function (event) {
	if (event.defaultPrevented) {
		return; // Do nothing if the event was already processed
	}

	//alert(event.key);
	
	switch (event.key) {
	case "ArrowUp":
		ArrowUp = false;
		break;
    case "ArrowRight":
		ArrowRight = false;
		break;
    case "ArrowDown":
		ArrowDown = false;
		break;
    case "ArrowLeft":
		ArrowLeft = false;
		break;
	case "p":
		PKey = false;
		break;
	case "P":
		PKey = false;
		break;
	case "m":
		MKey = false;
		break;
	case "M":
		MKey = false;
		break;
	case "Control":
		ControlKey = false;
		break;
    default:
		return; // Quit when this doesn't handle the key event.
  }

  // Cancel the default action to avoid it being handled twice
  event.preventDefault();
}, true);

var MOUSEX = 0;
var MOUSEY = 0;

var MOUSEDOWNX = 0;
var MOUSEDOWNY = 0;

window.addEventListener('mousemove', function(event) {
	MOUSEX = event.clientX;
	MOUSEY = event.clientY;
	
	//alert(MOUSEX + " " + MOUSEY);
	
}, false);

window.addEventListener('mousedown', function(event) {

	MOUSEDOWNX = event.clientX;
	MOUSEDOWNY = event.clientY;
	
}, false);

window.addEventListener('mouseup', function(event) {
	
	MOUSEDOWNX = 0;
	MOUSEDOWNY = 0;
	
	//alert(MOUSEX + " " + MOUSEY);
	
}, false);

var WINDOWX = 0;
var WINDOWY = 0;
/*
window.addEventListener('onresize', function(event) {
	
	
	
}, true);*/

//--------------------------------------------------
// FUNCTIONS
//--------------------------------------------------

function startGame(){
    //Begin
	PAUSED = false;
	
	hasWon = false;
	coinsTaken = [ false, false, false ];
	game.stop();
	
	game.init();
    game.start();
	
	if (deaths == 0) {
		bkrnd = new background(game);
		obs = new obstacles(game);
		cns = new money(game);
		
		MKey = false;
		PKey = false;
		ControlKey = false;
		ArrowUp = false;
		ArrowRight = false;
		ArrowDown = false;
		ArrowLeft = false;
	}
	
	plr = new playerController(game);
	
}


function startScreen(game){
	this.game = game;
	this.context = this.game.getContext();
	this.beginScreen = beginScreen.construct();
	
	this.draw = function(){
		this.beginScreen.draw(this.game.getContext());
		
		loadingbar(this.game.getContext());
		
	}
	
}

function playerController(game){
	this.game = game;
	this.player = [ square.construct(PLAYER.player1.info) ];
	this.draw = function(){
		if ( playerDead ){
			this.player[0].disappear(this.game.getContext());
		} else if ( hasWon ) {
			
		} else {
			this.player[0].draw(this.game.getContext());
		}
	}
}

function background(game){
	this.game = game;
	
	this.draw = function(){
		this.game.drawBackground();
	}
}

function money(game){
    //create the array of coins that will be animated
    this.game = game;
    this.coins = [ coin.construct(COINS.pair1.coin1),
                   coin.construct(COINS.pair1.coin2),
				   coin.construct(COINS.pair1.coin3)
                ];
    this.animate = function(){
        //loop through the balls array
        //draw the balls
        for (var i = 0; i < this.coins.length; i++){
            if ( !coinsTaken[i] ) this.coins[i].animate(this.game.getContext());
        }
    }
}

function obstacles(game){
    //create the array of balls that will be animated
    this.game = game;
    this.balls = [ ball.construct(BALLS.pair1.ball1),
                   ball.construct(BALLS.pair1.ball2),
				   
				   ball.construct(BALLS.pair2.ball1),
                   ball.construct(BALLS.pair2.ball2),
				   
  				   ball.construct(BALLS.pair3.ball1),
                   ball.construct(BALLS.pair3.ball2)
                ];
    this.animate = function(){
        //loop through the balls array
        //draw the balls
        for (var i = 0; i < this.balls.length; i++){
            this.balls[i].animate(this.game.getContext());
			this.balls[i].updateposition(i);
        }
    }
}

//----------------------------------------------------------------//

function beginScreen(){
	this.draw = function(ctx){
		
		var my_gradient = ctx.createLinearGradient(500, 245, 620, 0);
		my_gradient.addColorStop(0, "rgb(81, 81, 81)");
		my_gradient.addColorStop(0.5, "rgb(38, 38, 38)");
		my_gradient.addColorStop(0.7, "rgb(38, 38, 38)");
		my_gradient.addColorStop(0.85, "rgb(50, 50, 50)");
		my_gradient.addColorStop(1.0, "rgb(38, 38, 38)");
		ctx.fillStyle = my_gradient;
		
		ctx.beginPath();
		ctx.moveTo(0, 0);
		ctx.lineTo(1000, 0);
		ctx.lineTo(1000, 490);
		ctx.fill();
		
		my_gradient = ctx.createLinearGradient(500, 245, 375, 500);
		my_gradient.addColorStop(0, "rgb(81, 81, 81)");
		my_gradient.addColorStop(0.5, "rgb(38, 38, 38)");
		ctx.fillStyle = my_gradient;
		
		ctx.beginPath();
		ctx.moveTo(0, -1);
		ctx.lineTo(0, 490);
		ctx.lineTo(1001, 490);
		ctx.fill();
		
		// Bottom Bar
		
		ctx.globalAlpha = 0.0;
		for (var i = 0; i < 20; ++ i) {

			my_gradient = ctx.createLinearGradient(500, 490, 500, 440);
			my_gradient.addColorStop(0, "rgb(0, 0, 0)");
			my_gradient.addColorStop(1.0, "rgb(38, 38, 38)");
			ctx.fillStyle = my_gradient;
			
			ctx.fillRect(0, 410 + (4 * i), 1000, 80);

			ctx.globalAlpha += 0.05;
			
		}
		ctx.globalAlpha = 1.0;
		
		// Top Bar
		
		ctx.globalAlpha = 0.0;
		for (var i = 0; i < 20; ++ i) {

			my_gradient = ctx.createLinearGradient(500, 0, 500, 50);
			my_gradient.addColorStop(0, "rgb(0, 0, 0)");
			my_gradient.addColorStop(1.0, "rgb(38, 38, 38)");
			ctx.fillStyle = my_gradient;
			
			ctx.fillRect(0, 0, 1000, 80 - ( 4 * i));

			ctx.globalAlpha += 0.05;
			
		}
		ctx.globalAlpha = 1.0;
		
		// Hardest Game Text
		
		/*ctx.font = "86pt mono45-headline";
		ctx.fillStyle = "darkblue";
		ctx.fillText("HARDEST GAME", 200, 180);*/
		
		/*ctx.strokeStyle = "rgb(250, 250, 250)";
		ctx.lineWidth = "12";
		ctx.font = "86pt mono45-headline";
		ctx.strokeText("HARDEST GAME", 200, 180);*/
		
		my_gradient = ctx.createLinearGradient(500, 170, 500, 80);
		my_gradient.addColorStop(0, "rgb(33, 69, 137)");
		my_gradient.addColorStop(1.0, "rgb(104, 151, 229)");
		ctx.fillStyle = my_gradient;
		
		var ogx = 178;
		var ogy = 180;
		var offset = 54;
		var whitewidth = 4;
		var blackwidth = 3;
		
		var title = "HARDEST GAME";
		for (var i = 0; i < title.length; ++ i){
			
			// White Outline
			
			// -- //
			
			ctx.strokeStyle = "rgb(250, 250, 250)";
			ctx.lineWidth = whitewidth;
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i) - whitewidth, ogy - whitewidth);
			
			ctx.strokeStyle = "rgb(250, 250, 250)";
			ctx.lineWidth = whitewidth;
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i) + whitewidth, ogy + whitewidth);
			
			ctx.strokeStyle = "rgb(250, 250, 250)";
			ctx.lineWidth = whitewidth;
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i) - whitewidth, ogy + whitewidth);
			
			ctx.strokeStyle = "rgb(250, 250, 250)";
			ctx.lineWidth = whitewidth;
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i) + whitewidth, ogy - whitewidth);
			
			// Black Outline
			
			// -- //
			
			ctx.strokeStyle = "rgb(0, 0, 0)";
			ctx.lineWidth = blackwidth;
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i) - blackwidth, ogy - blackwidth);
			
			ctx.strokeStyle = "rgb(0, 0, 0)";
			ctx.lineWidth = blackwidth;
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i) + blackwidth, ogy + blackwidth);
			
			ctx.strokeStyle = "rgb(0, 0, 0)";
			ctx.lineWidth = blackwidth;
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i) + blackwidth, ogy - blackwidth);
			
			ctx.strokeStyle = "rgb(0, 0, 0)";
			ctx.lineWidth = blackwidth;
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i) - blackwidth, ogy + blackwidth);
			
			// Blue outline
			
			ctx.strokeStyle = "rgb(26, 61, 122)";
			ctx.lineWidth = "5";
			ctx.font = "86pt mono45-headline";
			ctx.strokeText(title[i], ogx + (offset * i), ogy);
			
			// Gradient inner
			
			ctx.font = "86pt mono45-headline";
			ctx.fillStyle = my_gradient;
			ctx.fillText(title[i], ogx + (offset * i), ogy);
			
		}
		
		// Sub-messages
		
		ctx.font = "bold 18pt Arial";
		ctx.fillStyle = "white";
		ctx.fillText("THE WORLD'S", 175, 90);
		
		ctx.font = "bold 18pt Arial";
		ctx.fillStyle = "white";
		ctx.fillText("VERSION 2.0", 675, 210);
		
	}
}

function loadingbar(ctx) {
	
	this.beginScreen = beginScreen.construct();
	this.beginButton = beginButton.construct();
	this.yousuckscreen = yousuckscreen.construct();
	
	//this.yousuckscreen.draw(ctx);
	
	this.beginScreen.draw(ctx);
	
	ctx.font = "8pt Arial";
	ctx.fillStyle = "white";
	ctx.fillText("This is the world's hardest game. It is harder than any game you have ever played, or ever will play.", 258, 380);
	
	ctx.fillStyle = "white";
	ctx.fillRect(250, 350, 500, 15);
	
	/*var my_gradient = ctx.createLinearGradient(0, 0, 251, 337);
	my_gradient.addColorStop(0, "rgb(0, 128, 0)");
	my_gradient.addColorStop(1.0, "rgb(0, 250, 0)");
	//my_gradient.addColorStop(1.0, "rgb(0, 180, 0)");
	ctx.fillStyle = my_gradient;*/

	var width = 0;
	var id = setInterval(load, 20);
	function load(){
		
		this.beginScreen.draw(ctx);
		
		ctx.font = "8pt Arial";
		ctx.fillStyle = "white";
		ctx.fillText("This is the world's hardest game. It is harder than any game you have ever played, or ever will play.", 258, 380);
		
		ctx.fillStyle = "white";
		ctx.fillRect(250, 350, 500, 15);
		
		if (width < 100) {
			
			++ width;
			
			ctx.fillStyle = "darkgreen";
			ctx.fillRect(251, 351, 498 * (width / 100), 13);
			
			ctx.fillStyle = "green";
			ctx.fillRect(253, 354, 494 * (width / 100), 5);
			
		} else {
			DONELOADING = true;
			this.beginScreen.draw(ctx);
			this.beginButton.draw(ctx, beginScreen, yousuckscreen);
			clearInterval(id);
		}
	}
}

function beginButton(ctx, beginScreen, yousuckscreen) {
	
	this.beginScreen = beginScreen;
	this.yousuckscreen = yousuckscreen;
	
	this.draw = function(ctx){
		
		var canvasx = 0;
		var canvasy = 0;
		
		var canvaswidth = 1000;
		var canvasheight = 490;
		
		var canvasmousex = 0;
		var canvasmousey = 0;
		
		var canvasmousedownx = 0;
		var canvasmousedowny = 0;
		
		var my_gradient;
		
		var id = setInterval(waitforclick, 20);
		function waitforclick(){
			
			this.beginScreen.draw(ctx);
			
			canvasx = window.innerWidth - canvaswidth;
			canvasx = canvasx / 2;
			
			//canvasy = window.innerHeight - canvasheight;
			//canvasy = canvasy / 3;
			canvasy = 300;
			
			canvasmousex = MOUSEX - canvasx;
			canvasmousey = MOUSEY - canvasy;
			
			canvasmousedownx = MOUSEDOWNX - canvasx;
			canvasmousedowny = MOUSEDOWNY - canvasy;
			
			if ( inrange(canvasmousex, 390, 610) && inrange(canvasmousey, 280, 360) ) {
				
				my_gradient = ctx.createLinearGradient(500, 350, 500, 300);
				my_gradient.addColorStop(0, "rgb(155, 155, 155)");
				my_gradient.addColorStop(1.0, "rgb(255, 255, 255)");
				ctx.fillStyle = my_gradient;
				
				ctx.font = "Bold 42pt Arial";
				//ctx.fillStyle = "gray";
				ctx.fillText("BEGIN", 410, 360);
				
				if ( inrange(canvasmousedownx, 390, 610) && inrange(canvasmousedowny, 280, 360) ) {
					BEGINCLICKED = true;
					//SOUNDS[2].play();
					clearInterval(id);
					this.yousuckscreen.draw(ctx);
					//startGame();
				}
				
			} else {
				
				my_gradient = ctx.createLinearGradient(500, 350, 500, 300);
				my_gradient.addColorStop(0, "rgb(221, 221, 221)");
				my_gradient.addColorStop(0.2, "rgb(255, 255, 255)");
				ctx.fillStyle = my_gradient;
				
				ctx.font = "Bold 42pt Arial";
				//ctx.fillStyle = "white";
				ctx.fillText("BEGIN", 410, 360);
			}
			
		}
	}
}

function yousuckscreen() {
	
	this.draw = function(ctx) {
		
		var my_gradient = ctx.createLinearGradient(0, 490, 0, 0);
		my_gradient.addColorStop(0, "rgb(175, 177, 254)");
		my_gradient.addColorStop(1.0, "rgb(232, 233, 254)");
		
		ctx.fillStyle = my_gradient;
		ctx.fillRect(0, 0, 1000, 490);
		
		ctx.font = "Bold 30pt Arial";
		ctx.fillStyle = "black";
		ctx.fillText("YOU DON'T STAND A CHANCE.", 200, 230);
		
		var waitseconds = 0;
		var wait = setInterval(waityousuck, 20);
		function waityousuck() {
			
			if (waitseconds < 2) {
				waitseconds += 0.02;
			} else {
				SOUNDS[2].play();
				clearInterval(wait);
				startGame();
			}
		}
		
	}
	
}

function square(x, y, size, speed){
	this.x = x,
	this.y = y,
	this.size = size,
	this.speed = speed,
	this.playersize = 32,
	this.tempx = x,
	this.tempy = y,
	this.xgood = false,
	this.ygood = false,
	this.alpha = 1.0,
	this.draw = function(ctx){
		
		this.xgood = false;
		this.ygood = false;
		
		ctx.beginPath();
		ctx.fillStyle = "red";
		ctx.fillRect(this.x, this.y, this.size, this.size);
		
		ctx.strokeStyle = "black";
		ctx.lineWidth = "4";
		ctx.rect(this.x, this.y, size - 2, size - 2);
		ctx.stroke();
		//ctx.lineWidth = "0";
		
		//ctx.fillStyle = "black";
		//ctx.fillText("X: " + this.x, 100, 280);
		//ctx.fillText("Y: " + this.y, 100, 250);
		
		if ( !playerDead && !hasWon ) {
			if (ArrowUp) {
				this.tempy = (this.y - this.speed);
			} else if (ArrowDown) {
				this.tempy = (this.y + this.speed);
			}

			if (ArrowLeft) {
				this.tempx = (this.x - this.speed);
			} else if (ArrowRight) {
				this.tempx = (this.x + this.speed);
			}
			
			if ( !onwall(this.x, this.tempy, this.playersize) ) {
				this.ygood = true;
			}
			
			if ( !onwall(this.tempx, this.y, this.playersize) ) {
				this.xgood = true;
			}
			
			if ( this.xgood ) this.x = this.tempx;
			if ( this.ygood ) this.y = this.tempy;
			
			this.tempx = 0;
			this.tempy = 0;
			
			oncoin(this.x, this.y, this.playersize);
			onball(this.x, this.y, this.playersize);
		}
		
		if ( onfinishline(this.x, this.y, this.playersize) && allcoinscollected() ) {
			hasWon = true;
			alert("You Made It!");
			deaths = 0;
			document.querySelector('p > span:nth-child(4) > span').innerHTML = 0;
			
			startGame();
		}
		
		
	},
	this.disappear = function(ctx){
		if ( this.alpha > 0 ) {
			this.alpha -= 0.05;
			ctx.globalAlpha = this.alpha;
		}
		
		ctx.beginPath();
		ctx.fillStyle = "red";
		ctx.fillRect(this.x, this.y, this.size, this.size);
		
		ctx.strokeStyle = "black";
		//ctx.lineWidth = "4";
		ctx.rect(this.x, this.y, size - 2, size - 2);
		ctx.stroke();
		//ctx.lineWidth = "0";
		
		ctx.fillStyle = "black";
		ctx.globalAlpha = 1.0;
		
		if ( this.alpha <= 0.0 ) {
			
			playerDead = false;
			++ deaths;
			
			document.querySelector('p > span:nth-child(4) > span').innerHTML = deaths;
			
			startGame();
		}
	}
}

function ball(name, x, y, radius, speed, color){
    this.name = name,
    this.x = x,
    this.y = y,
    this.radius = radius,
    this.speed = speed,
    this.color = color,
    this.animate = function(ctx){
        //Draw ball
		ctx.beginPath();
		ctx.lineWidth = "3";
        ctx.fillStyle = this.color;

        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2, true);
        ctx.fill()

        //Animate
        var wall = SCREENS.screen3.gameCenterWall;        
        if (this.y - this.radius + this.speed < wall.top
         || this.y + this.radius + this.speed > wall.bottom){
          this.speed = -this.speed;
        }
        this.y += this.speed
    },
	this.updateposition = function(i){
		ballPositions[i][1] = this.y;
	}
}

function coin(name, x, y, radius, speed, color, radiusstart){
    this.name = name,
    this.x = x,
    this.y = y,
    this.radiusx = radiusstart,
	this.radiusy = radius,
    this.speed = speed,
    this.color = color,
    this.animate = function(ctx){
		
		ctx.beginPath();

		ctx.ellipse(this.x, this.y, this.radiusx, this.radiusy, 0, 0, 2 * Math.PI);
		ctx.fillStyle = this.color;
		ctx.fill();
		ctx.stroke();
		
		if (this.radiusx == this.radiusy || this.radiusx + this.speed <= 0) {
			this.speed = -this.speed;
		}
		
		this.radiusx += this.speed;
		
    }
}

//------------------------------------------------------------------------------------------

function onfinishline(x, y, size){
	this.playerx = x,
	this.playery = y,
	this.playersize = size
	
	if ( this.playerx > 705 ) {
		return true;
	} else return false;
	
}

function allcoinscollected(){
	
	for (var i = 0; i < coinsTaken.length; ++ i){
		if ( coinsTaken[i] == false ) return false;
	}
	
	return true;
	
}

function onball(x, y, size){
	this.playerx = x,
	this.playery = y,
	this.playersize = size
				
	for (var i = 0; i < ballPositions.length; i ++){
		
		var validx = false;
		for (var k = this.playerx; k < this.playerx + this.playersize; k ++){
			if ( inrange(k, this.ballPositions[i][0] - this.ballPositions[i][2], this.ballPositions[i][0] + this.ballPositions[i][2]) ) {
				validx = true;
			}
		}
		
		var validy = false;
		for (var k = this.playery; k < this.playery + this.playersize; k ++){
			if ( inrange(k, this.ballPositions[i][1] - this.ballPositions[i][2], this.ballPositions[i][1] + this.ballPositions[i][2]) ) {
				validy = true;
			}
		}
		
		if ( validx && validy ) {
			playerDead = true;
			SOUNDS[0].play();
		}
		
	}
}

function onwall(x, y, size){
	this.potentialx = x,
	this.potentialy = y,
	this.size = size
	
	if ( inrange(this.potentialx, 216, 381) && inrange(this.potentialy, 144, 282) ){
		return false;
	}
	
	else if ( inrange(this.potentialx, 381, 603) && inrange(this.potentialy, 102, 321) ) {
		return false;
	}
	
	else if ( inrange(this.potentialx, 603, 774) && inrange(this.potentialy, 144, 282) ) {
		return false;
	}
	
	else return true;
}

function oncoin(x, y, size){
	this.playerx = x,
	this.playery = y,
	this.playersize = size,
    this.coins = [ coin.construct(COINS.pair1.coin1),
                   coin.construct(COINS.pair1.coin2),
				   coin.construct(COINS.pair1.coin3)
                ];
				
	for (var i = 0; i < this.coins.length; i ++){
		
		var validx = false;
		for (var k = this.playerx; k < this.playerx + this.playersize; k ++){
			if ( inrange(k, this.coins[i].x - this.coins[i].radiusx, this.coins[i].x + this.coins[i].radiusx) ) {
				validx = true;
			}
		}
		
		var validy = false;
		for (var k = this.playery; k < this.playery + this.playersize; k ++){
			if ( inrange(k, this.coins[i].y - this.coins[i].radiusy, this.coins[i].y + this.coins[i].radiusy) ) {
				validy = true;
			}
		}
		
		if ( validx && validy ) {
			
			if ( !coinsTaken[i] ) {
				
				SOUNDS[1].play();
				coinsTaken[i] = true;
				console.info(coinsTaken[i]);
				
			}
		}
		
	}
	
}

function inrange(value, lower, upper){
	this.value = value,
	this.lower = lower,
	this.upper = upper
	
	if ( this.value >= lower && this.value <= upper ) {
		return true;
	} else return false;
	
}

function checkKeys() {
	
	if (ControlKey && PKey) {
		PAUSED = !PAUSED;
		
		if (PAUSED) {
			document.querySelector('p').children[1].innerHTML = "<span>UN<u>P</u>AUSE</span>";
		} else document.querySelector('p').children[1].innerHTML = "<span><u>P</u>AUSE</span>";
		
		//ControlKey = false;
		PKey = false;
		
	}
	
	if (ControlKey && MKey) {
		MUTED = !MUTED;
		
		if (MUTED) {
			document.querySelector('p').children[2].innerHTML = "<span>UN<u>M</u>UTE</span>";
		} else document.querySelector('p').children[2].innerHTML = "<span><u>M</u>UTE</span>";
		
		for (var i = 0; i < SOUNDS.length; ++ i) {
			SOUNDS[i].muted = MUTED;
		}
		
		//ControlKey = false;
		MKey = false;
		
	}
	
}

//---------------------------------------------------------

function update() {
	if (!PAUSED) {
		game.clear();
		
		bkrnd.draw();
		
		obs.animate();
		cns.animate();
		
		plr.draw();
		
		checkKeys();
	} else {
		checkKeys();
	}
}








