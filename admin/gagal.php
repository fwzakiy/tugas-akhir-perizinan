<?php

    session_start();
    require_once("../database.php");

    if(!isset($_SESSION["role"]) && $_SESSION["role"] != "admin"){
        Header("Location:index.php");
        return;
    }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LOGIN</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <div class="container"> 
    <form action="setuju.php" method="GET">
        <input type="hidden" name="status" value="2"/>
        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
        <div class="form-group">
            <label for="alasanInput">Masukkan Alasan Gagal : </label>
            <textarea class="form-control" name="alasan" id="alasanInput" rows="10"></textarea>
        </div>
        <button class="btn btn-primary" type="submit">Kirim</button>
    </form>
  </div>
</body>