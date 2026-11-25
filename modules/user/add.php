
<?php
require_once __DIR__ . '/../../config/database.php';

$pesan = '';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];

    $gambar = null;

    // Memproses upload gambar
    if (isset($_FILES['file_gambar']) && $_FILES['file_gambar']['error'] == 0) {

        $folderGambar = dirname(__DIR__, 2) . '/gambar/';

        if (!is_dir($folderGambar)) {
            mkdir($folderGambar, 0777, true);
        }

        $ekstensi = pathinfo($_FILES['file_gambar']['name'], PATHINFO_EXTENSION);
        $namaFile = uniqid() . '.' . $ekstensi;

        $tujuan = $folderGambar . $namaFile;

        if (move_uploaded_file($_FILES['file_gambar']['tmp_name'], $tujuan)) {
            $gambar = 'gambar/' . $namaFile;
        }
    }

    // Menyimpan data ke database
    $sql = "INSERT INTO data_barang
            (nama, kategori, harga_jual, harga_beli, stok, gambar)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssddis",
        $nama,
        $kategori,
        $harga_jual,
        $harga_beli,
        $stok,
        $gambar
    );

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?page=user/list');
        exit;
    } else {
        $pesan = 'Gagal menyimpan data barang.';
    }
}
?>

<section class="content">
    <h2>Tambah Barang</h2>

    <?php if ($pesan != ''): ?>
        <p><?= e($pesan); ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?page=user/add" enctype="multipart/form-data">

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama" placeholder="Masukkan nama barang" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" required>
                <option value="Komputer">Komputer</option>
                <option value="Elektronik">Elektronik</option>
                <option value="Hand Phone">Hand Phone</option>
            </select>
        </div>

        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual" required>
        </div>

        <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" required>
        </div>

        <div class="form-group">
            <label>File Gambar</label>
            <input type="file" name="file_gambar" accept="image/*">
        </div>

        <button type="submit" name="submit" class="btn">Simpan</button>

        <a href="index.php?page=user/list" class="btn btn-secondary">
            Kembali
        </a>

    </form>
</section>


