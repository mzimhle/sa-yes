/**
 * General error display function. Shows an alert with the error.
 * 
 * @param jqXHR
 * @param textStatus error message
 */
function error(jqXHR, textStatus) {
	alert(jqXHR.responseText);
	alert("Error: " + textStatus);
}
