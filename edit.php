<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM skema WHERE id=$id"));

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE skema SET
        nama_skema='$_POST[nama]',
        deskripsi='$_POST[deskripsi]',
        status='$_POST[status]',
        tgl_mulai='$_POST[mulai]',
        tgl_selesai='$_POST[selesai]'
        WHERE id=$id");

    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Skema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm p-4 mx-auto" style="max-width:500px;">

            <h4 class="mb-3 text-center">Edit Skema</h4>

            <form method="post">

                <div class="mb-3">
                    <label class="form-label">Nama Skema</label>
                    <input type="text" name="nama" class="form-control" value="<?= $data['nama_skema']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <input type="text" name="deskripsi" class="form-control" value="<?= $data['deskripsi']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="buka" <?= $data['status'] == 'buka' ? 'selected' : ''; ?>>Buka</option>
                        <option value="coming_soon" <?= $data['status'] == 'coming_soon' ? 'selected' : ''; ?>>Coming Soon</option>
                        <option value="tutup" <?= $data['status'] == 'tutup' ? 'selected' : ''; ?>>Tutup</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="mulai" class="form-control" value="<?= $data['tgl_mulai']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Selesai</label>
                    <input type="date" name="selesai" class="form-control" value="<?= $data['tgl_selesai']; ?>">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="admin.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </div>

            </form>
        </div>
    </div>

</body>

</html>