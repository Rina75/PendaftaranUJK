<?php
include 'koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM skema WHERE id='$id'"));

if (isset($_POST['daftar'])) {

    mysqli_query($conn, "INSERT INTO pendaftaran 
    (nama, nohp, email, alamat, kejuruan, id_skema) 
    VALUES 
    ('$_POST[nama]', '$_POST[nohp]', '$_POST[email]', '$_POST[alamat]', '$_POST[kejuruan]', '$id')");

    $id_pendaftaran = mysqli_insert_id($conn);
    header("Location: sukses.php?id=" . $id_pendaftaran);
    exit;}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar UJK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a href="index.php" class="navbar-brand">UJK LSP BPVP Kendari</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card shadow">
                    <div class="card-body">

                        <h4 class="text-center mb-4">Form Pendaftaran UJK</h4>

                        <!-- SKEMA -->
                        <div class="mb-3">
                            <label class="form-label">Skema</label>
                            <input type="text" class="form-control" value="<?= $data['nama_skema']; ?>" readonly>
                        </div>

                        <!-- STATUS -->
                        <div class="mb-3">
                            <?php if ($data['status'] == 'buka') { ?>
                                <span class="badge bg-success">Pendaftaran Dibuka</span>
                            <?php } elseif ($data['status'] == 'tutup') { ?>
                                <span class="badge bg-danger">Pendaftaran Ditutup</span>
                            <?php } else { ?>
                                <span class="badge bg-warning text-dark">Coming Soon</span>
                            <?php } ?>
                        </div>

                        <form method="post">

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label>No Handphone</label>
                                    <input type="text" name="nohp" class="form-control" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label>Kejuruan</label>
                                <input type="text" name="kejuruan" class="form-control" required>
                            </div>

                            <!-- TANGGAL -->
                            <div class="mb-3">
                                <label>Jadwal UJK</label><br>
                                <?php
                                if ($data['tgl_mulai']) {
                                    echo date('d M Y', strtotime($data['tgl_mulai'])) .
                                        " - " .
                                        date('d M Y', strtotime($data['tgl_selesai']));
                                } else {
                                    echo "<span class='text-muted'>Coming Soon</span>";
                                }
                                ?>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Kembali</a>

                                <?php if ($data['status'] == 'buka') { ?>
                                    <button type="submit" name="daftar" class="btn btn-primary">Daftar</button>
                                <?php } else { ?>
                                    <button class="btn btn-secondary" disabled>Tidak Tersedia</button>
                                <?php } ?>

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <small>© <?= date('Y'); ?> UJK LSP BPVP Kendari</small>
    </footer>

</body>

</html>