<?php 
	session_start();

	// Declare variables
	$username = "";
	$name = "";
	$email = "";
	$first_name = "";
	$last_name = "";
	$phone_number = "";
	$address = "";
	$city = "";
	$state = "";
	$zipcode = "";
	$card_type = "";
	$card_number = "";
	$cvc = "";
	$expiration_date = "";
	$usertype = "";
	$errors = array(); 
	$message = "";
	$_SESSION['success'] = "";

	// Database connection
	$db = mysqli_connect('localhost', 'OFS', 'sesame', 'OFS');

	// REGISTER CUSTOMER
	if (isset($_POST['reg_user'])) {

		// Fetch input values from registration form 
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

		// Form Validation
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($email)) { array_push($errors, "Email is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		// Check if passwords match
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// If no errors, proceed to register user
		if (count($errors) == 0) {

			// Encrypt password before saving into database
			$password = sha1($password_1);		
			$query = "INSERT INTO customer (user_id, username, email, password, user_type) 
					  VALUES(NULL, '$username', '$email', '$password', 'user')";
			$results = mysqli_query($db, $query);
			// print_r( $results );
			
			// if(mysqli_num_rows($results) == 1) {
			// 	$logged_in_user = mysqli_fetch_assoc($results);
			// 	$_SESSION['username'] = $logged_in_user['username'];
			// 	$_SESSION['success'] = "You are now logged in";
			// 	header('location: home.php');
			// } 

			// $_SESSION['username'] = $username;
			// $_SESSION['success'] = "You are now logged in";
			// header('location: home.php');
		}

		$check = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
		$checkResults = mysqli_query($db, $check);

		if (mysqli_num_rows($checkResults) == 1) {
			$user = mysqli_fetch_assoc($checkResults);
			if($user['user_type'] == 'Admin') {
				$_SESSION['username'] = $user;
				$_SESSION['success'] = "You are now logged in";
				header('location: adminHome.php');
			} else {
				$_SESSION['username'] = $user;
				$_SESSION['success']  = "You are now logged in";
				header('location: home.php');
			}
		}
	}

	// LOGIN CUSTOMER
	if (isset($_POST['login_user'])) {

		// Fetch input values from login form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		// Form validation
		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		// If no errors, proceed to register user
		if (count($errors) == 0) {

			// Encrypt password before saving into database
			$password = sha1($password);
			$query = "SELECT * FROM customer WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$logged_in_user = mysqli_fetch_assoc($results);
				if($logged_in_user['user_type'] == 'Admin') {
					$_SESSION['username'] = $logged_in_user;
					$_SESSION['success'] = "You are now logged in";
					header('location: adminHome.php');
				} else {
					$_SESSION['username'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: home.php');
				}
				// $_SESSION['username'] = $username;
				// $_SESSION['success'] = "You are now logged in";
				// header('location: home.php');
			} 
			else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['username'])) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['username']) && $_SESSION['username']['user_type'] == 'Admin' ) {
			return true;
		}else{
			return false;
		}
	}

	//CREATE PROFILE
	if (isset($_POST['create_profile'])) {

		// Fetch input values from create profile form
		$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$phone_number = mysqli_real_escape_string($db, $_POST['phone_number']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$city = mysqli_real_escape_string($db, $_POST['city']);
		$state = mysqli_real_escape_string($db, $_POST['state']);
		$zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);
		$card_number = mysqli_real_escape_string($db, $_POST['card_number']);$card_type = mysqli_real_escape_string($db, $_POST['card_type']);
		$cvc = mysqli_real_escape_string($db, $_POST['cvc']);
		$expiration_date = mysqli_real_escape_string($db, $_POST['expiration_date']);
		
		// Form Validation
		if (empty($first_name)) { array_push($errors, "First name is required"); }
		if (empty($last_name)) { array_push($errors, "Last name is required"); }
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($phone_number)) { array_push($errors, "Phone number is required"); }
		if (empty($city)) { array_push($errors, "City name is required"); }
		if (empty($address)) { array_push($errors, "Street address is required"); }

		$result = mysqli_query($db, "SELECT * FROM customer_profile WHERE username='$username'");

		if(mysqli_num_rows($result) == 0)
		{
			// If no errors, proceed to create user profile
			if (count($errors) == 0) {

				$query = "INSERT INTO customer_profile (customer_id, first_name, last_name, username, phone_number, address, city, state, zipcode, card_type, card_number, cvc, expiration_date) 
						  VALUES(NULL, '$first_name', '$last_name', '$username', '$phone_number', '$address', '$city', '$state', '$zipcode','$card_type', '$card_number', '$cvc', '$expiration_date');";
				mysqli_query($db, $query);

				header('location: profile.php');
			}
		}
		else
		{
			if (count($errors) == 0) {
				$query = "UPDATE customer_profile SET phone_number='$phone_number', address='$address', city='$city', state='$state', zipcode='$zipcode', card_type='$card_type', card_number='$card_number', cvc='$cvc', expiration_date='$expiration_date' WHERE username='$username';";
					mysqli_query($db, $query);

					header('location: profile.php');
			}
		}
	}

	if(isset($_POST['submit_contact'])) {
		
		$name = mysqli_real_escape_string($db, $_POST['name']);
		$message = mysqli_real_escape_string($db, $_POST['message']);

		if(count($errors) == 0) {
			$query = "INSERT INTO admin_contact(contact_id, name, message) 
					VALUES(NULL, '$name', '$message');";
			mysqli_query($db, $query);
			header('location: home.php');
		}
	}

	//UPDATE SHIPPING
	if (isset($_POST['shipping_update'])) {

		// Fetch input values from create profile form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$firstName = mysqli_real_escape_string($db, $_POST['first_name']);
		$lastName = mysqli_real_escape_string($db, $_POST['last_name']);
		$address = mysqli_real_escape_string($db, $_POST['address']);
		$city = mysqli_real_escape_string($db, $_POST['city']);
		$state = mysqli_real_escape_string($db, $_POST['state']);
		$zipcode = mysqli_real_escape_string($db, $_POST['zipcode']);

		$result = mysqli_query($db, "SELECT * FROM customer_profile WHERE username='$username'");
		// If no errors, proceed to create user profile
		if(mysqli_num_rows($result) == 1)
		{
			if (count($errors) == 0) 
			{
				
				$query = "UPDATE customer_profile SET first_name='$firstName', last_name='$lastName', address='$address', city='$city', state='$state', zipcode='$zipcode' WHERE username='$username';";
				mysqli_query($db, $query);

				header('location: shipping.php');
			}
		}
		else
		{
   			$first_name = $_POST['first_name'];
   			$last_name = $_POST['last_name'];
   			$query = "INSERT INTO customer_profile (customer_id, first_name, last_name, username, phone_number, address, city, state, zipcode) 
					  VALUES(NULL, '$first_name', '$last_name', '$username', '$phone_number', '$address', '$city', '$state', '$zipcode');";
			mysqli_query($db, $query);

			header('location: shipping.php');
		}
	}
	
	/*
	//UPDATE SHIPPING
	if (isset($_POST['payment_update'])) 
	{
		
		$result = mysqli_query($db, "SELECT * FROM customer_profile WHERE username='$username' AND card_number=NULL");
		if (mysqli_num_rows($result) == 0)
		{
		// Fetch input values from create profile form
			$card_number = mysqli_real_escape_string($db, $_POST['card_number']);
			$card_type = mysqli_real_escape_string($db, $_POST['card_type']);
			$cvc = mysqli_real_escape_string($db, $_POST['cvc']);
			$expiration_date = mysqli_real_escape_string($db, $_POST['expiration_date']);
		}
		else
		{
			$card_number = $_POST['card_number'];
			$card_type = $_POST['card_type'];
			$cvc = $_POST['cvc'];
			$expiration_date = $_POST['expiration_date'];
		}

			$query = "UPDATE customer_profile SET card_type='$card_type', card_number='$card_number', cvc='$cvc', expiration_date='$expiration_date' WHERE username='$username';";
			echo $query;
			mysqli_query($db, $query);

			header('location: payment.php');
	}
	*/

	
	

	

?>