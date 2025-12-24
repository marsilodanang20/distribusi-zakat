# 🚨 DATABASE FIX - DISTRIBUSI ZAKAT

## ❌ **MASALAH STRUKTUR DATABASE**

Tabel `distribusi_zakat` masih menggunakan struktur **LAMA**:

| Kolom Saat Ini | Masalah |
|---|---|
| `nama_mustahik` (string) | ❌ Harusnya `mustahik_id` (foreign key) |
| `jumlah_beras` | ❌ Harusnya `distribusi_beras` |
| `jumlah_uang` | ❌ Harusnya `distribusi_uang` |
| - | ❌ Tidak ada kolom `kategori_mustahik` |
| - | ❌ Tidak ada kolom `jumlah_hak` |

**DAMPAK:**
- ❌ Data tidak bisa tersimpan (field `mustahik_id` tidak ada)
- ❌ Relasi model error
- ❌ Controller validation gagal

---

## ✅ **SOLUSI - PERBAIKAN DATABASE**

### **SEMUA Migration yang Perlu Dijalankan:**

Ada **2 migration** yang harus dijalankan:

#### **1️⃣ update_pengumpulan_zakat_table_structure.php**
- ✅ Menghapus: `nama_muzakki` (string)
- ✅ Menambahkan: `muzakki_id` (foreign key ke muzakki)

#### **2️⃣ update_distribusi_zakat_table_structure.php** ← **BARU!**
- ✅ Menghapus: `nama_mustahik` (string)
- ✅ Menambahkan: `mustahik_id` (foreign key ke mustahik)
- ✅ Menambahkan: `kategori_mustahik` (varchar)
- ✅ Menambahkan: `jumlah_hak` (int)
- ✅ Rename: `jumlah_beras` → `distribusi_beras`
- ✅ Rename: `jumlah_uang` → `distribusi_uang`

---

## 🎯 **CARA MENJALANKAN MIGRATION**

### **CARA 1: Double-Click File BAT (PALING MUDAH)**

1. Buka File Explorer
2. Masuk folder: `C:\laragon\www\distribusi-zakat\`
3. **Double-click file:** `run_migration.bat`
4. Akan muncul info migration yang akan dijalankan
5. Tekan **Enter** untuk konfirmasi
6. Tunggu sampai selesai
7. Done! ✅

---

### **CARA 2: Jalankan SQL Manual**

Jika migration tidak bisa dijalankan, gunakan SQL script:

#### **Untuk Pengumpulan Zakat:**
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Pilih database: `distribusi_zakat`
3. Klik tab **SQL**
4. Copy-paste isi file: **`fix_database_structure.sql`**
5. Klik **Go**

#### **Untuk Distribusi Zakat:**
1. Buka phpMyAdmin: http://localhost/phpmyadmin
2. Pilih database: `distribusi_zakat`
3. Klik tab **SQL**
4. Copy-paste isi file: **`fix_distribusi_zakat_structure.sql`** ← **BARU!**
5. Klik **Go**

---

### **CARA 3: Via Terminal Laragon**

1. Buka **Laragon**
2. Klik **Menu** → **Terminal**
3. Ketik:
   ```bash
   php artisan migrate
   ```
4. Enter
5. Kedua migration akan dijalankan sekaligus

---

## 🧪 **VERIFIKASI DATABASE SETELAH MIGRATION**

### **Cek Tabel pengumpulan_zakat:**

```sql
DESCRIBE pengumpulan_zakat;
```

**✅ HASIL YANG DIHARAPKAN:**
```
+---------------------------+-----------------+------+-----+---------+
| Field                     | Type            | Null | Key | Default |
+---------------------------+-----------------+------+-----+---------+
| id                        | bigint unsigned | NO   | PRI | NULL    |
| muzakki_id                | bigint unsigned | NO   | MUL | NULL    | ← HARUS ADA!
| jumlah_tanggungan         | varchar(255)    | YES  |     | NULL    |
| jumlah_tanggungandibayar  | varchar(255)    | YES  |     | NULL    |
| jenis_bayar               | varchar(255)    | YES  |     | NULL    |
| bayar_beras               | int             | YES  |     | NULL    |
| bayar_uang                | int             | YES  |     | NULL    |
| created_at                | timestamp       | YES  |     | NULL    |
| updated_at                | timestamp       | YES  |     | NULL    |
+---------------------------+-----------------+------+-----+---------+
```

⚠️ **PENTING:** 
- ✅ HARUS ADA: `muzakki_id`
- ❌ TIDAK BOLEH ADA: `nama_muzakki`

---

### **Cek Tabel distribusi_zakat:**

```sql
DESCRIBE distribusi_zakat;
```

**✅ HASIL YANG DIHARAPKAN:**
```
+------------------+-----------------+------+-----+---------+
| Field            | Type            | Null | Key | Default |
+------------------+-----------------+------+-----+---------+
| id               | bigint unsigned | NO   | PRI | NULL    |
| mustahik_id      | bigint unsigned | NO   | MUL | NULL    | ← HARUS ADA!
| kategori_mustahik| varchar(255)    | YES  |     | NULL    | ← HARUS ADA!
| jumlah_hak       | int             | YES  |     | NULL    | ← HARUS ADA!
| jenis_zakat      | varchar(255)    | YES  |     | NULL    |
| distribusi_beras | decimal(10,2)   | YES  |     | NULL    | ← RENAMED!
| distribusi_uang  | int             | YES  |     | NULL    | ← RENAMED!
| created_at       | timestamp       | YES  |     | NULL    |
| updated_at       | timestamp       | YES  |     | NULL    |
+------------------+-----------------+------+-----+---------+
```

⚠️ **PENTING:** 
- ✅ HARUS ADA: `mustahik_id`, `kategori_mustahik`, `jumlah_hak`
- ✅ HARUS RENAMED: `distribusi_beras` (bukan `jumlah_beras`)
- ✅ HARUS RENAMED: `distribusi_uang` (bukan `jumlah_uang`)
- ❌ TIDAK BOLEH ADA: `nama_mustahik`, `jumlah_beras`, `jumlah_uang`

---

## 📂 **FILE YANG SUDAH DIBUAT**

| File | Lokasi | Fungsi |
|---|---|---|
| **Migration Pengumpulan Zakat** | `/database/migrations/2025_12_24_041036_*` | Fix tabel pengumpulan_zakat |
| **Migration Distribusi Zakat** | `/database/migrations/2025_12_24_042715_*` | Fix tabel distribusi_zakat |
| **SQL Pengumpulan Zakat** | `/fix_database_structure.sql` | SQL manual pengumpulan |
| **SQL Distribusi Zakat** | `/fix_distribusi_zakat_structure.sql` | SQL manual distribusi |
| **BAT Runner** | `/run_migration.bat` | Jalankan semua migration |

---

## 🚀 **SETELAH DATABASE DIPERBAIKI**

### **Test Pengumpulan Zakat:**
```
http://localhost/distribusi-zakat/public/pengumpulan_zakat/create
```

**Checklist:**
- [ ] Dropdown muzakki muncul (NIK - Nama)
- [ ] Pilih muzakki → jumlah tanggungan auto-fill
- [ ] Submit form → data tersimpan
- [ ] Index → data muncul dengan nama muzakki

---

### **Test Distribusi Zakat:**
```
http://localhost/distribusi-zakat/public/distribusi_zakat/create
```

**Checklist:**
- [ ] Dropdown mustahik muncul (NIK - Nama)
- [ ] Pilih mustahik → kategori & jumlah hak auto-fill
- [ ] Submit form → data tersimpan
- [ ] Index → data muncul dengan nama mustahik

---

## ⚠️ **TROUBLESHOOTING**

### **Error: "SQLSTATE[42S22]: Column not found: 'muzakki_id'"**
**Penyebab:** Migration pengumpulan_zakat belum dijalankan  
**Solusi:** Jalankan migration atau SQL manual

### **Error: "SQLSTATE[42S22]: Column not found: 'mustahik_id'"**
**Penyebab:** Migration distribusi_zakat belum dijalankan  
**Solusi:** Jalankan migration atau SQL manual

### **Error: "Cannot add foreign key constraint"**
**Penyebab:** Ada data lama yang tidak valid  
**Solusi:** Truncate tabel dulu
```sql
TRUNCATE TABLE pengumpulan_zakat;
TRUNCATE TABLE distribusi_zakat;
```

### **Error: "Column already exists"**
**Penyebab:** Migration sudah pernah dijalankan  
**Solusi:** Skip, tidak perlu dijalankan lagi

---

## 📊 **PERBANDINGAN: BEFORE vs AFTER**

### **Tabel distribusi_zakat**

#### **❌ BEFORE (SALAH):**
```sql
id | nama_mustahik | jenis_zakat | jumlah_beras | jumlah_uang
```

#### **✅ AFTER (BENAR):**
```sql
id | mustahik_id | kategori_mustahik | jumlah_hak | jenis_zakat | distribusi_beras | distribusi_uang
```

---

## ✅ **CHECKLIST FINAL**

Centang setelah selesai:

### **Database:**
- [ ] Migration pengumpulan_zakat sudah dijalankan
- [ ] Migration distribusi_zakat sudah dijalankan
- [ ] Tabel pengumpulan_zakat punya kolom `muzakki_id`
- [ ] Tabel distribusi_zakat punya kolom `mustahik_id`
- [ ] Tabel distribusi_zakat punya kolom `kategori_mustahik`
- [ ] Tabel distribusi_zakat punya kolom `jumlah_hak`
- [ ] Kolom `jumlah_beras` sudah jadi `distribusi_beras`
- [ ] Kolom `jumlah_uang` sudah jadi `distribusi_uang`

### **Testing:**
- [ ] Test pengumpulan zakat → auto-fill berfungsi
- [ ] Test pengumpulan zakat → data tersimpan
- [ ] Test distribusi zakat → auto-fill berfungsi
- [ ] Test distribusi zakat → data tersimpan

---

## 🎉 **SETELAH SEMUA LANGKAH:**

**✅ Database struktur BENAR**  
**✅ Pengumpulan Zakat BERFUNGSI**  
**✅ Distribusi Zakat BERFUNGSI**  
**✅ Data TERSIMPAN dengan relasi yang benar**  
**✅ Aplikasi SIAP PRODUCTION**

---

**Prioritas:** 🚨🚨🚨 URGENT  
**Status:** ⏳ Menunggu Anda jalankan migration  
**Dibuat:** 2025-12-24 04:27 WIB

**Jalankan migration SEKARANG, lalu test kedua form!** 🚀
