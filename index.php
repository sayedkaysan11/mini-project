<?php
/**
 * PRESENTATION LAYER
 * Merajut Data Layer dan Processing Layer, lalu merender data ke layout tabel HTML.
 */

require_once 'products.php';
require_once 'functions.php';

$totalNilaiStok = hitungTotalNilaiStok($products);
$jumlahProduk   = count($products);
$jumlahKritis   = hitungProdukKritis($products);
$daftarKategori = ambilKategori($products);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sistem Informasi Produk</title>
<style>
    :root {
        --ink: #16232e;
        --ink-muted: #5c6b77;
        --garis: #d6dde2;
        --kertas: #ffffff;
        --latar: #eceff1;
        --tanda-kritis: #a8480f;
        --tanda-habis: #8d2020;
    }

    * { box-sizing: border-box; }

    body {
        margin: 0;
        padding: 32px 20px 64px;
        background: var(--latar);
        color: var(--ink);
        font-family: "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        line-height: 1.55;
    }

    .wadah {
        max-width: 1040px;
        margin: 0 auto;
    }

    h1 {
        font-size: 1.75rem;
        font-weight: 650;
        letter-spacing: -0.01em;
        margin: 0 0 4px;
    }

    .keterangan {
        color: var(--ink-muted);
        margin: 0 0 28px;
        max-width: 62ch;
    }

    .ringkasan {
        display: flex;
        flex-wrap: wrap;
        gap: 1px;
        background: var(--garis);
        border: 1px solid var(--garis);
        margin-bottom: 28px;
    }

    .ringkasan div {
        flex: 1 1 200px;
        background: var(--kertas);
        padding: 16px 20px;
    }

    .ringkasan dt {
        font-size: 0.85rem;
        color: var(--ink-muted);
        margin-bottom: 6px;
    }

    .ringkasan dd {
        margin: 0;
        font-size: 1.35rem;
        font-weight: 600;
        font-variant-numeric: tabular-nums;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: var(--kertas);
        border: 1px solid var(--garis);
        font-size: 0.95rem;
    }

    caption {
        text-align: left;
        padding: 14px 18px;
        border: 1px solid var(--garis);
        border-bottom: 0;
        background: var(--kertas);
        font-weight: 600;
    }

    th, td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid var(--garis);
        vertical-align: top;
    }

    thead th {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--ink-muted);
        background: #f4f6f7;
    }

    .angka {
        text-align: right;
        font-variant-numeric: tabular-nums;
    }

    tbody tr:last-child td { border-bottom: 0; }

    tr.is-kritis { background: #fdf3ec; }
    tr.is-habis  { background: #fbecec; }

    tr.is-kritis td:first-child { box-shadow: inset 3px 0 0 var(--tanda-kritis); }
    tr.is-habis  td:first-child { box-shadow: inset 3px 0 0 var(--tanda-habis); }

    .status {
        font-size: 0.85rem;
        color: var(--ink-muted);
    }

    tr.is-kritis .status { color: var(--tanda-kritis); font-weight: 600; }
    tr.is-habis  .status { color: var(--tanda-habis); font-weight: 600; }

    .deskripsi {
        color: var(--ink-muted);
        font-size: 0.85rem;
        margin-top: 4px;
        max-width: 42ch;
    }

    tfoot td {
        font-weight: 600;
        background: #f4f6f7;
    }

    .catatan {
        margin-top: 20px;
        color: var(--ink-muted);
        font-size: 0.9rem;
    }

    @media (max-width: 720px) {
        .deskripsi { display: none; }
        th, td { padding: 10px 12px; }
    }
</style>
</head>
<body>
<div class="wadah">

    <h1>Sistem Informasi Produk</h1>
    <p class="keterangan">
        Rekap data komoditas gudang beserta nilai asetnya. Baris yang ditandai berarti stok
        tersisa di bawah <?= BATAS_STOK_KRITIS ?> unit dan perlu segera dipesan ulang.
    </p>

    <dl class="ringkasan">
        <div>
            <dt>Jenis produk</dt>
            <dd><?= $jumlahProduk ?></dd>
        </div>
        <div>
            <dt>Total nilai stok</dt>
            <dd><?= formatRupiah($totalNilaiStok) ?></dd>
        </div>
        <div>
            <dt>Perlu restock</dt>
            <dd><?= $jumlahKritis ?></dd>
        </div>
        <div>
            <dt>Kategori</dt>
            <dd><?= count($daftarKategori) ?></dd>
        </div>
    </dl>

    <table>
        <caption>Daftar komoditas produk</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama produk</th>
                <th>Kategori</th>
                <th class="angka">Harga</th>
                <th class="angka">Stok</th>
                <th class="angka">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr class="<?= kelasBarisStok($product) ?>">
                <td><?= htmlspecialchars($product['id']) ?></td>
                <td>
                    <?= htmlspecialchars($product['nama']) ?>
                    <div class="deskripsi"><?= htmlspecialchars($product['deskripsi']) ?></div>
                </td>
                <td><?= htmlspecialchars($product['kategori']) ?></td>
                <td class="angka"><?= formatRupiah($product['harga']) ?></td>
                <td class="angka">
                    <?= $product['stok'] ?>
                    <div class="status"><?= labelStatusStok($product) ?></div>
                </td>
                <td class="angka"><?= formatRupiah($product['harga'] * $product['stok']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Total nilai aset gudang</td>
                <td class="angka"><?= formatRupiah($totalNilaiStok) ?></td>
            </tr>
        </tfoot>
    </table>

    <p class="catatan">Pemrograman Web — Mini Project 1</p>

</div>
</body>
</html>
