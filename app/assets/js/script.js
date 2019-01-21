$(document).ready( () => {

	// main body fadeIn
	$("#main_body").fadeIn(300);

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
		event.stopPropagation();

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
						$("#email").next().html(data);
						window.location.replace("../../index.php")
					}					
				}
			})
			//end registration
		}
	}) // end register

	// login button
	$("#login").click(function(e) {
		e.preventDefault()
		e.stopPropagation();

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
					window.location.replace(document.referrer);
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
				'item_quantity': item_quantity,
				'update_from_cart_page': 0
			},
			"success": (data) => {
				$("#cart-count").html(data);
			}
		})
	})

	function get_total() {
		let total = 0;
		$(".item_subtotal").each(function() {
			total += parseFloat($(this).html());
		});
		return parseFloat(total).toFixed(2);
	}

	// item quantity change/update
	$(".item_quantity>input").on("change", function(e) {
		let item_id = $(e.target).attr("data-id");
		let item_quantity = parseInt($(e.target).val());
		let price = parseFloat($(e.target).parent().prev().attr("price"));
		let subtotal = item_quantity * price;

		$(e.target).parent().next().html(parseFloat(subtotal).toFixed(2));

		$.ajax({
			"url": "../controllers/update_cart.php",
			"method": "POST",
			"data": {
				'item_id': item_id,
				'item_quantity': item_quantity,
				'update_from_cart_page': 1
			},
			"success": (data) => {
				$("#cart-count").html(data);				
				$("#total_price").html("&#165; " + get_total());
			}
		})
	})


	// remove from cart functionality
	$(document).on("click", ".remove-from-cart", function(e) {
		let item_id = $(e.target).attr("data-id");		

		$.ajax({
			"url": "../controllers/update_cart.php",
			"method": "POST",
			"data": {
				'item_id': item_id,
				'item_quantity': 0,
				'update_from_cart_page': 2
			},
			"beforeSend": () => {
				return confirm("Are you sure you want to delete?");
			},
			"success": (data) => {
				$(e.target).parents('tr').fadeOut();
				$("#cart-count").html(data);				
				$("#total_price").html("&#165; " + get_total());
			}
		})
	})

	// empty cart functionality
	$("#empty_cart").click(function(e) {
		$(e.target).parents('tfoot').prev().children('tr').remove();
		$(e.target).parents('tfoot').prev().html('<tr><td class="text-center" colspan="6"> No items in cart </td></tr>');

		$.ajax({
			"url": "../controllers/update_cart.php",
			"method": "POST",
			"data": {
				'update_from_cart_page': 3
			},
			"success": (data) => {
				$("#cart-count").html(0);				
				$("#total_price").html("&#165; " + get_total());
			}
		})
	})



	//submit profile form updates
	$("#update_info").click(function(e) {
		e.preventDefault();
		e.stopPropagation();

		let errors = 0;
		let firstname = $("#firstname").val();
		let lastname = $("#lastname").val();
		let email = $("#email").val();
		let address = $("#address").val();

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

		if (errors==0) {
			$("#update_user_details").submit();
		}
		
	})

	// change password validation
	function validate_change_password_form() {
		let errors = 0;
		let old_password = $("#old_password").val();
		let new_password = $("#new_password").val();
		let cnew_password = $("#cnew_password").val();

		// password valdation
		if (new_password.length < 8) {
			$("#new_password").next().html("Provide stronger password.");
			errors++;
		} else {
			$("#new_password").next().html("");
		}

		// confirm password validation
		if (new_password !== cnew_password) {
			$("#cnew_password").next().html("Passwords do not match.");
			errors++;
		} else {
			$("#cnew_password").next().html("");
		}

		if (errors==0) {
			return true;
		} else {
			return false;
		}

	}

	// change password
	$("#change_password_btn").click(function(e) {
		e.preventDefault();
		e.stopPropagation();

		console.log(validate_change_password_form());

		if (validate_change_password_form()) {

			let user_id = $("#old_password").prev().prev().val();
			let old_password = $("#old_password").val();
			let new_password = $("#new_password").val();	

			$.ajax({
				url: "../controllers/change_password.php",
				method: "POST",
				data: {
					"user_id": user_id,
					"old_password": old_password,
					"new_password": new_password
				},
				success: (data) => {
					if (data == "incorrect password") {
						$("#old_password").next().html("Incorrect password.");
					} else if (data == "correct password") {
						alert("Password successfully changed.")
						$("#old_password").next().html("");
						$("#old_password").val("");
						$("#new_password").val("");
						$("#cnew_password").val("");
					}
				}
			})
		}		
	})

	// forgot password
	$("#reset_password_btn").click(function(e) {
		e.preventDefault();
		e.stopPropagation();

			let username = $("#username").val();
			let firstname = $("#firstname").val();
			let lastname = $("#lastname").val();	
			let email = $("#email").val();

			$.ajax({
				url: "../controllers/reset_password.php",
				method: "POST",
				data: {
					"username": username,
					"firstname": firstname,
					"lastname": lastname,
					"email": email
				},
				success: (data) => {
					if (data === "fail") {
						$("#alert").html("No user found.");
						$("#alert").addClass("alert-danger");
						$("#alert").show();
					}else{
						$("#alert").html("Password reset successful");
						$("#alert").addClass("alert-success");
						$("#alert").show();
						$("#username").val("");
						$("#firstname").val("");
						$("#lastname").val("");
						$("#email").val("");

					}

				}
			})		
	})

	// delete item functionality
	$(document).on("click", ".delete-item", function(e) {
		let item_id = $(e.target).attr("data-id");
		let image_path = $(e.target).attr("data-path");

		$.ajax({
			"url": "../controllers/delete_item.php",
			"method": "POST",
			"data": {
				'item_id': item_id,
				'image_path': image_path
			},
			"beforeSend": () => {
				return confirm("Are you sure you want to delete this item?");
			},
			"success": (data) => {
				if (data == "") {
					$(e.target).parents('.item-card').fadeOut();
				} else {
					alert(data);
				}
			}
		})
	})

	// grant admin
	$(document).on("click", ".grant-admin", function(e) {
		let username = $(e.target).parent().siblings('.username').html();
		let roles_id = $(e.target).attr('roles_id');

		$.ajax({
			"url": "../controllers/grant_admin.php",
			"method": "POST",
			"data": {
				'username': username,
				'roles_id': roles_id
			},			
			"success": (data) => {
				if ($("#profile_link").html() == "Welcome, "+$(e.target).parent().siblings('.firstname').html()) {
					alert("You cannot change current admin's role.")
				} else {
					$(e.target).parent().siblings('.role').html(data);					
					$(e.target).toggle();
					$(e.target).siblings('.grant-admin').toggle();
					if ($(e.target).attr('roles_id') == 1) {
						$(e.target).attr('roles_id', 2);
						$(e.target).siblings('.grant-admin').attr('roles_id', 2);
					} else if ($(e.target).attr('roles_id') == 2) {
						$(e.target).attr('roles_id', 1);
						$(e.target).siblings('.grant-admin').attr('roles_id', 1);
					}		
				}	
			}
		})
	})


	// update order status
	// complete order
	$(document).on("click", ".complete-order", function(e) {
		let order_id = $(e.target).attr('order-id');
		$.ajax({
			"url": "../controllers/complete_order.php",
			"method": "POST",
			"data": {
				'order_id': order_id
			},
			"success": (data) => {
				$(e.target).parent().prev().html(data);
				$(e.target).parent().children().remove();
				$("#users_table").load(location.href+" #users_table>");
			}
		})
	})

	// cancel order
	$(document).on("click", ".cancel-order", function(e) {
		let order_id = $(e.target).attr('order-id');
		$.ajax({
			"url": "../controllers/cancel_order.php",
			"method": "POST",
			"data": {
				'order_id': order_id
			},
			"success": (data) => {
				$(e.target).parent().prev().html(data);
				$(e.target).parent().children().remove();
				$("#users_table").load(location.href+" #users_table>*","");
			}
		})
	})


	//------------------------------------------------------------------
	//------------------TEST-DYNAMIC-WEBPAGE-NAVBAR---------------------
	//------------------------------------------------------------------

	// $("#profile_link").click(function(e) {
	// 	e.preventDefault();
	// 	$("#sub_body").fadeOut(function() {
	// 		$("#sub_body").load("./profile2.php", function() {
	// 			$("#sub_body").fadeIn(300);
	// 		});
	// 	});		
	// })

	// $("#users_link").click(function(e) {
	// 	e.preventDefault();
	// 	$("#sub_body").fadeOut(function() {
	// 		$("#sub_body").load("./users2.php", function() {
	// 			$("#sub_body").fadeIn(300);
	// 		});
	// 	});		
	// })



})