<?php

function hitungTotalNilaiStok(array $katalog): int
{
    $total = 0;

    foreach ($katalog as $produk) {
        $total += $produk['harga'] * $produk['stok'];
    }

    return $total;
}

function formatRupiah(int|float $nilai): string
{
    return 'Rp ' . number_format($nilai, 0, ',', '.');
}

function statusStok(int $stok): string
{
    if ($stok === 0) {
        return 'Habis';
    }

    if ($stok < 3) {
        return 'Kritis';
    }

    return 'Aman';
}

function warnaBarisStok(int $stok): string
{
    return $stok < 3 ? 'stok-kritis' : '';
}
