/*
    Kent State University
    CS 44105/54105 Web Programming I
    Fall 2017
    Assignment 3
    The World’s Hardest Game 2 Remake
    helper.js
    Author 1: Abdulkareem Alali, aalali1@kent.edu
    Author 2: Abdel-Hakeem Badran, abadran@kent.edu
*/

Function.prototype.construct = function(argArray) { 
    //Unpacks arrays into a constructor arguments
    var constr = this;
    var inst = Object.create(constr.prototype);
    constr.apply(inst, argArray);
    return inst;
};

window.addEventListener("load", function(){

	var newStyle = document.createElement('style');
	newStyle.appendChild(document.createTextNode('@font-face {font-family: mono45-headline;src: url("https://use.typekit.net/af/2242e8/00000000000000003b9afa2a/27/l?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n5&v=3") format("woff2"),url("https://use.typekit.net/af/2242e8/00000000000000003b9afa2a/27/d?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n5&v=3") format("woff"),url("https://use.typekit.net/af/2242e8/00000000000000003b9afa2a/27/a?primer=7cdcb44be4a7db8877ffa5c0007b8dd865b3bbc383831fe2ea177f62257a9191&fvd=n5&v=3") format("opentype");'));

	document.head.appendChild(newStyle);

	/*
	var el = document.querySelector('head');
	el.children[0].insertAdjacentHTML("afterEnd", "<link rel=\"stylesheet\" href=\"https://use.typekit.net/bes1ogx.css\">");*/
	
});