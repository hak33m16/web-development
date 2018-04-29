window.onload = function() {
$(function () {
	$("#createNewGroupButton").click(function () {
		var name = $("#groupName").val();
		window.location.replace("groups.php?newgroup=" + name);
		//alert("groups.php?newgroup=" + name);
	});
});
}