<?php

    session_start();
    if(!isset($_SESSION["role"])){
        Header("location:sign_in.php");
        return;
    }

    require_once('database.php');

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
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <th>#</th>
            <th>Nama Permohonan</th>
            <th>Status</th>
        </thead>
        <tbody>
            <?php

                $query = "SELECT permohonan_id, nama_permohonan, status_permohonan FROM permohonan";
                if ($_SESSION["role"] === "user"){
                    $query .= " WHERE username = ?";
                    $stmt = mysqli_prepare($con,$query);
                    $stmt->bind_param("s",$_SESSION["username"]);
                }else{
                    $stmt = mysqli_prepare($con,$query);
                }

                $stmt->execute();
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $i = 1;
                array_map(function($value) use (&$i){
                    $permohonan_id = $value['permohonan_id'];
                    $show = "<tr>
                        <td>".$i++."</td>
                        <td><a href='permohonan.php?id=$permohonan_id'>".$value['nama_permohonan']."</a></td>
                        ";

                    if($value["status_permohonan"] == 0){
                        $status = "menunggu";
                    }else if ($value["status_permohonan"] == 1){
                        $status = "berhasil";
                    }else{
                        $status = "gagal";
                    }
                    
                    if($_SESSION["role"] == "admin" && $value["status_permohonan"] == 0){
                        $show .= "<td>
                                <a href='admin/setuju.php?id=$permohonan_id&status=1' class='btn btn-primary'>Setuju</a>
                                <a href='admin/gagal.php?id=$permohonan_id' class='btn btn-danger'>Tidak Setuju</a>
                            </td>";
                    } else{
                        $show .= "<td>
                            $status
                        </td>"; 
                    }
                    
                    $show .= "</tr>";
                        
                    echo $show;

                },$result);
            ?>
        </tbody>
    </table>
    <?php
        if($_SESSION["role"] == "user"){
    ?>

    <form action="ajukan_permohonan.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="namapermohonanInput">Nama Permohonan</label>
            <input type="text" required class="form-control" name="permohonan" id="namapermohonanInput"/>
        </div>
        <div class="form-group">
            <label for="jenispermohonanInput">Jenis Permohonan</label>
            <select name="jenis_permohonan" id="jenispermohonanInput" class="form-control">
                <option value="eksplorasi">Eksplorasi</option>
                <option value="produksi">Operasi Produksi</option>
            </select>              
        </div>
        <?php
            $stmt = mysqli_prepare($con,"SELECT jenis_file FROM jenis_file");
            $stmt->execute();

            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            array_map(function($value){
                $id_file = $value['jenis_file'];
                $nama_file = ucwords(str_replace('_',' ',$id_file));

                echo '<div class="form-group">
                    <label for="'.$id_file.'Input">Dokumen '.$nama_file.'</label>
                    <input type="file" accept="application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword" required class="form-control" name="'.$id_file.'" id="'.$id_file.'Input"/>
                </div>';
            },$result);
        ?>
        <button type="submit" class="btn btn-primary">Tambah Permohonan</button>
    </form>

    <?php
        }
    ?>
  </div>

</body>
</html> 