


$('#pass, #rep-pass').on('keyup', function () {
	var password = $("#pass").val();
    var confirmPassword = $("#rep-pass").val();
	if (password != confirmPassword)
	{
		$("#rep-pass").css("background-color", "#ffe6e6")
		$("#reg-but").attr("disabled", true)
		
	} else{
		$("#rep-pass").css("background-color", "#e6ffe6")
		$("#reg-but").attr("disabled", false)
	}
	
	
	
	 
 });
 
