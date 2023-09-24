<?php
include_once("../fungsi/config.php");

// Ambil data dari form dengan menghindari SQL injection menggunakan mysqli_real_escape_string
$name = mysqli_real_escape_string($connection, $_POST['name']);
$nim = mysqli_real_escape_string($connection, $_POST['nim']);
$tgl = mysqli_real_escape_string($connection, $_POST['tgl']);
$no_telp = mysqli_real_escape_string($connection, $_POST['no_telp']);

$file = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];
$tmp = $_FILES['foto']['tmp_name'];

// Mendapatkan ekstensi file yang diunggah
$ext = pathinfo($file, PATHINFO_EXTENSION);

// Mengizinkan tipe gambar yang diharapkan
$allowed_extensions = array("jpg", "jpeg", "png");

if (in_array($ext, $allowed_extensions)) {
    if ($ukuran <= 1000000) {
        $path = "../upload/" . $file;
        if (move_uploaded_file($tmp, $path)) {
            // Perbaikan variabel $foto menjadi $file dalam query SQL
            $sql = "INSERT INTO karyawan (name, nim, foto, tgl, no_telp) VALUES ('$name', '$nim', '$file', '$tgl','$no_telp')";
            // Eksekusi query
            $data = mysqli_query($connection, $sql);
            if ($data) {
                echo '<script>alert("Berhasil di TAMBAHKAN!!")</script>';
                echo '<meta http-equiv="refresh" content="0.2;url=../main/barcode.php">';
            } else {
                echo "Gagal: " . mysqli_error($connection); // Menampilkan pesan error MySQL
            }
        } else {
            echo "Upload Failed";
        }
    } else {
        echo "Ukuran file terlalu besar (maksimal 1 MB)";
    }
} else {
    echo "Tipe file tidak didukung (hanya jpg, jpeg, png)";
}
?>
