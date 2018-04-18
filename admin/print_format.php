<?php

    session_start();
    if(!isset($_SESSION["role"]) && $_SESSION["role"] !== "admin"){
        Header("location:index.php");
		return;
    }
    require_once("../database.php");
    $query = "SELECT users.username, nama_perusahaan, npwp_perusahaan, alamat_perusahaan,
                nama_direktur, jenis_permohonan FROM users JOIN permohonan
                ON users.username = permohonan.username WHERE permohonan_id = ? LIMIT 1";
    $stmt = mysqli_prepare($con,$query);
    $stmt->bind_param("i",$_POST["id"]);
    $stmt->execute();

    $result = $stmt->get_result()->fetch_assoc();

    $nomor = $_POST["nomorsurat"];
    $tipe = strtoupper($result["jenis_permohonan"]);
    $memperhatikan = $_POST["memperhatikan"];
    $nama_perusahaan = $result["nama_perusahaan"];
    $npwp_perusahaan = $result["npwp_perusahaan"];
    $alamat_perusahaan = $result["alamat_perusahaan"];
    $nama_directur_perusahaan = $result["nama_direktur"];
    $memutuskan = $_POST["memutuskan"];
    
    echo json_encode($_POST);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        .header{
            padding-top: 20px;
        }
        .header img{
            width:100%;
        }
        .bold_center{
            text-align: center;
            font-weight: bold;
        }
        .text_rapat p{
            margin-top: 0;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="kop.jpg"/>
    </div>

    <table class="container">
        <tr>
            <td colspan="3" class="bold_center">
                <p>KEPUTUSAN GUBERNUR SUMATERA BARAT</p>
                <div class="text_rapat">    
                    <p>NOMOR : <?php echo $nomor; ?></p>
                    <p>TENTANG</p>
                    <p>PERIZINAN IZIN <?php echo $tipe; ?> DI KOTA SAWAHLUNTO PROVINSI SUMATERA BARAT</p>
                </div>
                <p>GUBERNUR SUMATERA BARAT,</p>
            </td>
        </div>

        <tr>
            <td style="vertical-align:top">Menimbang</td>
            <td style="vertical-align:top"> : </td>
            <td><ol type="a">
                <li>bahwa berdasarkan Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah, Persetujuan Perpanjanagan dan Penciutan Wilayah Izin Usaha Pertambangan (IUP) Operaasi Produksi Batubara merupakan kewenangan Pemerintah Daerah Provinsi;</li>
                <li>bahwa berdasarkan hasil evaluasi oleh Dinas Energi Sumber Daya Mineral Provinsi Sumatera Barat, permohonan perpanjangan Izin Usaha Pertambangan (IUP) Operasi Produksi Batubara An. PT. Guguk Tinggi Coal telah memenuhi syarat untuk diproses sesuai dengan Peraturan Pemerintah Nomor 23 Tahun 2010 tentang Pelaksanaan kegiatan Usaha Pertambagan Mineral Dan Batubara;</li>
                <li>bahwa berdasarkan pertimbangan sebagaimana dimaksud dalam huruf a dan huruf b, perlu memberikan Persetujuan Perpanjangan Kedua dan Penciutan Wilayah Izin Usaha Pertambangan Operasi Produksi Batubara Kepada PT. Guguk Tinggi Coal di Kota Sawahlunto Provinsi Sumatera Barat dan menetapkannya dengan Keputusan Gubernur Sumatera Barat;</li>
            </ol></td>
        </tr>

        <tr>
            <td style="vertical-align:top">Mengingat</td>
            <td style="vertical-align:top"> : </td>
            <td><ol>
                <li>Undang-Undang Nomor 61 Tahun 1958 tentang Penetapan Undang-Undang Darurat Nomor 19 Tahun 1957 tentang Pembentukan Daerah-Daerah Swatantra Tingkat I Sumatera Barat, Jambi, dan Riau Sebagai Undang-Undang (Lembaran Negara Republik Indonesia Tahun 1958 Nomor 112, Tambahan Lembaran Negara Republik Indonesia Nomor 1646);</li>
                <li>Undang-Undang Nomor 5 Tahun 1960 tentang Peraturan Dasar Pokok - Pokok Agraria (Lembaran Negara Republik Indonesia Tahun 1960 Nomor 104, Tambahan Lembaran Negara Republik Indonesia Nomor 2013);</li>
                <li>Undang-Undang Nomor 4 Tahun 2009 tentang Penambangan Mineral dan Batubara (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 4, Tambahan Lembaran Negara Republik Indonesia Nomor 4959);</li>
                <li>Undang-Undang Nomor 28 Tahun 2009 tentang Pajak Daerah dan Retribusi Daerah (Lembaran Negara Republik Indonesia Tahun 2009 Nomor 130, Tambahan Lembaran Negara Republik Indonesia Nomor 5049);</li>
                <li>Undang-Undang Nomor 23 Tahun 2014 tentang Pemerintahan Daerah (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 244, Tambahan Lembaran Negara Republik Indonesia Nomor 5587), sebagaimana telah diubah beberapa kali, terakhir dengan Undang-Undang Nomor 9 Tahun 2015, (Lembaran Negara Republik Indonesia Tahun 2015 Nomor 58, Tambahan Lembaran Negara Republik Indonesia Nomor 5679);</li>
                <li>Undang-Undang Nomor 30 Tahun 2014 tentang Administrasi Pemerintahan  (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 292, Tambahan Lembaran Negara Republik Indonesia Nomor 5601);</li>
                <li>Undang-Undang Nomor 22 Tahun 2010 tentang Wilayah Pertambangan (Lembaran Negara Republik Indonesia Tahun 2010 Nomor 28, Tambahan Lembaran Negara Republik Indonesia Nomor 5110);</li>
                <li>Peraturan Pemerintah Nomor 23 Tahun 2010 tentang Pelaksanaan Kegiatan Usaha Pertambagan Mineral dan Batubara (Lembaran Negara Republik Indonesia Tahun 2010 Nomor 29, Tambahan Lembaran Negara Republik Indonesia Nomor 5111), sebagaimana telah diubah beberapa kali, terakhir dengan Peraturan Pemerintah Nomor 1 Tahun 2014 (Lembaran Negara Republik Indonesia Tahun 2014 Nomor 1, Tambahan Lembaran Negara Republik Indonesia Nomor 5489);</li>
                <li>Peraturan Pemerintah Nomor 27 Tahun 2012 tentang Izin Lingkungan (Lembaran Negara Republik Indonesia Tahun 2012 Nomor 48, Tambahan Lembaran Negara Republik Indonesia Nomor 5285);</li>
                <li>Peraturan Menteri Energi dan Sumber Daya Mineral Nomor 43 Tahun 2015 tentang Tata Cara Evaluasi Penerbitan Izin Usaha Pertambangan Mineral dan Batubara (Berita Negara Republik Indonesia Tahun 2015 Nomor 204);</li>
                <li>Peraturan Daerah Provinsi Sumatera Barat Nomor 3 Tahun 2012 tengan Pengelolaan Usaha Pertambagan Mineral dan Batubara (Lembaran Daerah Provinsi Sumatera Barat Tahun 2012 Nomor 3, Tambahan Lembaran Daerah Provinsi Sumatera Barat Nomor 69);</li>
                <li>Peraturan Gubernur Sumatera Barat Nomor 87 Tahun 2012 tentang Penyelenggaran Pelayanan Terpadu Satu Pintu Provinsi Sumatera Barat, sebagaimana telah diubah dengan Peraturan Gubernur Nomor 72 Tahun 2014;</li>
                <li>Keputusan Gubernur Sumatera Barat Nomor 507-8-2013 tentang Pendelegasian Wewenang Penandatangan Perizinan DAlam Rangka Penyelenggaraan Pelayanan Terpadu Satu Pintu Provinsi Sumatera Barat, sebagaimana telah diubah dengan Keputusan Gubernur Nomor 507-754-2014;</li>
            </td>
        </tr>
        <?php
            if(!empty($memperhatikan)){
        ?>
        <tr>
            <td style="vertical-align:top">Memperhatikan</td>
            <td style="vertical-align:top"> : </td>
            <td><ol>
                <?php

                    array_map(function($val){
                        echo "<li>".$val."</li>";                    
                    },$memperhatikan);

                ?>
            </ol></td>
        </tr>
        <?php
            }
        ?>
        <tr>
            <td colspan="3" class="bold_center"><p>Memutuskan</p></td>           
        </tr>
        <tr>
                
            <td style="vertical-align:top">
                <div>Menetapkan</div>
                <div>KESATU</div>
            </td>
            <td style="vertical-align:top"> : </td>
            <td>
                <p>Memberikan Persetujuan Perpanjangan Kedua Izin Usaha Pertambagan Operasi Produksi Batubara kepada.</p> 
                <table style="width:70%;margin:auto;border-spacing:0;">
                    <tr>
                        <td style="white-space:nowrap">Nama Perusahaan</td>
                        <td> : </td>
                        <td><?php echo $nama_perusahaan; ?></td>
                    </tr>
                    <tr>
                        <td>NPWP</td>
                        <td> : </td>
                        <td><?php echo $npwp_perusahaan; ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td> : </td>
                        <td><?php echo $alamat_perusahaan; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Direktur</td>
                        <td> : </td>
                        <td><?php echo $nama_directur_perusahaan; ?></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php

            function d($i){
                switch($i){
                    case 1 :
                        return "SATU";
                    case 2 :
                        return 'DUA';
                    case 3 :
                        return 'TIGA';  
                    case 4 :
                        return 'EMPAT';
                    case 5 :
                        return 'LIMA';
                    case 6 :
                        return 'ENAM';
                    case 7 :
                        return 'TUJUH';
                    case 8 :
                        return 'DELAPAN';
                    case 9 :
                        return 'SEMBILAN';
                };
            }

            function dispatchIndex($i){
                if($i > 99){
                    throw new Exception("CANNOT EXCEED 99");
                }
                $res = "KE";

                $satuan = $i % 10;
                $puluhan = ($i % 100 - $satuan) / 10;
                
                if($puluhan === 0){
                    $res .= d($i);
                }
                else{
                    if($satuan === 0){
                        if($puluhan === 1){
                            $res .= "SE";
                        }
                        else{
                            $res .= d($puluhan);
                        }
                        $res .= "PULUH";
                    }else{
                        if($puluhan === 1){
                            if($satuan === 1){
                                $res .= "SE";
                            }else{
                                $res .= d($satuan);
                            }
                            $res .= "BELAS";
                        }else{
                            $res .= d($puluhan)."PULUH".d($satuan);
                        }
                    }
                }
                return $res;
            }

            $i = 2;
            array_map(function($val) use(&$i){
                echo "<tr><td>".dispatchIndex($i)."</td>
                    <td> : </td>
                    <td>".$val."</td>";
                $i++;
            },$memutuskan);
        ?>
    </table>
</body>
</html>