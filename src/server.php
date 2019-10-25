<?php
	include("config.php");
	session_start();

	$username = "";
	$errors = array();
	$_SESSION['success'] = "";

	// register users
	if (isset($_POST['register'])) {
		// receive all input values from the form
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password)) { array_push($errors, "Password is required"); }

		// check db to ensure user does not already exist
		$user_check_query = "SELECT * FROM users where username='$username' LIMIT 1";
		$result = mysqli_query($db, $user_check_query) or die("Failed");
		$user = mysqli_fetch_assoc($result);

		// query db to check if username is already taken
		if ($user) {
			if ($user['username'] == $username) {
				array_push($errors, "Username is taken");
			}
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, password)
					  VALUES('$username', '$password')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			header('location: src/login.php');
		}

	}

	// ...

	// LOGIN USER
	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);
			$role = mysqli_fetch_assoc($results);

			// check if admin
			if ($role['role'] == 'admin') {
				echo ("This is an admin account");
				$_SESSION['username'] = $_POST['username'];
				header('location: src/admin.php');
			} else if ($role['role'] == 'user' && mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				header('location: src/login.php');
			} else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

?>
