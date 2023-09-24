    <?php
    include_once("../fungsi/config.php");
    $relasi = mysqli_query($connection, "SELECT * FROM absen INNER JOIN karyawan ON absen.nim = karyawan.nim ");

    // Periksa apakah query berhasil dieksekusi
    if (!$relasi) {
        die("Query error: " . mysqli_error($connection));
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../asset/atom.png" type="image/x-icon">
        <title>Data Karyawan dan Riwayat Absen</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: cadetblue;
                margin: 0;
                padding: 0;
            }

            header {
                background-color: #283747;
                color: #fff;
                text-align: center;
                padding: 20px;
            }

            h1 {
                margin: 0;
            }

            .container {
                max-width: 900px;
                margin: 20px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            table {
                width: 100%;
                
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center; /* Menambahkan text-align: center */
            }

            th {
                background-color: #283747;
                color: #fff;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            tr:hover {
                background-color: #ddd;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Data Karyawan dan Riwayat Absen</h1>
        </header>
        <div class="container">
            <h2>Data Karyawan</h2>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Tanggal Buat</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no = 1; 
                    $prevNIM = null; // NIM sebelumnya
                    foreach ($relasi as $item):
                        if ($item['nim'] != $prevNIM): // Cek apakah NIM berubah
                            $prevNIM = $item['nim'];
                    ?>
                    <!-- Isi data karyawan disini -->
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td>
                            <img src="../upload/<?php echo $item['foto']; ?>" alt="Foto Karyawan" width="100">
                        </td>
                        <td><?php echo $item['name'] ?></td>
                        <td><?php echo $item['nim'] ?></td>
                        <td><?php echo $item['tgl'] ?></td>
                    </tr>
                    <?php 
                        endif; // Akhir dari cek NIM berubah
                    endforeach;   ?>
                </tbody>
            </table>

            <h2>Riwayat Absen</h2>
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Tanggal Absen</th>
                        <th>Keterangan</th>
                        <th>Modif</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Isi riwayat absen disini -->
                    <?php $i=1; foreach ($relasi as $item): ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $item['nim'] ?></td>
                        <td><?php echo $item['name'] ?></td>
                        <td><?php echo $item['hari'] ?></td>
                        <td><?php echo $item['jam'] ?></td>
                        <td><?php echo $item['tanggal'] ?></td>
                        <td><?php echo $item['keterangan'] ?></td>
                        <td>
                        <a href="./edit.php?jam=<?php echo $item['jam']; ?>&nim=<?php echo $item['nim']; ?>">Edit</a> |
                        <a href="../fungsi/delete.php?jam=<?php echo $item['jam']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>
