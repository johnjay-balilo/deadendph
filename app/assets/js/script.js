
$("#register").click( function validate_registration_form() {

			//username field is empty
			//username already exists
			//username is available
			//password field is empty
			//passwords did not match

			let errorFlag = false;
			const firstname = $("#firstname").val();
			const lastname = $("#lastname").val();
			const email = $("#email").val();
			const address = $("#address").val();
			const username = $("#username").val();
			const password = $("#password").val();
			const cpassword = $("#cpassword").val();

			// firstname
			if (firstname=="" || firstname==null) {
				$("#firstname").next().html("Please enter firstname");
				errorFlag = true;
			}else {
				$("#firstname").next().html("");
			}

			// lastname
			if (lastname=="" || lastname==null) {
				$("#lastname").next().html("Please enter lastname");
				errorFlag = true;
			}else {
				$("#lastname").next().html("");
			}

			// email
			if (email=="" || email==null) {
				$("#email").next().html("Please enter email");
				errorFlag = true;
			}else {
				$("#email").next().html("");
			}

			if (username == "") {
				$("#usererr").html("Please enter username");
				errorFlag = true;
			}else {
				$.ajax({
					method: 'POST',
					url: '../controllers/check_username.php',
					data: {username: username},
					async: false,
				}).done( data => {
					if (data == "taken") {
						$("#usererr").html("Username is taken");
						errorFlag = true;
					}else {
						$("#usererr").css('color', 'green');
						$("#usererr").css('background-color', 'lightgreen');
						$("#usererr").html("Username is available");
					}
				});
			}

			if (username == "") {
				$("#usererr").html("Please enter username");
				errorFlag = true;
			}else {
				$.ajax({
					method: 'POST',
					url: '../controllers/check_username.php',
					data: {username: username},
					async: false,
				}).done( data => {
					if (data == "taken") {
						$("#usererr").html("Username is taken");
						errorFlag = true;
					}else {
						$("#usererr").css('color', 'green');
						$("#usererr").css('background-color', 'lightgreen');
						$("#usererr").html("Username is available");
					}
				});
			}

			if (password=="" || password==null) {
				$("#passerr").html("Please enter password");
				errorFlag = true;
			}else {
				$("#passerr").html("");
				if (password!==cpassword) {
					$("#cpasserr").html("Passwords do not match");
					errorFlag = true;
				}
			}

			// if (cpassword=="" || cpassword==null) {
			// 	$("#cpasserr").html("Please confirm password");
			// 	errorFlag = true;
			// }else {
			// 	$("#cpasserr").html("");
				
			// }

			

			// submit form
			if (!errorFlag) {
				$("#register_form").submit();
			}

		});