<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO skema 
    (nama_skema, deskripsi, status, tgl_mulai, tgl_selesai)
    VALUES 
    ('$_POST[nama]','$_POST[deskripsi]','$_POST[status]','$_POST[mulai]','$_POST[selesai]')");

    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Skema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm p-4 mx-auto" style="max-width:600px;">

            <h4 class="mb-4 text-center">Tambah Skema UJK</h4>

            <form method="post">

                <!-- Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama Skema</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama skema" required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3" placeholder="Masukkan deskripsi"></textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="buka">Buka</option>
                        <option value="coming_soon">Coming Soon</option>
                        <option value="tutup">Tutup</option>
                    </select>
                </div>

                <!-- Tanggal -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" name="mulai" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Selesai</label>
                        <input type="date" name="selesai" class="form-control">
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between">
                    <a href="admin.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>