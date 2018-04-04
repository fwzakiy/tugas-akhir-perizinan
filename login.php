
<?php

	session_start();
	require_once("database.php");

	$stmt = mysqli_prepare($con, "SELECT username FROM users WHERE username = ? AND password = ? LIMIT 1");
	$stmt->bind_param("ss",$_POST["username"],$_POST["password"]);
	$stmt->execute();

	$result = $stmt->get_result();

	if($result->num_rows == 1){

		$_SESSION["username"] = $_POST["username"];
		$_SESSION["role"] = "user";
		header("Location:index.php");
		return;

	}

	header("Location:sign_in.php");

 ?>
