$("#signUpForm").on("submit", async function (e) {
	let isValid = true;

	let fnameValue = $("#fname").val().trim();
	if (fnameValue.length < 2) {
		$("#fname")
			.siblings("span")
			.text("Name must be at least 2 characters in length")
			.show();
		isValid = false;
	} else {
		$("#fname").siblings("span").hide();
	}

	let lnameValue = $("#lname").val().trim();
	if (lnameValue.length < 2) {
		$("#lname")
			.siblings("span")
			.text("Name must be at least 2 characters in length")
			.show();
		isValid = false;
	} else {
		$("#lname").siblings("span").hide();
	}

	let contactValue = $("#contact").val().trim();
	if (contactValue.length == 0) {
		$("#contact")
			.siblings("span")
			.text("Contact Number is required")
			.show();
		isValid = false;
	} else if (!containsOnlyNumbers(contactValue)) {
		$("#contact")
			.siblings("span")
			.text("Contact Number must only contain numbers")
			.show();
		isValid = false;
	} else if (contactValue.length < 11) {
		$("#contact")
			.siblings("span")
			.text("Contact Number must be 11 characters in length")
			.show();
		isValid = false;
	} else {
		$("#contact").siblings("span").hide();
	}

	let usernameValue = $("#username").val().trim();
	if (usernameValue === "") {
		$("#username")
			.siblings("span")
			.text("Username must not be empty.")
			.show();
		isValid = false;
	} else {
		$.ajax({
			url: "./includes/ajax/user_auth.php",
			type: "GET",
			data: {
				username: usernameValue,
			},
			success: function (res) {
				if (res == "true") {
					$("#username")
						.siblings("span")
						.text("Username already taken.")
						.show();
					isValid = false;
				} else {
					$("#username").siblings("span").hide();
				}
			},
		});
	}

	let emailValue = $("#email").val().trim();
	const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	const isValidEmail = emailRegex.test(emailValue);

	if (!isValidEmail) {
		$("#email").siblings("span").text("Email must be valid.").show();
		isValid = false;
	} else {
		$.ajax({
			url: "./includes/ajax/user_auth.php",
			type: "GET",
			data: {
				email: emailValue,
			},
			success: function (res) {
				if (res == "true") {
					$("#email")
						.siblings("span")
						.text("Email already taken.")
						.show();
					isValid = false;
				} else {
					$("#email").siblings("span").hide();
				}
			},
		});
	}

	let passwordValue = $("#password").val().trim();
	let confirmPass = $("#confirmPass").val().trim();

	if (passwordValue.length < 8) {
		$("#password")
			.siblings("span")
			.text("Password must be at least 8 characters in length")
			.show();
		isValid = false;
	} else if (passwordValue !== confirmPass) {
		$("#password").siblings("span").text("Passwords do not match.").show();
		$("#confirmPass")
			.siblings("span")
			.text("Passwords do not match.")
			.show();
		isValid = false;
	} else {
		$("#password").siblings("span").hide();
		$("#confirmPass").siblings("span").hide();
	}

	if (isValid) {
		$("#signUpForm").submit();
	} else {
		e.preventDefault();
	}
});

$("#username").on("input", function () {
	$.ajax({
		url: "./includes/ajax/user_auth.php",
		type: "GET",
		data: {
			username: $(this).val().trim(),
		},
		success: function (res) {
			if (res == "true") {
				$("#username")
					.siblings("span")
					.text("Username already taken.")
					.show();
				isValid = false;
			} else {
				$("#username").siblings("span").hide();
				isValid = true;
			}
		},
	});
});

$("#email").on("input", function () {
	$.ajax({
		url: "./includes/ajax/user_auth.php",
		type: "GET",
		data: {
			email: $(this).val().trim(),
		},
		success: function (res) {
			if (res == "true") {
				$("#email")
					.siblings("span")
					.text("Email already taken.")
					.show();
				isValid = false;
			} else {
				$("#email").siblings("span").hide();
				isValid = true;
			}
		},
	});
});

function containsOnlyNumbers(inputString) {
	return /^[0-9]+$/.test(inputString);
}

$(document).ready(() => {
	$(".password_visibility").on("click", (e) => {
		const target = $(e.target).attr("data-visibility");

		if (target === "invisible") {
			$('.password_visibility[data-visibility="invisible"]').hide();
			$('.password_visibility[data-visibility="visible"]').show();
			$("#password").prop("type", "text");
			$("#confirmPass").prop("type", "text");
		} else {
			$('.password_visibility[data-visibility="invisible"]').show();
			$('.password_visibility[data-visibility="visible"]').hide();
			$("#password").prop("type", "password");
			$("#confirmPass").prop("type", "password");
		}
		$(e.target).siblings("input").focus();
	});
});
