//////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/30/2018
//
/////////////////////////
//
//

//////////////////////////////////////
//
// The object that holds an instance
// of each of these functions.
//
// Our 'collection' or 'engine', if
// you will.
//

// Store an instance of our last known chat
// to tell us when we need to update our info.

var GLOBAL_RECENT_CHAT_ASSOC_ARRAY = [];

function Chat() {
    
    this.getChatState = getChatState;
    this.updateChat = updateChat;
    this.sendMessage = sendMessage;
    
}

// This function checks if we even need
// to refresh the chat box by validating
// the information we have vs database.
function getChatState() {
    
    //var result = [];
    
    var instance = false;
    if ( !instance ) {
        
        instance = true;
        
        $.ajax({
            type: "POST",
            url: "includes/db-chat-utility.php",
            data: { 'function': 'getChatState', 'groupid': getParameterByName("groupid") },
            dataType: "json",
            success: function(data) {
                
                if ( GLOBAL_RECENT_CHAT_ASSOC_ARRAY != undefined && GLOBAL_RECENT_CHAT_ASSOC_ARRAY.length != 0 ) {
                            
                    if ( GLOBAL_RECENT_CHAT_ASSOC_ARRAY['groupid'] != data[data.length - 1]['groupid']  ||
                         GLOBAL_RECENT_CHAT_ASSOC_ARRAY['ownerid'] != data[data.length - 1]['ownerid']  ||
                         GLOBAL_RECENT_CHAT_ASSOC_ARRAY['message'] != data[data.length - 1]['message']  ||
                         GLOBAL_RECENT_CHAT_ASSOC_ARRAY['time']    != data[data.length - 1]['time']            ) {
                        
                        //console.log("It's not empty.");
                        GLOBAL_RECENT_CHAT_ASSOC_ARRAY = data[ data.length - 1 ];
                        // Update the chat box with all of our new data
                        updateChat(data);
                        
                    }
                    
                    // If we make it here, the chat doesn't need updated. :)
                    
                } else {
                    
                    //console.log("It is empty.");
                    GLOBAL_RECENT_CHAT_ASSOC_ARRAY = data[ data.length - 1 ];
                    //console.log(GLOBAL_RECENT_CHAT_ASSOC_ARRAY);
                    updateChat(data);
                    
                }
                
                //console.log(data);
                instance = false;
                
            },
            error: function(data) {
                
                console.log("Looks like we ran into an error reading from the database.");
                console.log(data);

                result = null;
                instance = false;
                
            }
            
        });
        
    }
    
}

function sendMessage(message) {
    
    var instance = false;
    
    if ( !instance ) {
        
        instance = true;
        
        //alert( parseInt(Date.now() / 1000) );
        getChatState();
        $.ajax({
            type: "POST",
            url: "includes/db-chat-utility.php",
            data: { 'function': 'sendMessage', 'message': message, "groupid": getParameterByName("groupid"), "datetime": parseInt(Date.now() / 1000) },
            //dataType: "json",
            success: function(data) {
                
                
                // Tell ajax to refresh that shit, yo
                getChatState();
                instance = false;
                
            },
            error: function(data) {
                console.log("Looks like we ran into an error sending to database.");
                console.log(data);
                instance = false;
            }
        });
    
    }
}

function updateChat(data) {
    
    var mainMessagingBox = document.getElementById("message-container");
    mainMessagingBox.innerHTML = "";
    
    data.forEach(function(element) {
        mainMessagingBox.innerHTML += createMessageHTML(element);
    });
    
    // This function is found in the index-utilities.js file
    scrollToNewMessage();
    
}

function createMessageHTML(messageArray) {
    return "<div class=\"container-fluid individual-message-box\"><p class=\"individual-name\"><a href=\"#\">#" + messageArray['email'] + "</a> </p> | <p class=\"individual-time\">" + messageArray['time'] + "</p><p class=\"individual-message\">" + messageArray['message'] + "</p></div>";
}



/*
// Checks if database has new messages for
// us, and if so, we'll display them to user.
function updateChat() {
	
    if ( !instance ) {
        
        instance = true;
        
        $.ajax({
            type: "POST",
            url: "includes/db-chat-utility.php",
            data: { 'function': 'updateChat' },
            dataType: "json",
            success: function(data) {
                //result = data;
                console.log(data);
            }
        });
        
    }
    
}*/

/*
// Only requires reading of the text-field
// because the current user is securely
// stored in the server $_SESSION
function sendMessage(textfield) {
	
	updateChat();
	$.ajax({
		
		type: "POST",
		url: "includes/db-chat-utility.php",
		data: { 'message' : textfield },
		//dataType: "text", // Double check this
		success: function(data) {
			updateChat();
		}
		
	});
	
}

*/