
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
        #form{
background-color: #E5E8E8;
        }

        #barcode-result {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Scanner Barcode</h1>
        <hr>
        <form action="../fungsi/absen.php" method="POST">
            <div class="form-group text-start">
                <label for="nim">Absen barcode :</label>
                <input type="text" class="form-control" name="nim" id="nim" placeholder="Pindai barcode disini" autofocus required>
                <input type="text" hidden class="form-control" name="jam" id="jam">
                <input type="text" hidden class="form-control" name="hari" id="hari">
                <input type="text" hidden class="form-control" name="tanggal" id="tanggal">
                <input type="text" hidden class="form-control" name="keterangan" value="hadir">
            </div>
        </form>
    </div>

    <script>
        // Mendapatkan waktu sekarang
        var now = new Date();
        var jam = now.getHours() + ":" + (now.getMinutes() < 10 ? '0' : '') + now.getMinutes();
        var hariArray = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        var hari = hariArray[now.getDay()]; // Mengambil nama hari berdasarkan indeks
        var tanggal = now.getFullYear() + "-" + (now.getMonth() + 1) + "-" + now.getDate(); // Format tanggal YYYY-MM-DD

        // Mengisi nilai input otomatis
        document.getElementById("jam").value = jam;
        document.getElementById("hari").value = hari;
        document.getElementById("tanggal").value = tanggal;

        // Menambahkan event listener untuk mengirimkan formulir ketika "Enter" ditekan
        document.getElementById("nim").addEventListener("keydown", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Mencegah form dari pengiriman standar
                document.querySelector("form").submit(); // Mengirimkan formulir
            }
        });

    </script>
</body>
</html>
