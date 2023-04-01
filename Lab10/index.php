	<?php

	session_start();

	if (isset($_SESSION['username'])) {
		// If the user is already logged in, forward to the catalogue page
		header("Location: catalogue.php");
		exit();
	}

	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$valid_users = array(
			'user1' => 'user1@123',
			'user2' => 'user2@123',
			'user3' => 'user3@123'
		);

		// Validate the credentials against the user table in the database
		if (isset($valid_users[$username]) && $valid_users[$username] == $password) {
			// If the credentials are correct, start a session
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['cart'] = array(); // Create an empty cart
			header("Location: catalogue.php"); // Forward to the catalogue page
			exit();
		} else {
			echo "Invalid username or password.";
		}
	}
	?>


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login Page</title>
		<style>
			body {
				font-family: Arial, Helvetica, sans-serif;
			}

			h2 {
				text-align: center;
			}

			form {
				width: 30%;
				margin: 0 auto;
			}

			input {
				width: 100%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				box-sizing: border-box;
			}

			input[type=submit] {
				background-color: #4CAF50;
				color: white;
				border: none;
			}

			input[type=submit]:hover {
				opacity: 0.8;
			}

			.container {
				padding: 16px;
			}
		</style>
	</head>

	<body>

		<h2>Login Page</h2>
		<form method="post">
			Username: <input type="text" name="username"><br> <br>
			Password: <input type="password" name="password"><br> <br>
			<input type="submit" value="Login" name="login">
		</form>

	</body>

	</html>

