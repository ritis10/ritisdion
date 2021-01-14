<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$name     = "";
$lastname = "";
$address  = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'auction');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$command = "SELECT MAX(id) AS max FROM users";
$rowSQL = mysqli_query($db, $command);
$row = mysqli_fetch_assoc($rowSQL);
$largestid = $row["max"];
$newid = $largestid+1;
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $address = mysqli_real_escape_string($db, $_POST['address']);
  $date = mysqli_real_escape_string($db, $_POST['date']);
  $category = mysqli_real_escape_string($db, $_POST['category']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($name)) {array_push($errors, "Name is required"); }
  if (empty($lastname)) {array_push($errors, "Lastname is required"); }
  if (empty($address)) {array_push($errors, "Address is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (empty($date)) { array_push($errors, "Date of Birth required"); }
  if (empty($category)) { array_push($errors, "Category is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = $password_1;//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, pass, first_name, last_name, dob, role, address, id, status)
  			  VALUES('$username', '$email', '$password', '$name', '$lastname', '$date', '$category', '$address', '$newid', 'disable')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}
