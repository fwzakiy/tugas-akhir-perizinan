<?php

	session_start();
	require_once("database.php");
	if(!isset($_SESSION["role"])){
		Header("location:sign_in.php");
		return;
	}
	$stmt = mysqli_prepare($con,"SELECT * FROM permohonan WHERE permohonan_id = ? AND username = ? LIMIT 1");
	$stmt->bind_param("is",$_GET["id"],$_SESSION["username"]);
	$stmt->execute();

	$result = $stmt->get_result()->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Permohonan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
<body>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<div class="container"> 
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Permohonan</li>
			</ol>
		</nav>
		<table>
			<tr>
				<td>Nama Permohonan</td>
				<td style="padding-left:20px"></td>
				<td> : </td>
				<td><?php echo $result["nama_permohonan"];	?></td>
			</tr>
			<tr>
				<td>Jenis Permohonan</td>
				<td></td>
				<td> : </td>
				<td><?php echo $result["jenis_permohonan"]; ?></td>
			</tr>
			<tr>
				<td>Status Permohonan</td>
				<td></td>
				<td> : </td>
				<td><?php
				
					if($result["status_permohonan"] === 0) echo "menunggu";
					else if($result["status_permohonan"] === 1) echo "berhasil";
					else echo "gagal"; 
				
				?></td>
			</tr>
			<?php

				if($result["status_permohonan"] === 2){
					echo "<tr>
						<td>Alasan Gagal</td>
						<td></td>
						<td> : </td>
						<td>".$result["alasan"]."</td>
					</tr>";
				}

				$stmt = mysqli_prepare($con,"SELECT * FROM files WHERE permohonan_id = ?");
				$stmt->bind_param("i",$_GET["id"]);
				$stmt->execute();
		
				$files = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		
				$showFile = function($val){
					$nama_file = "Dokumen ".ucwords(str_replace('_',' ',$val["jenis_file"]));
					$url_file = "files/".$val["permohonan_id"]."_".$val["jenis_file"].".".$val["extension"];
					echo "<tr>
						<td>".$nama_file."</td>
						<td></td>
						<td> : </td>
						<td><a href='".$url_file."'>Download</a></td>
					</tr>";
				};

				array_map($showFile,$files);
				
			?>
		</table>
		<?php
			if($result["status_permohonan"] == 2){
				echo '<a href class="btn btn-primary">Ulang Permohonan</a>';
			}
		?>
	</div>

</body>
</html>