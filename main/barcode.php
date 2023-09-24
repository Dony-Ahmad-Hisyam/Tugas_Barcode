<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tampilan Kartu Karyawan</title>
    <link rel="icon" href="../asset/atom.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
    <style>
        body {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            background-color: cadetblue;
            justify-content: center;
            align-items: flex-start;
            height: 75vh; /* Mengatur tinggi tampilan menjadi 75% dari tinggi viewport */
            overflow-y: auto; /* Menambahkan scrollbar jika konten melebihi tinggi viewport */
        }

        .row {
            display: flex;
            justify-content: flex-start;
            flex-wrap: wrap;
            margin: 20px;
        }

        .identity-card {
            width: calc(33.33% - 20px);
            border: 2px solid #007bff;
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            flex: 9; /* Menyesuaikan dengan tiga kolom dalam satu baris */
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .identity-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 2px solid #007bff;
            margin: 0 auto 10px;
            display: block;
            transition: transform 0.3s;
        }

        .profile-image:hover {
            transform: scale(1.1);
        }

        .barcode {
            margin-top: 15px;
            width: 200px;
            height: 100px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .download-identity-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 15px;
            margin-top: 15px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .download-identity-button:hover {
            background-color: #0056b3;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: burlywood;
        }

        .info-text {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .identity-card {
    position: relative;
    /* Kode CSS lainnya tetap seperti sebelumnya */
}
.card-number {
    position: absolute;
    top: 10px; /* Sesuaikan dengan posisi vertikal yang diinginkan */
    left: 10px; /* Sesuaikan dengan posisi horizontal yang diinginkan */
    font-size: 24px; /* Sesuaikan dengan ukuran font yang diinginkan */
}

    </style>
</head>
<body>
    <div id="identity-container">
        <h1 >Download Kartu Karyawan</h1>
        <?php
        include_once('../fungsi/config.php');
        $sql = "SELECT * FROM karyawan";
        $result = $connection->query($sql);
        $i=1;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nim = $row["nim"];
                $nama = $row["name"];
                $tgl = $row["tgl"];
                $foto = "../upload/" . ($row["foto"] ?? "default.jpg");

                echo '<div class="row">'; // Mulai setiap baris
                echo '<div class="identity-card">';
                echo '<div class="card-number text-start">' . $i++ . '</div>';
                echo '<img src="' . $foto . '" alt="Foto Profil" class="profile-image">';
                echo '<h2>' . $nama . '</h2>';
                echo '<p class="info-text">NIM: ' . $nim . '</p>';
                echo '<p class="info-text">Tanggal Pembuatan: ' . $tgl . '</p>';

                echo '<canvas class="barcode" id="barcode_' . $nim . '"></canvas>';
                echo '<br><button class="download-identity-button" data-nim="' . $nim . '">Unduh Kartu Identitas</button>';
                echo '</div>';
                echo '</div>'; // Akhiri setiap baris
        ?>
                <script>
                    JsBarcode("#barcode_<?php echo $nim; ?>", "<?php echo $nim; ?>", { displayValue: false, format: "CODE128" });

                    document.querySelector(".download-identity-button[data-nim='<?php echo $nim; ?>']").addEventListener("click", function() {
                        var canvas = document.createElement("canvas");
                        canvas.width = 1200; // Ganti dengan lebar yang lebih tinggi
                        canvas.height = 800; // Ganti dengan tinggi yang lebih tinggi
                        // Mengatur tinggi canvas menjadi lebih besar
                        var ctx = canvas.getContext("2d");
                        var profileImage = new Image();
                        profileImage.src = "<?php echo $foto; ?>";
                        profileImage.onload = function() {
                            ctx.drawImage(profileImage, 20, 20, 300, 300); // Ganti koordinat dan ukuran gambar profil
                            ctx.font = "40px Roboto"; // Sesuaikan ukuran font
                            ctx.fillText("Nama: <?php echo $nama; ?>", 400, 80); // Sesuaikan koordinat teks
                            ctx.fillText("NIM: <?php echo $nim; ?>", 400, 160); // Sesuaikan koordinat teks
                            ctx.fillText("Tanggal Pembuatan: <?php echo $tgl; ?>", 400, 240); // Sesuaikan koordinat teks
                            ctx.drawImage(document.querySelector("#barcode_<?php echo $nim; ?>"), 400, 320, 200, 80);

                            var url = canvas.toDataURL("image/png", 1.0);
                            var a = document.createElement("a");
                            a.href = url;
                            a.download = "kartu_identitas_<?php echo $nim; ?>.png";
                            a.click();
                        };
                    });
                </script>
        <?php
            }
        } else {
            echo '<p>Data NIM tidak ditemukan</p>';
        }
        ?>
    </div>
</body>
</html>
