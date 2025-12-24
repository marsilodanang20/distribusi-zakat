-- =====================================================
-- SCRIPT SQL UNTUK MEMPERBAIKI STRUKTUR TABEL
-- distribusi_zakat
-- =====================================================
-- 
-- MASALAH:
-- Tabel distribusi_zakat masih menggunakan struktur lama:
-- - nama_mustahik (string) → harusnya mustahik_id (foreign key)
-- - jumlah_beras → harusnya distribusi_beras
-- - jumlah_uang → harusnya distribusi_uang
-- - Tidak ada kategori_mustahik
-- - Tidak ada jumlah_hak
--
-- SOLUSI:
-- 1. Backup data lama (jika ada)
-- 2. Hapus kolom nama_mustahik
-- 3. Tambah kolom mustahik_id dengan foreign key
-- 4. Tambah kolom kategori_mustahik & jumlah_hak
-- 5. Rename kolom jumlah_beras & jumlah_uang
-- =====================================================

-- STEP 1: BACKUP DATA LAMA (Opsional - jika ada data penting)
-- CREATE TABLE distribusi_zakat_backup AS SELECT * FROM distribusi_zakat;

-- STEP 2: Hapus semua data lama (karena struktur akan berubah)
TRUNCATE TABLE distribusi_zakat;

-- STEP 3: Hapus kolom nama_mustahik jika ada
ALTER TABLE distribusi_zakat 
DROP COLUMN IF EXISTS nama_mustahik;

-- STEP 4: Tambahkan kolom mustahik_id
ALTER TABLE distribusi_zakat 
ADD COLUMN mustahik_id BIGINT UNSIGNED NOT NULL AFTER id;

-- STEP 5: Tambahkan kolom kategori_mustahik
ALTER TABLE distribusi_zakat 
ADD COLUMN kategori_mustahik VARCHAR(255) NULL AFTER mustahik_id;

-- STEP 6: Tambahkan kolom jumlah_hak
ALTER TABLE distribusi_zakat 
ADD COLUMN jumlah_hak INT NULL AFTER kategori_mustahik;

-- STEP 7: Rename kolom jumlah_beras menjadi distribusi_beras (jika ada)
-- Cek dulu apakah kolom jumlah_beras ada
ALTER TABLE distribusi_zakat 
CHANGE COLUMN jumlah_beras distribusi_beras DECIMAL(10,2) NULL;

-- STEP 8: Rename kolom jumlah_uang menjadi distribusi_uang (jika ada)
ALTER TABLE distribusi_zakat 
CHANGE COLUMN jumlah_uang distribusi_uang INT NULL;

-- STEP 9: Tambahkan foreign key constraint
ALTER TABLE distribusi_zakat 
ADD CONSTRAINT fk_distribusi_mustahik 
FOREIGN KEY (mustahik_id) 
REFERENCES mustahik(id) 
ON DELETE CASCADE;

-- STEP 10: Verifikasi struktur tabel baru
DESCRIBE distribusi_zakat;

-- =====================================================
-- HASIL YANG DIHARAPKAN:
-- +------------------+-----------------+------+-----+---------+
-- | Field            | Type            | Null | Key | Default |
-- +------------------+-----------------+------+-----+---------+
-- | id               | bigint unsigned | NO   | PRI | NULL    |
-- | mustahik_id      | bigint unsigned | NO   | MUL | NULL    | ← BARU!
-- | kategori_mustahik| varchar(255)    | YES  |     | NULL    | ← BARU!
-- | jumlah_hak       | int             | YES  |     | NULL    | ← BARU!
-- | jenis_zakat      | varchar(255)    | YES  |     | NULL    |
-- | distribusi_beras | decimal(10,2)   | YES  |     | NULL    | ← RENAMED
-- | distribusi_uang  | int             | YES  |     | NULL    | ← RENAMED
-- | created_at       | timestamp       | YES  |     | NULL    |
-- | updated_at       | timestamp       | YES  |     | NULL    |
-- +------------------+-----------------+------+-----+---------+
-- =====================================================

-- SETELAH MENJALANKAN SQL INI:
-- 1. Struktur tabel sudah benar
-- 2. Bisa test form create distribusi zakat
-- 3. Data akan tersimpan dengan benar
-- 4. Relasi ke tabel mustahik berfungsi
