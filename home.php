<?php
require_once __DIR__ . 'views/header.php';
require_once __DIR__ . 'helpers/helpers.php';
?>

<section class="content">
    <h2>Halaman Home</h2>

    <h3>Contoh Penggunaan Function PHP</h3>

    <p>Konversi 30 Celcius:
        <?php echo konversiCelciusKeFahrenheit(30); ?> Fahrenheit
    </p>

    <p>Nilai 90:
        <?php echo tentukanStatusNilai(90); ?>
    </p>

    <p>Total Belanja:
        <?php echo formatRupiah(hitungTotal(15000, 3)); ?>
    </p>

</section>

<?php require_once __DIR__ . '/footer.php'; ?>
