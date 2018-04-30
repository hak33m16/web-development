//////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/30/2018
//
/////////////////////////
//
//

// Checks if database has new messages for
// us, and if so, we'll display them to user.
function updateChat() {
	
}

// Only requires reading of the text-field
// because the current user is securely
// stored in the server $_SESSION
function sendMessage() {
	
	updateChat();
	$.ajax({
		
		type: "POST",
		url: "includes/db-submit-message.php",
		data: {  },
		dataType: "text", // Double check this
		success: function(data) {
			updateChat();
		}
		
	});
	
}