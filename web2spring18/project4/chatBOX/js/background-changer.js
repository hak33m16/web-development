    function getRandomColor() {
        
        var letters = '0123456789ABCDEF';
        var color = '#';
        
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        
        return color;
        
    }
    
    function getRandomEasing() {
        var number = Math.random();
        if ( number <= 0.50 ) {
            return "linear";
        }
        else if ( number <= 1.00 ) {
            return "swing";
        }
    }

    function animateBackground() {
        $('html').animate( {'background-color': getRandomColor()}, 5000, getRandomEasing());
    }
    
	$(document).ready(function(){

        animateBackground();
        setInterval( animateBackground, 5000 );
        
	});