<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "latihan1"
);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>