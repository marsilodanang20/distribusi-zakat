-- =====================================================
-- SCRIPT CEK & DEBUG TABEL MUSTAHIK
-- =====================================================

-- STEP 1: Cek apakah tabel mustahik ada
SHOW TABLES LIKE 'mustahik';

-- STEP 2: Cek struktur tabel mustahik
DESCRIBE mustahik;

-- STEP 3: Cek jumlah data di tabel mustahik
SELECT COUNT(*) as total_mustahik FROM mustahik;

-- STEP 4: Tampilkan semua data mustahik (jika ada)
SELECT * FROM mustahik;

-- =====================================================
-- JIKA TABEL KOSONG, INSERT DATA SAMPLE
-- =====================================================

-- Hapus data lama (jika ada)
-- TRUNCATE TABLE mustahik;

-- Insert data sample mustahik
INSERT INTO mustahik (nik, nama, kategori_mustahik, jumlah_hak, alamat, no_telp, created_at, updated_at) VALUES
('3201010101010001', 'Ahmad Fauzi', 'Fakir', 10, 'Jl. Merdeka No. 1', '081234567890', NOW(), NOW()),
('3201010101010002', 'Siti Nurhaliza', 'Miskin', 8, 'Jl. Kebon Jeruk No. 5', '081234567891', NOW(), NOW()),
('3201010101010003', 'Budi Santoso', 'Fisabilillah', 12, 'Jl. Raya Cirebon No. 10', '081234567892', NOW(), NOW()),
('3201010101010004', 'Dewi Lestari', 'Fakir', 6, 'Jl. Sudirman No. 15', '081234567893', NOW(), NOW()),
('3201010101010005', 'Eko Prasetyo', 'Miskin', 7, 'Jl. Ahmad Yani No. 20', '081234567894', NOW(), NOW());

-- Verifikasi data sudah masuk
SELECT * FROM mustahik;

-- =====================================================
-- CEK RELASI KE DISTRIBUSI_ZAKAT
-- =====================================================

-- Cek apakah ada data distribusi_zakat
SELECT COUNT(*) as total_distribusi FROM distribusi_zakat;

-- Cek data distribusi_zakat dengan join ke mustahik
SELECT 
    dz.id,
    dz.mustahik_id,
    m.nik,
    m.nama,
    m.kategori_mustahik,
    m.jumlah_hak,
    dz.jenis_zakat,
    dz.distribusi_beras,
    dz.distribusi_uang
FROM distribusi_zakat dz
LEFT JOIN mustahik m ON dz.mustahik_id = m.id;

-- =====================================================
-- INFO:
-- Jika query di atas tidak error dan menampilkan data,
-- berarti struktur database sudah benar!
-- =====================================================
