<?php
function checkValid($data)
{
	if (strpos($data, "@") !== false)
		return false;
	return true;
}

function loginHandler($post_username, $post_password)
{
	if (!checkValid($post_password))
		return "Hack detected";  // You can not login as admin

	try {
		include("db.php");
		$database = make_connection("plaintext_db");

		$sql = "SELECT username FROM users WHERE username=LOWER('$post_username') AND password=LOWER('$post_password')";
		var_dump($sql);
		$query = $database->query($sql);
		var_dump($query);
		$user = $query->fetch_assoc(); // Get the first row

		if ($user === NULL)
			return "Wrong username or password"; // No result

		$username = $user["username"];
		if ($username === "admin")
			return "Wow you can log in as admin, here is your flag CBJS{FAKE_FLAG_FAKE_FLAG}, but how about <a href='level4.php'>THIS LEVEL</a>!";
		else
			return "You log in as $username, but then what? You are not an admin";
	} catch (mysqli_sql_exception $e) {
		return $e->getMessage();
	}
}

if (isset($_POST["username"]) && isset($_POST["password"])) {
	$post_username = $_POST["username"];
	$post_password = $_POST["password"];
	$message = loginHandler($post_username, $post_password);
}

include("static/html/login.html");