<?php
include 'koneksi.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT p.*, s.nama_skema 
    FROM pendaftaran p
    JOIN skema s ON p.id_skema = s.id
    WHERE p.id='$id'
"));
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body class="bg-light">

    <div class="container mt-5">

        <div class="card shadow mx-auto" style="max-width:700px;">
            <div class="card-body">

                <h4 class="text-center mb-3 text-success">
                    ✅ Pendaftaran Berhasil
                </h4>

                <p class="text-center">Silakan simpan atau cetak bukti pendaftaran Anda</p>

                <hr>

                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <td><?= $data['nama']; ?></td>
                    </tr>
                    <tr>
                        <th>No HP</th>
                        <td><?= $data['nohp']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?= $data['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td><?= $data['alamat']; ?></td>
                    </tr>
                    <tr>
                        <th>Kejuruan</th>
                        <td><?= $data['kejuruan']; ?></td>
                    </tr>
                    <tr>
                        <th>Skema</th>
                        <td><?= $data['nama_skema']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Daftar</th>
                        <td><?= date('d M Y H:i', strtotime($data['created_at'])); ?></td>
                    </tr>
                </table>

                <div class="text-center mt-4 no-print">
                    <button onclick="window.print()" class="btn btn-primary">
                        🖨️ Cetak Bukti
                    </button>

                    <a href="index.php" class="btn btn-secondary">
                        Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>

    </div>

</body>

</html>