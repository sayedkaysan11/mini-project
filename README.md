# Product Information System

Mini Project 1 — Pemrograman Web. Sistem informasi produk sederhana berbasis PHP native
dengan pemisahan tiga lapis arsitektur.

## Struktur berkas

| Berkas | Lapisan | Isi |
| --- | --- | --- |
| `products.php` | Data Layer | Multidimensional array data komoditas produk (ID, Nama, Kategori, Harga, Stok, Deskripsi) |
| `functions.php` | Processing Layer | `hitungTotalNilaiStok()` dan logika conditional penanda stok kritis (< 3) |
| `index.php` | Presentation Layer | Merakit kedua lapisan dengan `require_once`, merender tabel HTML lewat `foreach` |

## Cara menjalankan

Dengan PHP built-in server:

```bash
php -S localhost:8000
```

Lalu buka `http://localhost:8000` di browser.

Atau letakkan folder ini di `htdocs` (XAMPP) / `www` (Laragon), lalu buka
`http://localhost/nama-folder`.

## Aturan tampilan

- Stok di bawah 3 unit: baris ditandai oranye dengan status "Segera restock".
- Stok 0: baris ditandai merah dengan status "Habis".
- Nilai aset gudang dihitung dari penjumlahan `harga x stok` seluruh produk.
