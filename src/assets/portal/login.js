jQuery(document).ready(function($) {

	$('#loginform input[type="text"]').attr('placeholder', 'Username');
	$('#loginform input[type="password"]').attr('placeholder', 'Password');

	$('#loginform label[for="user_login"]').contents().filter(function() {
		return this.nodeType === 3 || (this.nodeType == 1 && this.tagName == "BR");
	}).remove();
	$('#loginform label[for="user_pass"]').contents().filter(function() {
		return this.nodeType === 3 || (this.nodeType == 1 && this.tagName == "BR");
	}).remove();

});