function encryptPassword() {
	var rawPassword 	= document.getElementById('rawPassword');
	var password 		= document.getElementById('password');
	password.value 		= md5(rawPassword.value);
	rawPassword.value 	= '';
}


window.onload = function() {
	$('input[type="datetime"]').datetimepicker();

    handleClientLoad();

};

