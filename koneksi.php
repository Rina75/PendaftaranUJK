<?php
$conn = mysqli_connect("localhost", "root", "", "ujk_lsp");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
