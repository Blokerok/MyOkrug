
$(document).ready(function () {

	/* INCLUDE MASK */

	$("input.phone-mask").mask("+7 (999) 999-99-99");


	/* VALIDATION INIT */

	$("form").each(function () {
		$(this).validate({
			submitHandler: function (form) {
				form.submit();
			},
			ignore: "[type=hidden]",
			errorPlacement: function (error, element) {
			},
			highlight: function (element, errorClass, validClass) {
				$(element).addClass(errorClass).removeClass(validClass);
				//$(element.form).find("label[for=" + element.id + "]").addClass(errorClass);
				//console.log(element);
				if ($(element).attr("type") == "checkbox" && $(element).parent("div").hasClass('jq-checkbox')) {
					$(element).parent("div").addClass(errorClass).removeClass(validClass);
				}
			},
			unhighlight: function (element, errorClass, validClass) {
				$(element).removeClass(errorClass).addClass(validClass);
				//$(element.form).find("label[for=" + element.id + "]").removeClass(errorClass);
				if ($(element).attr("type") == "checkbox" && $(element).parent("div").hasClass('jq-checkbox')) {
					$(element).parent("div").removeClass(errorClass).addClass(validClass);
				}
			},
			focusInvalid: false,
			focusCleanup: true
		});
	});

	$("form .required input, form input:required").each(function () {
		$(this).rules("add", { required: true, messages: { required: "" } });
	});

});

