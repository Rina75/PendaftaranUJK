<?php
include 'koneksi.php';
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM skema WHERE id=$id");

header("Location: admin.php");
