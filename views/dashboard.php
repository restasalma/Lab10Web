<section class="content">
    <h2>Dashboard</h2>

    <p>Selamat datang di Aplikasi PHP Modular.</p>

    <p>
        Aplikasi ini dibuat untuk mempraktikkan
        modularisasi program menggunakan PHP.
    </p>
</section>
<section class="content">
    <h2>Pengujian Function PHP</h2>

    <h3>1. Validasi Email</h3>
    <?php
    $email = "mahasiswa@gmail.com";

    if (validasiEmail($email)) {
        echo "Email valid: " . e($email);
    } else {
        echo "Email tidak valid";
    }
    ?>

    <h3>2. Ringkas Teks</h3>
    <?php
    $teks = "Pemrograman Web merupakan mata kuliah yang mempelajari pembuatan aplikasi berbasis web.";

    echo e(ringkasTeks($teks, 40));
    ?>
</section>