<?php 
include_once("../fungsi/config.php");
$jam = $_GET['jam'];
$nim = $_GET['nim'];
$data = mysqli_query($connection, "SELECT * FROM absen WHERE jam='$jam' AND nim='$nim'");
$hasil = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../asset/atom.png" type="image/x-icon">
    <title>Scanner Barcode</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: cadetblue;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px #888888;
            padding: 20px;
        }

        #barcode-result {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        #btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        #btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="text-center">Scanner Barcode</h1>
    <hr>
    <form action="../fungsi/edit.php" method="POST" enctype="multipart/form-data">
        <div class="form-group text-start">
            <label for="nim">Nim:</label>
            <input class="form-control" name="nim" value="<?= $hasil['nim']; ?>">
            <label for="jam">Jam:</label> 
            <input class="form-control" name="jam" value="<?= $hasil['jam']; ?>">
            
            <label for="hari">Hari:</label>
            <select class="form-control" name="hari" id="hari">
                <option value="Senin" <?= ($hasil['hari'] === 'Senin') ? 'selected' : ''; ?>>Senin</option>
                <option value="Selasa" <?= ($hasil['hari'] === 'Selasa') ? 'selected' : ''; ?>>Selasa</option>
                <option value="Rabu" <?= ($hasil['hari'] === 'Rabu') ? 'selected' : ''; ?>>Rabu</option>
                <option value="Kamis" <?= ($hasil['hari'] === 'Kamis') ? 'selected' : ''; ?>>Kamis</option>
                <option value="Jumat" <?= ($hasil['hari'] === 'Jumat') ? 'selected' : ''; ?>>Jumat</option>
                <option value="Sabtu" <?= ($hasil['hari'] === 'Sabtu') ? 'selected' : ''; ?>>Sabtu</option>
                <option value="Minggu" <?= ($hasil['hari'] === 'Minggu') ? 'selected' : ''; ?>>Minggu</option>
            </select>
            <label for="tanggal">Tanggal:</label>
            <input class="form-control" name="tanggal" value="<?= $hasil['tanggal']; ?>">
            <label for="keterangan">Keterangan:</label>
            <select class="form-control" name="keterangan" id="keterangan">
                <option value="hadir" <?= ($hasil['keterangan'] === 'hadir') ? 'selected' : ''; ?>>Hadir</option>
                <option value="alfa" <?= ($hasil['keterangan'] === 'alfa') ? 'selected' : ''; ?>>Alfa</option>
                <option value="sakit" <?= ($hasil['keterangan'] === 'sakit') ? 'selected' : ''; ?>>Sakit</option>
            </select>
        </div>
        <button class="type=" id="btn" value="Simpan">
Simpan
        </button> 
    </form>
</div>

</body>
</html>
