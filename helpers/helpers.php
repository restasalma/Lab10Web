<?php

// Mengubah angka menjadi format Rupiah
function formatRupiah(float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Menghitung diskon
function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}

// Mengamankan teks sebelum ditampilkan ke HTML
function e(string $nilai): string {
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

// Mengubah Celcius menjadi Fahrenheit
function konversiCelciusKeFahrenheit($c) {
    return ($c * 9 / 5) + 32;
}

// Menentukan predikat berdasarkan nilai
function tentukanStatusNilai($nilai) {
    if ($nilai >= 85) {
        return "A (Sangat Baik)";
    } elseif ($nilai >= 75) {
        return "B (Baik)";
    } elseif ($nilai >= 60) {
        return "C (Cukup)";
    } else {
        return "D (Kurang)";
    }
}

// Menghitung total belanja
function hitungTotal($harga, $jumlah) {
    return $harga * $jumlah;
}

// Memvalidasi alamat email
function validasiEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Meringkas teks berdasarkan jumlah karakter
function ringkasTeks(string $teks, int $maksimal = 50): string {
    if (strlen($teks) <= $maksimal) {
        return $teks;
    }

    return substr($teks, 0, $maksimal) . '...';
}
?>
