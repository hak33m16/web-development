function scrollToNewMessage() {
	var mainMessagingBox = document.getElementById("message-container");
	var messages = mainMessagingBox.children;
	
	var lastMessage = messages[messages.length - 1];
	var newPos = lastMessage.offsetTop;
	mainMessagingBox.scrollTop = newPos;
}

window.onload = function () {
	scrollToNewMessage();
}