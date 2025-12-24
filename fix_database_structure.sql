-- =====================================================
-- SCRIPT SQL UNTUK MEMPERBAIKI STRUKTUR TABEL
-- pengumpulan_zakat
-- =====================================================
-- 
-- MASALAH:
-- Tabel pengumpulan_zakat masih menggunakan kolom 'nama_muzakki' (string)
-- Seharusnya menggunakan 'muzakki_id' (foreign key)
--
-- SOLUSI:
-- 1. Backup data lama (jika ada)
-- 2. Hapus kolom nama_muzakki
-- 3. Tambah kolom muzakki_id dengan foreign key
-- 4. Jalankan migration Laravel
-- =====================================================

-- STEP 1: BACKUP DATA LAMA (Opsional - jika ada data)
-- CREATE TABLE pengumpulan_zakat_backup AS SELECT * FROM pengumpulan_zakat;

-- STEP 2: Hapus semua data lama (karena struktur akan berubah)
TRUNCATE TABLE pengumpulan_zakat;

-- STEP 3: Hapus kolom nama_muzakki jika ada
ALTER TABLE pengumpulan_zakat 
DROP COLUMN IF EXISTS nama_muzakki;

-- STEP 4: Tambahkan kolom muzakki_id
ALTER TABLE pengumpulan_zakat 
ADD COLUMN muzakki_id BIGINT UNSIGNED NOT NULL AFTER id;

-- STEP 5: Tambahkan foreign key constraint
ALTER TABLE pengumpulan_zakat 
ADD CONSTRAINT fk_pengumpulan_muzakki 
FOREIGN KEY (muzakki_id) 
REFERENCES muzakki(id) 
ON DELETE CASCADE;

-- STEP 6: Verifikasi struktur tabel baru
DESCRIBE pengumpulan_zakat;

-- =====================================================
-- SETELAH MENJALANKAN SQL INI:
-- 1. Struktur tabel sudah benar
-- 2. Bisa test form create pengumpulan zakat
-- 3. Data akan tersimpan dengan benar
-- =====================================================
