<?php

function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}

echo "Diskon pertama: Rp " . hitungDiskon(200000);

echo "<br>";

echo "Diskon kedua: Rp " . hitungDiskon(200000, 15);

?>
