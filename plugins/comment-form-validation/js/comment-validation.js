jQuery(function($) {
	var Container = $("<div class='error'>Please fill all the required fields</div>").appendTo("#commentform").hide();
	var LabelContainer = $("<div class='error errorlabels'></div>").appendTo("#commentform").hide();
	$("#commentform").validate({
		rules: {
			author: "required",
			email: {
				required: true,
				email: true
			},
			url: "url",
			comment: "required"
		},
		Container: Container,
		LabelContainer: LabelContainer,
		ignore: ":hidden"
	});
	$.validator.messages.required = "";
	$.validator.messages.email = "&raquo; " + $.validator.messages.email;
	$.validator.messages.url = "&raquo; " + $.validator.messages.url;
});