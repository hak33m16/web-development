function scrollToNewMessage() {
	var mainMessagingBox = document.getElementById("message-container");
	var messages = mainMessagingBox.children;
	
	var lastMessage = messages[messages.length - 1];
    
    if ( lastMessage != undefined ) {
        var newPos = lastMessage.offsetTop;
        mainMessagingBox.scrollTop = newPos;
    }
}

function getParameterByName(name, url=false) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

$(function() {
    
    $('#actual-text-box').keydown( function(e) {
        
        if ( e.keyCode == 13 ) {
            
            // Stops them from entering a newline
            e.preventDefault();
            
            var message = $('#actual-text-box').val();
            $('#actual-text-box').val("");
            
            // Push to the database here?
            chat.sendMessage(message);
            
        }
        
    });
    
});

$( function() {
    
    var availableTags = [];
    
    $.ajax({
        type: "POST",
        url: "includes/db-chat-utility.php",
        data: { 'function': 'getChatState', 'groupid': 1 },
        dataType: "json",
        success: function(data) {
            
            data.forEach(function(element) {
                
                var email = element['email'];
                availableTags.push( "@" + email );
                
                // First push the full sentence
                var sentence = element['message'];
                availableTags.push( sentence );
                
                // Then each word in it
                var wordsRegex = /([^\x00-\x7F]|\w)+/g;
                
                var sentenceArray = sentence.match(wordsRegex);
                sentenceArray.forEach(function(element) {
                    availableTags.push(element);
                });
                
            });
            
            // Convert to set then back to array
            // to prevent duplicates.
            var tagSet = new Set( availableTags );
            availableTags = Array.from(tagSet);
            
            $( "#actual-text-box" ).autocomplete({
                source: availableTags,
                position: { my : "left top", at : "left bottom", collision : "none", collision : "none" },
                appendTo : "#auto-box"
            });
            
        }
    });

});

window.onload = function () {

}