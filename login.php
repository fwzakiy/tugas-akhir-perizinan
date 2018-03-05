
<?php

	session_start();
	require_once("database.php");

	$stmt = mysqli_prepare($con, "SELECT username FROM users WHERE username = ? AND password = ? LIMIT 1");
	$stmt->bind_param("ss",$_POST["username"],$_POST["password"]);
	$stmt->execute();

	$result = $stmt->get_result();

	if($result->num_rows == 1){


		$username = $result->fetch_assoc();
		echo json_encode($username);

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
</head>
<body>

	    <form action="login.php" method="POST">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username" autofocus required/>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required/>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Log In</button>
        </div>
      </div>
    </form>


</body>
</html>

