<?php
require_once __DIR__ . '/../../config/database.php';

// Query untuk menampilkan data barang
$sql = "SELECT * FROM data_barang";
$result = mysqli_query($conn, $sql);
?>

<section class="content">
    <h2>Data Barang</h2>

    <p>Berikut adalah daftar barang yang tersimpan di database.</p>

    <a href="index.php?page=user/add" class="btn">
        + Tambah Barang
    </a>

    <div class="table-container">
        <table class="data-table">
            <tr>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>

            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <img src="<?= e(strpos($row['gambar'], 'gambar/') === 0 ? $row['gambar'] : 'gambar/' . $row['gambar']); ?>"
                                alt="<?= e($row['nama']); ?>" width="70">
                        </td>
                        <td><?= e($row['nama']); ?></td>
                        <td><?= e($row['kategori']); ?></td>
                        <td><?= e(formatRupiah((float)$row['harga_beli'])); ?></td>
                        <td><?= e(formatRupiah((float)$row['harga_jual'])); ?></td>
                        <td><?= e((string)$row['stok']); ?></td>
                        <td>
                            <a href="index.php?page=user/edit&id=<?= (int)$row['id_barang']; ?>">
                                Ubah
                            </a> |
                            <form action="index.php?page=user/delete" method="POST"
                             onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                             <input type="hidden" name="id"
                             value="<?= (int)$row['id_barang']; ?>">
                             <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Belum ada data barang.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</section>
