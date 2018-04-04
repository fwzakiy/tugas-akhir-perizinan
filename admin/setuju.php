<?php

    session_start();
    require_once("../database.php");

    if(!isset($_SESSION["role"]) && $_SESSION["role"] != "admin"){
        Header("Location:index.php");
        return;
    }

    $status = $_GET["status"];
    $id_permohonan = $_GET["id"];

    if ($status == 1){
        $stmt = mysqli_prepare($con,"UPDATE permohonan SET status_permohonan = ? WHERE permohonan_id = ?");
        $stmt->bind_param("is",$status,$id_permohonan);    

    }else{
        $stmt = mysqli_prepare($con,"UPDATE permohonan SET status_permohonan = ? , alasan = ? WHERE permohonan_id = ?");
        $alasan = $_GET['alasan'];
        $stmt->bind_param("iss",$status,$alasan,$id_permohonan); 
        
    }
    
    $stmt->execute();
    Header("Location:../index.php");
