jQuery(document).ready(function($) {
	// $(".logout_form").modal({"backdrop":true});
	// setTimeout(function() {
	// 	$(".logout_form").modal('hide');
	// }, 1000);
	$(".login").click(function(event) {
		event.preventDefault();
		$(".login_form").modal();
	});
});