
<?php
require_once __DIR__ . '/../../config/database.php';

$pesan = '';

$id = $_GET['id'] ?? $_POST['id'] ?? 0;
$id = (int) $id;

// Mengambil data barang berdasarkan ID
$sql = "SELECT * FROM data_barang WHERE id_barang = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data barang tidak ditemukan.");
}

// Memproses perubahan data
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];

    // Menggunakan gambar lama jika tidak upload gambar baru
    $gambar = $data['gambar'];

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

    // Memperbarui data di database
    $sql = "UPDATE data_barang SET
            nama = ?, kategori = ?, harga_jual = ?,
            harga_beli = ?, stok = ?, gambar = ?
            WHERE id_barang = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "ssddisi",
        $nama,
        $kategori,
        $harga_jual,
        $harga_beli,
        $stok,
        $gambar,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        header('Location: index.php?page=user/list');
        exit;
    } else {
        $pesan = "Gagal mengubah data barang.";
    }

    // Memperbarui tampilan data
    $data['nama'] = $nama;
    $data['kategori'] = $kategori;
    $data['harga_jual'] = $harga_jual;
    $data['harga_beli'] = $harga_beli;
    $data['stok'] = $stok;
    $data['gambar'] = $gambar;
}
?>

<section class="content">
    <h2>Ubah Barang</h2>

    <?php if ($pesan != ''): ?>
        <p><?= e($pesan); ?></p>
    <?php endif; ?>

    <form method="POST"
          action="index.php?page=user/edit&id=<?= (int)$data['id_barang']; ?>"
          enctype="multipart/form-data">

        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama"
                   value="<?= e($data['nama']); ?>" required>
        </div>

        <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" required>
                <option value="Komputer" <?= $data['kategori'] == 'Komputer' ? 'selected' : ''; ?>>Komputer</option>
                <option value="Elektronik" <?= $data['kategori'] == 'Elektronik' ? 'selected' : ''; ?>>Elektronik</option>
                <option value="Hand Phone" <?= $data['kategori'] == 'Hand Phone' ? 'selected' : ''; ?>>Hand Phone</option>
            </select>
        </div>

        <div class="form-group">
            <label>Harga Jual</label>
            <input type="number" name="harga_jual"
                   value="<?= e((string)$data['harga_jual']); ?>" required>
        </div>

        <div class="form-group">
            <label>Harga Beli</label>
            <input type="number" name="harga_beli"
                   value="<?= e((string)$data['harga_beli']); ?>" required>
        </div>

        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok"
                   value="<?= e((string)$data['stok']); ?>" required>
        </div>

        <div class="form-group">
            <label>Gambar Saat Ini</label><br>
            <img src="<?= e(strpos($data['gambar'], 'gambar/') === 0 ? $data['gambar'] : 'gambar/' . $data['gambar']); ?>"
                 width="100" alt="Gambar barang">
        </div>

        <div class="form-group">
            <label>Ganti Gambar (Opsional)</label>
            <input type="file" name="file_gambar" accept="image/*">
        </div>

        <input type="hidden" name="id" value="<?= (int)$data['id_barang']; ?>">

        <button type="submit" name="submit" class="btn">Simpan Perubahan</button>
        <a href="index.php?page=user/list" class="btn btn-secondary">Kembali</a>

    </form>
</section>
