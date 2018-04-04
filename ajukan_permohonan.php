<?php
	session_start();
	require_once("database.php");	

	$uploadFile = function ($filename,$p_id) use ($con){

	    // Undefined | Multiple Files | $_FILES Corruption Attack
		// If this request falls under any of them, treat it invalid.
	    if (
	        !isset($_FILES[$filename]['error']) ||
	        is_array($_FILES[$filename]['error'])
	    ) {
	        throw new RuntimeException('Invalid parameters.');
	    }

	    // Check $_FILES[$filename]['error'] value.
	    switch ($_FILES[$filename]['error']) {
	        case UPLOAD_ERR_OK:
	            break;
	        case UPLOAD_ERR_NO_FILE:
	            throw new RuntimeException('No file sent.');
	        case UPLOAD_ERR_INI_SIZE:
	        case UPLOAD_ERR_FORM_SIZE:
	            throw new RuntimeException('Exceeded filesize limit.');
	        default:
	            throw new RuntimeException('Unknown errors.');
	    }

	    // You should also check filesize here. 
	    if ($_FILES[$filename]['size'] > 1000000) {
	        throw new RuntimeException('Exceeded filesize limit.');
	    }

	    // DO NOT TRUST $_FILES[$filename]['mime'] VALUE !!
	    // Check MIME Type by yourself.
	    $finfo = new finfo(FILEINFO_MIME_TYPE);
	    if (false === $ext = array_search(
	        $finfo->file($_FILES[$filename]['tmp_name']),
	        array(
	            'pdf' => 'application/pdf',
	            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
	            'doc' => 'application/msword'
	        ),
	        true
	    )) {
	        throw new RuntimeException('Invalid file format.');
	    }

	    // You should name it uniquely.
	    // DO NOT USE $_FILES[$filename]['name'] WITHOUT ANY VALIDATION !!
	    // On this example, obtain safe unique name from its binary data.

	   	$destination = "files/".$p_id."_".$filename.".".$ext;
	    if (!move_uploaded_file(
	        $_FILES[$filename]['tmp_name'],
	        $destination
	    )) {
	        throw new RuntimeException('Failed to move uploaded file.');
	    }


	   	$stmt = mysqli_prepare($con,"INSERT INTO files VALUES (?,?,DEFAULT,?)");

		$stmt->bind_param("iss",$p_id,$filename,$ext);
		$stmt->execute();

		if($stmt->error){
			throw new RuntimeException($stmt->error);
		}

	};

	mysqli_autocommit($con,false);

	try {
		
		$stmt = mysqli_prepare($con, "INSERT INTO permohonan VALUES (DEFAULT,?,?,DEFAULT,DEFAULT,?,DEFAULT)");
		$stmt->bind_param("sss",$_POST["permohonan"],$_SESSION["username"],$_POST["jenis_permohonan"]);
		$stmt->execute();

		if($stmt->error){
			throw new RuntimeException($stmt->error);
		}

		$permohonan_id = $stmt->insert_id;

		$stmt = mysqli_prepare($con,"SELECT jenis_file FROM jenis_file");
		$stmt->execute();
		$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

		$upload = function($value) use($permohonan_id,$uploadFile){
			$uploadFile($value["jenis_file"],$permohonan_id);
		};


		array_map($upload,$result);
		mysqli_commit($con);
		header("Location:index.php");

	} catch (RuntimeException $e) {
		mysqli_rollback($con);
	    echo $e->getMessage();
	}

	mysqli_close($con);

