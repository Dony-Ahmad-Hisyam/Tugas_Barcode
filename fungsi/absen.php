<?php
include_once("./config.php");

$nim = $_POST['nim'];   
$hari = $_POST['hari'];
$tanggal = $_POST['tanggal'];
$jam = $_POST['jam'];
$keterangan = $_POST['keterangan'];

// Validasi data yang diterima dari formulir
if (empty($nim) || empty($hari) || empty($tanggal) || empty($jam) || empty($keterangan)) {
    echo '<script>alert("Semua field harus diisi.")</script>';
    echo '<meta http-equiv="refresh" content="0.2;url=../main/view_absen.php">';
} else {
    // Cek apakah nim ada dalam tabel karyawan
    $result = mysqli_query($connection, "SELECT nim, no_telp FROM karyawan WHERE nim = '$nim'");
    if (mysqli_num_rows($result) > 0) {
        // Nim valid, ambil nomor telepon dari hasil query
        $row = mysqli_fetch_assoc($result);
        $no_telp = $row['no_telp'];
        
        // Sekarang Anda bisa menggunakan $no_telp dalam pengiriman SMS atau operasi lainnya
        
        $token = "R_-4J_tnurKuU3_V3nbi";
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.fonnte.com/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
            'target' => "$no_telp",
            'message' => 'Selamat, Anda Berhasil Absen!!', 
          ),
          CURLOPT_HTTPHEADER => array(
            "Authorization: $token" //change TOKEN to your actual token
          ),
        ));
        
        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
        
        // Lakukan operasi INSERT setelah mengambil nomor telepon
        $data = mysqli_query($connection, "INSERT INTO absen(jam, hari, tanggal, keterangan, nim, no_telp) VALUES ('$jam', '$hari', '$tanggal', '$keterangan', '$nim', '$no_telp')");
        if ($data) {
            echo '<script>alert("Berhasil Absen.")</script>';
            echo '<meta http-equiv="refresh" content="0.2;url=../main/view_absen.php">';
        } else {
            echo '<script>alert("Gagal Absen")</script>';
            echo '<meta http-equiv="refresh" content="0.2;url=../main/absen.php">';
        }
    } else {
        // Nim tidak valid, beri pesan kesalahan kepada pengguna
        echo '<script>alert("Barcode tidak valid, silakan coba lagi.")</script>';
        echo '<meta http-equiv="refresh" content="0.2;url=../main/absen.php">';
    }
}

?>