$(document).ready(function() {
	$("#login-hide").click(function(e){
			e.preventDefault();
			$("#login-form-wrapper").slideUp("slow", function(){
					$("#register-form-wrapper").slideDown("slow");
			});
	});

	$("#register-show").click(function(e){
			e.preventDefault();
			$("#register-form-wrapper").slideUp("slow", function(){
					$("#login-form-wrapper").slideDown("slow");
			});
	});
});