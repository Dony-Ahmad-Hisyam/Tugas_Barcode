<?php

include_once("../fungsi/config.php");
$jam = $_POST['jam'];
$hari = $_POST['hari'];
$tanggal = $_POST['tanggal'];
$keterangan = $_POST['keterangan'];
    
    $result = mysqli_query($connection, "UPDATE absen SET jam='$jam', hari='$hari', tanggal='$tanggal', keterangan='$keterangan' WHERE jam='$jam'");

    if($result){
    echo '<script>alert("Berhasil DIEDIT!!")</script>';
    echo '<meta http-equiv="refresh" content="0.2;url=../main/view_absen.php">';
    }else{
        echo "failed";
    }        

?>