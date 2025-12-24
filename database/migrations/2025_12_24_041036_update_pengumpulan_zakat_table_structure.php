<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * PERBAIKAN STRUKTUR TABEL PENGUMPULAN_ZAKAT:
     * - Menghapus kolom 'nama_muzakki' (string)
     * - Menambahkan kolom 'muzakki_id' (foreign key ke tabel muzakki)
     * - Ini untuk normalisasi database dan relasi yang benar
     */
    public function up(): void
    {
        Schema::table('pengumpulan_zakat', function (Blueprint $table) {
            // Cek apakah kolom nama_muzakki ada
            if (Schema::hasColumn('pengumpulan_zakat', 'nama_muzakki')) {
                // Hapus kolom nama_muzakki (data lama)
                $table->dropColumn('nama_muzakki');
            }
            
            // Cek apakah kolom muzakki_id belum ada
            if (!Schema::hasColumn('pengumpulan_zakat', 'muzakki_id')) {
                // Tambahkan kolom muzakki_id sebagai foreign key
                $table->unsignedBigInteger('muzakki_id')->after('id');
                
                // Tambahkan foreign key constraint
                $table->foreign('muzakki_id')
                      ->references('id')
                      ->on('muzakki')
                      ->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengumpulan_zakat', function (Blueprint $table) {
            // Hapus foreign key dan kolom muzakki_id
            if (Schema::hasColumn('pengumpulan_zakat', 'muzakki_id')) {
                $table->dropForeign(['muzakki_id']);
                $table->dropColumn('muzakki_id');
            }
            
            // Kembalikan kolom nama_muzakki
            if (!Schema::hasColumn('pengumpulan_zakat', 'nama_muzakki')) {
                $table->string('nama_muzakki')->after('id');
            }
        });
    }
};
