$(document).ready( () => {

	function validate_registration_form() {
		let errors = 0;
		let firstname = $("#firstname").val();
		let lastname = $("#lastname").val();
		let email = $("#email").val();
		let address = $("#address").val();
		let username = $("#username").val();
		let password = $("#password").val();
		let cpassword = $("#cpassword").val();

		// firstname validation
		if (firstname=="") {
			$("#firstname").next().html("First name is required.");
			errors++;
		} else {
			$("#firstname").next().html("")
		}

		// lastname validation
		if (lastname=="") {
			$("#lastname").next().html("Last name is required.");
			errors++;
		} else {
			$("#lastname").next().html("")
		}

		// email validation
		if (!email.includes("@") || !email.includes(".com")) {
			$("#email").next().html("Enter a valid email address.");
			errors++;
		} else {
			$("#email").next().html("")
		}

		// address validation
		if (address=="") {
			$("#address").next().html("Address is required.");
			errors++;
		} else {
			$("#address").next().html("")
		}

		// username validation
		if (username.length < 10) {
			$("#username").next().html("Username should be at least 10 characters.");
			errors++;
		} else {
			$("#username").next().html("");
		}

		// password valdation
		if (password.length < 8) {
			$("#password").next().html("Provide stronger password.");
			errors++;
		} else {
			$("#password").next().html("");
		}

		// confirm password validation
		if (password !== cpassword) {
			$("#cpassword").next().html("Passwords do not match.");
			errors++;
		} else {
			$("#cpassword").next().html("");
		}

		if (errors==0) {
			return true;
		} else {
			return false;
		}
	}
	
	// register button
	$("#register").click(function() {
		event.preventDefault()

		if(validate_registration_form()) {

			let errorFlag = false;
			let firstname = $("#firstname").val();
			let lastname = $("#lastname").val();
			let email = $("#email").val();
			let address = $("#address").val();
			let username = $("#username").val();
			let password = $("#password").val();
			let cpassword = $("#cpassword").val();

			$.ajax({
				url: "../controllers/create_user.php",
				method: "POST",
				data: {
					"firstname": firstname,
					"lastname": lastname,
					"email": email,
					"address": address,
					"username": username,
					"password": password
				},
				success: (data) =>  {
					if (data == "user_exists") {
						$("#username").next().html("Username already exists.");
					} else if (data == "email_exists") {
						$("#email").next().html("Email already exists.");
					} else {
						alert("user created");
						window.location.replace("../../index.php")
					}					
				}
			})
			//end registration

		}
	}) // end register

	// login button
	$("#login").click(function() {
		event.preventDefault()

		let username = $("#username").val();
		let password = $("#password").val();

		$.ajax ({
			url: "../controllers/authenticate.php",
			method: "POST",
			data: {
				"username": username,
				"password": password
			},
			success: (data) => {
				if (data == "Login failed") {
					$("#username").prev().prev().html("Invalid username/password");					
				} else {
					window.location.replace("../../index.php");					
				}
			}
		})


	}) // end login

	// prep for add to cart
	$(document).on("click", ".add-to-cart", function(e) {
		e.preventDefault();
		e.stopPropagation();

		let item_id = $(e.target).attr("data-id");
		let item_quantity = parseInt($(e.target).parent().prev().children().val());

		$.ajax({
			"url": "../controllers/update_cart.php",
			"method": "POST",
			"data": {
				'item_id': item_id,
				'item_quantity': item_quantity
			},
			"success": (data) => {
				$("#cart-count").html(data);
			}
		})


	})



})