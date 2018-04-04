<?php

	session_start();
	require_once("database.php");

	$stmt = mysqli_prepare($con, "INSERT INTO users VALUES(?,?,?,?)");
	$stmt->bind_param("ssss",$_POST["username"],$_POST["password"],$_POST["namaperusahaan"],$_POST["npwp"]);
	$stmt->execute();

	if($stmt->error){
		Header("location:registrasi.php");
		return;
	}

	$_SESSION["username"] = $_POST["username"];
	Header("location:index.php");	
