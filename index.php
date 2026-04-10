<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran UJK LSP BPVP Kendari</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f7fb;
        }

        .navbar {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .hero {
            padding: 60px 0;
            text-align: center;
        }

        .hero h1 {
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 15px;
            transition: 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .badge-status {
            position: absolute;
            top: 15px;
            left: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
        }

        .btn-daftar {
            border-radius: 10px;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            background: #2c3e50;
            color: white;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-white">
        <div class="container">
            <a class="navbar-brand fw-bold">LSP BPVP Kendari</a>

            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Cari skema...">
            </form>
            <a href="login.php" class="btn btn-outline-primary">Login</a>
        </div>
    </nav>

    <!-- HERO -->
    <section class="hero">
        <div class="container">
            <h1>Pendaftaran Uji Kompetensi (UJK)</h1>
            <p class="text-muted">Pilih skema sertifikasi sesuai pelatihan yang anda ikuti</p>
        </div>
    </section>

    <!-- LIST SKEMA -->
    <div class="container">
        <div class="row">

            <?php
            $query = mysqli_query($conn, "SELECT * FROM skema");

            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm p-4 position-relative">

                        <!-- STATUS -->
                        <?php if ($data['status'] == 'buka') { ?>
                            <span class="badge bg-success badge-status">Buka</span>

                        <?php } elseif ($data['status'] == 'coming_soon') { ?>
                            <span class="badge bg-warning text-dark badge-status">Coming Soon</span>

                        <?php } else { ?>
                            <span class="badge bg-danger badge-status">Tutup</span>
                        <?php } ?>

                        <h5 class="card-title mt-3"><?= $data['nama_skema']; ?></h5>
                        <p class="text-muted small"><?= $data['deskripsi']; ?></p>

                        <!-- PELAKSANAAN -->
                        <p class="small mb-2">
                            📅 Pelaksanaan:
                            <?php
                            if ($data['tgl_mulai'] && $data['tgl_selesai']) {

                                $mulai = date('d M', strtotime($data['tgl_mulai']));
                                $selesai = date('d M Y', strtotime($data['tgl_selesai']));

                                echo "$mulai - $selesai";
                            } else {
                                echo "<span class='text-warning fw-semibold'>Coming Soon</span>";
                            }
                            ?>
                        </p>

                        <div class="mt-3">

                            <?php if ($data['status'] == 'buka') { ?>
                                <a href="daftar.php?id=<?= $data['id']; ?>" class="btn btn-primary w-100">Daftar</a>

                            <?php } elseif ($data['status'] == 'coming_soon') { ?>
                                <button class="btn btn-warning w-100" disabled>Segera Dibuka</button>

                            <?php } else { ?>
                                <button class="btn btn-secondary w-100" disabled>Pendaftaran Ditutup</button>
                            <?php } ?>

                        </div>

                    </div>
                </div>
            <?php } ?>

        </div>
    </div>

    <!-- FOOTER -->
    <footer>
        <p>© 2026 LSP BPVP Kendari</p>
    </footer>

</body>

</html>