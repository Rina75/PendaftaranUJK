<?php
include 'koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Peserta_UJK.xls");

$filter_skema = $_GET['skema'] ?? '';
$filter_kejuruan = $_GET['kejuruan'] ?? '';

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
");
?>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>No HP</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Kejuruan</th>
        <th>Skema</th>
        <th>Tanggal</th>
    </tr>

    <?php
    $no = 1;
    while ($d = mysqli_fetch_assoc($query)) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['nama']; ?></td>
            <td><?= $d['nohp']; ?></td>
            <td><?= $d['email']; ?></td>
            <td><?= $d['alamat']; ?></td>
            <td><?= $d['kejuruan']; ?></td>
            <td><?= $d['nama_skema']; ?></td>
            <td><?= $d['created_at']; ?></td>
        </tr>
    <?php } ?>
</table>