<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../asset/atom.png" type="image/x-icon">
    <title>Input Karyawan</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.3/JsBarcode.all.min.js"></script>
    <style>
        /* Reset default margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global styles */
        body {
            background-color: #45B39D; /* Latar belakang abu-abu */
            font-family: Arial, sans-serif;
            height: 100vh;
            color:white;
        }

        /* Header styles */
        header {
            
            background-color: #2471A3;
            color: #E5E8E8;
            text-align: center;
            padding:10px;
        }

        header h1 {
            margin: 0;
        }

        /* Form styles */
        main {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #616A6B;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius:2%;
            color:#E5E8E8;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #E5E8E8; /* Warna label */
        }

        input[type="text"],
        input[type="file"],
        input[type="date"] {
            width: 100%;
            padding: 10px 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="file"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #E5E8E8;
        }

        #btn {
            background-color: #007bff;
            color: #E5E8E8;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        #btn:hover {
            background-color: #0056b3;
        }

        /* Background image styles */
        .bg-cover {
            position: fixed;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: -1; /* Menempatkan di bawah konten */
        }

        .bg-cover img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Mencakup seluruh area elemen */
            filter: blur(1px); /* Menambahkan efek blur, sesuaikan angka sesuai dengan preferensi Anda */
        }
        
        .image-preview-container {
            width: 130px; /* Lebar kontainer pratinjau */
            height: 166.67px; /* Tinggi kontainer pratinjau (3:4 aspect ratio) */
            margin: 0 auto;
            position: relative;
            overflow: hidden;
        }

        .preview-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        footer {
            
            background-color: #2471A3;
            text-align: center;
            padding: 10px 0;
            color: #E5E8E8;
}
    </style>
</head>
<body>
    <header>
        <h1>Input Data Karyawan</h1>
    </header>
    <main>
        <form method="post" action="../fungsi/create.php" enctype="multipart/form-data" id="karyawanForm">
            <div class="form-group">
                <label for="name">Nama :</label>
                <input type="text" id="name" name="name" required autofocus placeholder="Masukkan nama..">
            </div>
            <div class="form-group">
                <label for="nim">NIM :</label>
                <input type="text" id="nim" name="nim" required placeholder="Masukkan NIM..">
            </div>
            <div class="form-group">
                <label for="nim">No. Telpon :</label>
                <input type="text" id="nim" name="no_telp" required placeholder="Masukkan No telpon..">
            </div>
            <div class="form-group">      
                <label for="foto">Masukkan Foto :</label>
                <div class="image-preview-container">
                    <img id="preview" class="preview-image" alt="Foto">
                </div>
                <input type="file" id="foto" name="foto" required onchange="previewImage(event)">
                <input type="date" name="tgl" value="<?php echo date('Y-m-d'); ?>" hidden>
            </div>
            <input type="submit" id="btn" value="Simpan">
        </form>
        <svg id="barcode"></svg>
    </main>
    <footer>
        Made in SamTole
    </footer>
    <script src="script.js"></script>
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var preview = document.getElementById('preview');
                preview.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>