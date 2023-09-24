<?php 
include_once("./config.php");

$jam = $_GET['jam'];


$data = mysqli_query($connection, "DELETE from absen where jam = '$jam'");

if($data){
    echo '<script>alert("Berhasil Di Delete..")</script>';
    echo '<meta http-equiv="refresh" content="0.2;url=../main/view_absen.php">';
}else{  
 echo 'Gagal Absen';
}


?>