<?php
require_once __DIR__ . '/../../config/database.php';

// Menghapus data hanya jika menggunakan metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Mengambil dan memeriksa ID barang
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id && $id > 0) {

        // Menghapus data barang berdasarkan ID
        $sql = "DELETE FROM data_barang WHERE id_barang = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
}

// Kembali ke halaman Data Barang
header('Location: index.php?page=user/list');
exit;
?>
