<?php

	require_once("database.php");

	$stmt = mysqli_prepare($con, "INSERT INTO users VALUES(?,?)");
	$stmt->bind_param("ss",$_GET["username"],$_GET["password"]);
	$stmt->execute();

	if($stmt->error){
		echo $stmt->error;
		return;
	}

	echo "Berhasil";