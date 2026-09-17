<?php
/**
 * PROCESSING LAYER
 * Berisi seluruh logika perhitungan dan penyaringan data.
 * Tidak ada data mentah maupun tampilan HTML di berkas ini.
 */

define('BATAS_STOK_KRITIS', 3);

/**
 * Menghitung total nilai aset gudang: (harga x stok) dari seluruh produk.
 */
function hitungTotalNilaiStok(array $products): int
{
    $total = 0;

    foreach ($products as $product) {
        $total += $product['harga'] * $product['stok'];
    }

    return $total;
}

/**
 * Menentukan apakah sebuah produk berstatus stok kritis (< 3).
 */
function isStokKritis(array $product): bool
{
    return $product['stok'] < BATAS_STOK_KRITIS;
}

/**
 * Mengembalikan kelas CSS baris tabel berdasarkan kondisi stok.
 * Inilah logika conditional untuk menyaring warna baris tabel.
 */
function kelasBarisStok(array $product): string
{
    if ($product['stok'] === 0) {
        return 'is-habis';
    }

    return isStokKritis($product) ? 'is-kritis' : '';
}

/**
 * Label status stok yang mudah dibaca pengguna.
 */
function labelStatusStok(array $product): string
{
    if ($product['stok'] === 0) {
        return 'Habis';
    }

    return isStokKritis($product) ? 'Segera restock' : 'Aman';
}

/**
 * Menghitung jumlah produk yang stoknya di bawah batas kritis.
 */
function hitungProdukKritis(array $products): int
{
    $jumlah = 0;

    foreach ($products as $product) {
        if (isStokKritis($product)) {
            $jumlah++;
        }
    }

    return $jumlah;
}

/**
 * Mengambil daftar kategori unik dari data produk.
 */
function ambilKategori(array $products): array
{
    $kategori = [];

    foreach ($products as $product) {
        if (!in_array($product['kategori'], $kategori, true)) {
            $kategori[] = $product['kategori'];
        }
    }

    return $kategori;
}

/**
 * Memformat angka menjadi format mata uang Rupiah.
 */
function formatRupiah(int $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
