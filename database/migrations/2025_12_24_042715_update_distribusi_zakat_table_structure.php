<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * PERBAIKAN STRUKTUR TABEL DISTRIBUSI_ZAKAT:
     * - Menghapus kolom 'nama_mustahik' (string)
     * - Menambahkan kolom 'mustahik_id' (foreign key ke tabel mustahik)
     * - Rename kolom 'jumlah_beras' menjadi 'distribusi_beras'
     * - Rename kolom 'jumlah_uang' menjadi 'distribusi_uang'
     * - Menambahkan kolom 'kategori_mustahik' (dari master mustahik)
     * - Menambahkan kolom 'jumlah_hak' (dari master mustahik)
     */
    public function up(): void
    {
        Schema::table('distribusi_zakat', function (Blueprint $table) {
            // STEP 1: Hapus kolom nama_mustahik jika ada
            if (Schema::hasColumn('distribusi_zakat', 'nama_mustahik')) {
                $table->dropColumn('nama_mustahik');
            }
            
            // STEP 2: Tambahkan kolom mustahik_id jika belum ada
            if (!Schema::hasColumn('distribusi_zakat', 'mustahik_id')) {
                $table->unsignedBigInteger('mustahik_id')->after('id');
                
                // Tambahkan foreign key constraint
                $table->foreign('mustahik_id')
                      ->references('id')
                      ->on('mustahik')
                      ->onDelete('cascade');
            }

            // STEP 3: Tambahkan kolom kategori_mustahik jika belum ada
            if (!Schema::hasColumn('distribusi_zakat', 'kategori_mustahik')) {
                $table->string('kategori_mustahik')->nullable()->after('mustahik_id');
            }

            // STEP 4: Tambahkan kolom jumlah_hak jika belum ada
            if (!Schema::hasColumn('distribusi_zakat', 'jumlah_hak')) {
                $table->integer('jumlah_hak')->nullable()->after('kategori_mustahik');
            }

            // STEP 5: Rename kolom jumlah_beras menjadi distribusi_beras jika perlu
            if (Schema::hasColumn('distribusi_zakat', 'jumlah_beras') && 
                !Schema::hasColumn('distribusi_zakat', 'distribusi_beras')) {
                $table->renameColumn('jumlah_beras', 'distribusi_beras');
            }

            // STEP 6: Rename kolom jumlah_uang menjadi distribusi_uang jika perlu
            if (Schema::hasColumn('distribusi_zakat', 'jumlah_uang') && 
                !Schema::hasColumn('distribusi_zakat', 'distribusi_uang')) {
                $table->renameColumn('jumlah_uang', 'distribusi_uang');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('distribusi_zakat', function (Blueprint $table) {
            // Hapus foreign key dan kolom mustahik_id
            if (Schema::hasColumn('distribusi_zakat', 'mustahik_id')) {
                $table->dropForeign(['mustahik_id']);
                $table->dropColumn('mustahik_id');
            }
            
            // Hapus kolom tambahan
            if (Schema::hasColumn('distribusi_zakat', 'kategori_mustahik')) {
                $table->dropColumn('kategori_mustahik');
            }

            if (Schema::hasColumn('distribusi_zakat', 'jumlah_hak')) {
                $table->dropColumn('jumlah_hak');
            }

            // Kembalikan kolom nama_mustahik
            if (!Schema::hasColumn('distribusi_zakat', 'nama_mustahik')) {
                $table->string('nama_mustahik')->after('id');
            }

            // Rename kembali jika perlu
            if (Schema::hasColumn('distribusi_zakat', 'distribusi_beras') && 
                !Schema::hasColumn('distribusi_zakat', 'jumlah_beras')) {
                $table->renameColumn('distribusi_beras', 'jumlah_beras');
            }

            if (Schema::hasColumn('distribusi_zakat', 'distribusi_uang') && 
                !Schema::hasColumn('distribusi_zakat', 'jumlah_uang')) {
                $table->renameColumn('distribusi_uang', 'jumlah_uang');
            }
        });
    }
};
