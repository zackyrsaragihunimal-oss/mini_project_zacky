<?php

require_once __DIR__ . '/products.php';
require_once __DIR__ . '/functions.php';

$totalNilaiStok = hitungTotalNilaiStok($katalog);
$jumlahProduk = count($katalog);
$jumlahStok = array_sum(array_column($katalog, 'stok'));

?><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Information System</title>
    <style>
        :root { font-family: Arial, sans-serif; color: #1f2937; background: #f3f4f6; }
        body { max-width: 1180px; margin: 0 auto; padding: 32px 20px; }
        h1 { margin-bottom: 8px; color: #123b5d; }
        .subtitle { margin-top: 0; color: #64748b; }
        .summary { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin: 24px 0; }
        .card { background: white; border-radius: 12px; padding: 18px; box-shadow: 0 2px 10px #0000000d; }
        .label { display: block; color: #64748b; font-size: 14px; margin-bottom: 8px; }
        .value { font-size: 24px; font-weight: 700; color: #0f766e; }
        .table-wrap { overflow-x: auto; background: white; border-radius: 12px; box-shadow: 0 2px 10px #0000000d; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 14px 16px; border-bottom: 1px solid #e5e7eb; vertical-align: top; }
        th { background: #123b5d; color: white; }
        tr:last-child td { border-bottom: 0; }
        .stok-kritis { background: #fff1f2; }
        .badge { display: inline-block; border-radius: 999px; padding: 4px 10px; font-size: 12px; font-weight: 700; }
        .badge-kritis { color: #be123c; background: #ffe4e6; }
        .badge-aman { color: #166534; background: #dcfce7; }
        @media (max-width: 700px) { .summary { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <h1>Product Information System</h1>
    <p class="subtitle">Mini Project 1 - PHP Fundamental & Data Structure</p>

    <section class="summary">
        <div class="card"><span class="label">Jumlah Produk</span><span class="value"><?= $jumlahProduk ?></span></div>
        <div class="card"><span class="label">Total Unit Stok</span><span class="value"><?= $jumlahStok ?></span></div>
        <div class="card"><span class="label">Nilai Aset Gudang</span><span class="value"><?= formatRupiah($totalNilaiStok) ?></span></div>
    </section>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th>
                    <th>Stok</th><th>Status</th><th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($katalog as $produk): ?>
                    <?php $kritis = $produk['stok'] < 3; ?>
                    <tr class="<?= warnaBarisStok($produk['stok']) ?>">
                        <td><?= htmlspecialchars($produk['id']) ?></td>
                        <td><?= htmlspecialchars($produk['nama']) ?></td>
                        <td><?= htmlspecialchars($produk['kategori']) ?></td>
                        <td><?= formatRupiah($produk['harga']) ?></td>
                        <td><?= $produk['stok'] ?></td>
                        <td>
                            <span class="badge <?= $kritis ? 'badge-kritis' : 'badge-aman' ?>">
                                <?= statusStok($produk['stok']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($produk['deskripsi']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
