window.onload = function() {
$(function () {
	$("#createNewGroupButton").click(function () {
		var name = document.getElementById("groupNameContainer").innerHTML;
		window.location.replace("groups.php?newgroup=" + name);
		alert("groups.php?newgroup=" + name);
	});
});
}