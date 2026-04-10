<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

// ambil filter
$filter_skema = $_GET['skema'] ?? '';
$filter_kejuruan = $_GET['kejuruan'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Peserta UJK</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- HEADER -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <a href="admin.php" class="navbar-brand fw-bold">Admin UJK</a>
            <div>
                <a href="admin.php" class="btn btn-light btn-sm">Data Skema</a>
                <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container mt-4 flex-grow-1">

        <h4 class="mb-3 fw-bold">Data Pendaftaran Peserta</h4>

        <!-- FILTER -->
        <form method="get" class="row g-2 mb-3">

            <!-- SKEMA -->
            <div class="col-md-4">
                <select name="skema" class="form-select">
                    <option value="">-- Semua Skema --</option>
                    <?php
                    $skema = mysqli_query($conn, "SELECT * FROM skema");
                    while ($s = mysqli_fetch_assoc($skema)) {
                        $selected = ($filter_skema == $s['id']) ? 'selected' : '';
                        echo "<option value='$s[id]' $selected>$s[nama_skema]</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- KEJURUAN -->
            <div class="col-md-4">
                <input type="text" name="kejuruan" class="form-control"
                    placeholder="Filter Kejuruan"
                    value="<?= $filter_kejuruan ?>">
            </div>

            <!-- BUTTON -->
            <div class="col-md-4 d-flex gap-2">
                <button class="btn btn-primary">Filter</button>

                <a href="peserta.php" class="btn btn-secondary">Reset</a>

                <a href="export_excel.php?skema=<?= $filter_skema ?>&kejuruan=<?= $filter_kejuruan ?>"
                    class="btn btn-success">
                    Export Excel
                </a>
            </div>

        </form>

        <!-- TABLE -->
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Kejuruan</th>
                                <th>Skema</th>
                                <th>Tanggal Daftar</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                            $where = "WHERE 1=1";

                            if (!empty($filter_skema)) {
                                $where .= " AND p.id_skema = '$filter_skema'";
                            }

                            if (!empty($filter_kejuruan)) {
                                $where .= " AND p.kejuruan LIKE '%$filter_kejuruan%'";
                            }

                            $query = mysqli_query($conn, "
                            SELECT p.*, s.nama_skema 
                            FROM pendaftaran p
                            JOIN skema s ON p.id_skema = s.id
                            $where
                            ORDER BY p.id DESC
                        ");

                            $no = 1;
                            while ($d = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td><?= $d['nama']; ?></td>
                                    <td><?= $d['nohp']; ?></td>
                                    <td><?= $d['email']; ?></td>
                                    <td><?= $d['alamat']; ?></td>
                                    <td><?= $d['kejuruan']; ?></td>
                                    <td><?= $d['nama_skema']; ?></td>
                                    <td class="text-center">
                                        <?= date('d M Y H:i', strtotime($d['created_at'])); ?>
                                    </td>
                                </tr>
                            <?php } ?>

                            <?php if (mysqli_num_rows($query) == 0) { ?>
                                <tr>
                                    <td colspan="8" class="text-center text-muted">
                                        Data tidak ditemukan
                                    </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <small>© <?= date('Y'); ?> UJK LSP BPVP Kendari</small>
    </footer>

</body>

</html>