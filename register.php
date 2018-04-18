<?php

	session_start();
	require_once("database.php");

	$stmt = mysqli_prepare($con, "INSERT INTO users VALUES(?,?,?,?,?,?)");
	$stmt->bind_param("ssssss",$_POST["username"]
							,$_POST["password"],$_POST["namaperusahaan"]
							,$_POST["npwp"],$_POST["namadirektur"]
							,$_POST["alamat"]);
	$stmt->execute();

	if($stmt->error){
		Header("location:registrasi.php");
		return;
	}

	$_SESSION["username"] = $_POST["username"];
	Header("location:index.php");	
