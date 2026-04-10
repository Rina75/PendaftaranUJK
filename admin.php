<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Admin UJK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- ================= HEADER / NAVBAR ================= -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Admin UJK LSP</a>

            <div class="ms-auto">
                <a href="index.php" class="btn btn-light btn-sm">Landing Page</a>
                <a href="peserta.php" class="btn btn-info btn-sm">Data Peserta</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <!-- ================= CONTENT ================= -->
    <div class="container mt-4 flex-grow-1">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Data Skema UJK</h4>
            <a href="tambah.php" class="btn btn-success">+ Tambah Skema</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Skema</th>
                                <th>Status</th>
                                <th>Pelaksanaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 1;
                            $query = mysqli_query($conn, "SELECT * FROM skema");

                            while ($d = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>

                                    <td><?= $d['nama_skema']; ?></td>

                                    <!-- STATUS BADGE -->
                                    <td class="text-center">
                                        <?php if ($d['status'] == 'buka') { ?>
                                            <span class="badge bg-success">Buka</span>
                                        <?php } elseif ($d['status'] == 'tutup') { ?>
                                            <span class="badge bg-danger">Tutup</span>
                                        <?php } else { ?>
                                            <span class="badge bg-warning text-dark">Coming Soon</span>
                                        <?php } ?>
                                    </td>

                                    <!-- TANGGAL -->
                                    <td class="text-center">
                                        <?php
                                        if ($d['tgl_mulai']) {
                                            echo date('d M Y', strtotime($d['tgl_mulai'])) .
                                                " - " .
                                                date('d M Y', strtotime($d['tgl_selesai']));
                                        } else {
                                            echo "<span class='text-muted'>Coming Soon</span>";
                                        }
                                        ?>
                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-center">
                                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                        <button class="btn btn-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#hapus<?= $d['id']; ?>">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>

                                <!-- MODAL HAPUS -->
                                <div class="modal fade" id="hapus<?= $d['id']; ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">
                                                Yakin ingin menghapus <b><?= $d['nama_skema']; ?></b>?
                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <a href="hapus.php?id=<?= $d['id']; ?>" class="btn btn-danger">Hapus</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>© <?= date('Y'); ?> UJK LSP BPVP Kendari | Admin Panel</small>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>