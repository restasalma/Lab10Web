
<?php
require_once __DIR__ . '/header.php';
require_once __DIR__ . '/helpers.php';
?>

<section class="content">
    <h2>Tentang Aplikasi</h2>

    <p>Halaman ini menjelaskan penggunaan function PHP modular.</p>

    <h3>Contoh Perhitungan</h3>

    <p>Harga Barang: <?php echo formatRupiah(200000); ?></p>

    <p>Diskon 10%:
        <?php echo formatRupiah(hitungDiskon(200000)); ?>
    </p>

    <p>Nilai 80:
        <?php echo tentukanStatusNilai(80); ?>
    </p>

</section>

<?php require_once __DIR__ . '/footer.php'; ?>


