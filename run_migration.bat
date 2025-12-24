@echo off
REM =====================================================
REM Script untuk menjalankan SEMUA migration Laravel
REM Memperbaiki struktur tabel:
REM 1. pengumpulan_zakat
REM 2. distribusi_zakat
REM =====================================================

echo.
echo ========================================
echo  MENJALANKAN MIGRATION LARAVEL
echo ========================================
echo.

REM Tentukan path PHP (sesuaikan dengan versi PHP di Laragon)
set PHP_PATH=C:\laragon\bin\php\php-8.3.28-Win32-vs16-x64\php.exe

REM Cek apakah PHP ada
if not exist "%PHP_PATH%" (
    echo ERROR: PHP tidak ditemukan di %PHP_PATH%
    echo.
    echo Coba path lain:
    echo - C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.exe
    echo - C:\laragon\bin\php\php-7.4.33-Win32-vc15-x64\php.exe
    echo - C:\laragon\bin\php\php-8.5.0-Win32-vs17-x64\php.exe
    echo.
    echo Silakan edit file run_migration.bat dan sesuaikan PHP_PATH
    pause
    exit /b 1
)

echo PHP ditemukan: %PHP_PATH%
echo.

REM Masuk ke folder project
cd /d C:\laragon\www\distribusi-zakat

echo ========================================
echo  MIGRATION YANG AKAN DIJALANKAN:
echo ========================================
echo.
echo 1. update_pengumpulan_zakat_table_structure
echo    - Menghapus kolom: nama_muzakki (string)
echo    - Menambahkan kolom: muzakki_id (foreign key)
echo.
echo 2. update_distribusi_zakat_table_structure
echo    - Menghapus kolom: nama_mustahik (string)
echo    - Menambahkan kolom: mustahik_id (foreign key)
echo    - Menambahkan kolom: kategori_mustahik
echo    - Menambahkan kolom: jumlah_hak
echo    - Rename: jumlah_beras -> distribusi_beras
echo    - Rename: jumlah_uang -> distribusi_uang
echo.
echo ========================================
echo.

pause

echo.
echo Menjalankan migration...
echo.
"%PHP_PATH%" artisan migrate

echo.
echo ========================================
echo  MIGRATION SELESAI!
echo ========================================
echo.
echo Sekarang silakan test aplikasi:
echo.
echo PENGUMPULAN ZAKAT:
echo http://localhost/distribusi-zakat/public/pengumpulan_zakat/create
echo.
echo DISTRIBUSI ZAKAT:
echo http://localhost/distribusi-zakat/public/distribusi_zakat/create
echo.
echo ========================================
echo.
pause
