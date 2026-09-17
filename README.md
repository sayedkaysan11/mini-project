# Mini Project 1 - Product Information System

Tugas Pemrograman Web pertemuan 2. Bikin sistem informasi produk pakai PHP native, dipisah jadi 3 file sesuai arsitektur yang diajarin di kelas (Data Layer, Processing Layer, Presentation Layer).

## Isi file

- **products.php** - array data produk (id, nama, kategori, harga, stok, deskripsi)
- **functions.php** - fungsi buat hitung total nilai stok gudang, sama logika kalau stok kurang dari 3 dianggap kritis
- **index.php** - gabungin dua file di atas terus ditampilkan dalam bentuk tabel HTML

## Cara jalanin

Pakai XAMPP:
1. Copy semua file ke folder htdocs, misal `htdocs/mini-project`
2. Nyalain Apache dari XAMPP Control Panel
3. Buka browser, ketik `http://localhost/mini-project`

Atau kalau udah ada PHP terinstall, langsung aja jalankan:
```
php -S localhost:8000
```
terus buka `http://localhost:8000`

## Catatan

Baris tabel yang warnanya beda nandain stok yang mau habis (kurang dari 3) sama yang udah habis (0). Total nilai aset gudang dihitung dari harga dikali stok tiap produk, dijumlahin semua.

