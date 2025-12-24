<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DistribusiZakat;
use App\Models\JumlahZakat;
use App\Models\Mustahik;
use Illuminate\Http\Request;

class DistribusiZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menggunakan eager loading untuk performa lebih baik
        $items = DistribusiZakat::with('mustahik')->get();

        return view('pages.backend.distribusi_zakat.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ✅ DEBUG: Cek apakah data mustahik ada
        $mustahiks = Mustahik::all();
        
        // ✅ DEBUG: Log jumlah mustahik
        \Log::info('=== DEBUG CREATE DISTRIBUSI ZAKAT ===');
        \Log::info('Total Mustahik: ' . $mustahiks->count());
        
        // ✅ DEBUG: Log data mustahik (5 pertama)
        if ($mustahiks->count() > 0) {
            \Log::info('Sample Mustahik:');
            foreach ($mustahiks->take(5) as $mustahik) {
                \Log::info('- ID: ' . $mustahik->id . ', NIK: ' . $mustahik->nik . ', Nama: ' . $mustahik->nama_mustahik);
            }
        } else {
            \Log::warning('⚠️ TABEL MUSTAHIK KOSONG! Silakan isi data mustahik terlebih dahulu.');
        }
        
        // ✅ DEBUG: Cek apakah view mendapat data
        \Log::info('Passing $mustahiks ke view dengan total: ' . $mustahiks->count() . ' data');
        \Log::info('=====================================');

        return view('pages.backend.distribusi_zakat.create', compact('mustahiks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // KONFIGURASI NILAI ZAKAT (Bisa dipindahkan ke config/database nantinya)
        $ZAKAT_BERAS_PER_JIWA = 2.5; // Kg
        $ZAKAT_UANG_PER_JIWA = 40000; // Rupiah

        // ✅ VALIDASI LENGKAP SEMUA FIELD
        $validated = $request->validate([
            'mustahik_id' => 'required|exists:mustahik,id',
            'jenis_zakat' => 'required|in:Beras,Uang',
            'distribusi_beras' => 'nullable|numeric|min:0',
            'distribusi_uang' => 'nullable|integer|min:0',
        ], [
            'mustahik_id.required' => 'Mustahik harus dipilih',
            'mustahik_id.exists' => 'Mustahik yang dipilih tidak valid',
            'jenis_zakat.required' => 'Jenis zakat harus dipilih',
            'jenis_zakat.in' => 'Jenis zakat harus Beras atau Uang',
        ]);

        // Memulai transaksi
        DB::beginTransaction();

        try {
            // ✅ AMBIL DATA MUSTAHIK DARI DATABASE
            $mustahik = Mustahik::findOrFail($validated['mustahik_id']);
            
            // Hitung batasan maksimal
            $maxBeras = $mustahik->jumlah_hak * $ZAKAT_BERAS_PER_JIWA;
            $maxUang = $mustahik->jumlah_hak * $ZAKAT_UANG_PER_JIWA;

            // ✅ VALIDASI: DISTRIBUSI BERAS ATAU UANG HARUS TERISI SESUAI JENIS
            if ($validated['jenis_zakat'] === 'Beras') {
                if (empty($validated['distribusi_beras']) || $validated['distribusi_beras'] <= 0) {
                    DB::rollback();
                    return redirect()->back()->withInput()
                        ->withErrors(['distribusi_beras' => 'Jumlah beras harus diisi lebih dari 0']);
                }
                
                // Pastikan field uang kosong
                if (!empty($validated['distribusi_uang']) && $validated['distribusi_uang'] > 0) {
                     DB::rollback();
                     return redirect()->back()->withInput()
                        ->withErrors(['distribusi_uang' => 'Field uang harus kosong jika memilih jenis zakat Beras']);
                }

                // Cek Max Beras
                if ($validated['distribusi_beras'] > $maxBeras) {
                    DB::rollback();
                    return redirect()->back()->withInput()
                        ->withErrors(['distribusi_beras' => "Melebihi batas maksimal! Maksimal untuk {$mustahik->jumlah_hak} jiwa adalah {$maxBeras} Kg ({$mustahik->jumlah_hak} jiwa x {$ZAKAT_BERAS_PER_JIWA} Kg)"]);
                }
            }

            if ($validated['jenis_zakat'] === 'Uang') {
                if (empty($validated['distribusi_uang']) || $validated['distribusi_uang'] <= 0) {
                    DB::rollback();
                    return redirect()->back()->withInput()
                        ->withErrors(['distribusi_uang' => 'Nominal uang harus diisi lebih dari 0']);
                }

                // Pastikan field beras kosong
                if (!empty($validated['distribusi_beras']) && $validated['distribusi_beras'] > 0) {
                     DB::rollback();
                     return redirect()->back()->withInput()
                        ->withErrors(['distribusi_beras' => 'Field beras harus kosong jika memilih jenis zakat Uang']);
                }

                // Cek Max Uang
                if ($validated['distribusi_uang'] > $maxUang) {
                    DB::rollback();
                    $formattedMax = number_format($maxUang, 0, ',', '.');
                    $formattedRate = number_format($ZAKAT_UANG_PER_JIWA, 0, ',', '.');
                    return redirect()->back()->withInput()
                        ->withErrors(['distribusi_uang' => "Melebihi batas maksimal! Maksimal untuk {$mustahik->jumlah_hak} jiwa adalah Rp {$formattedMax} ({$mustahik->jumlah_hak} jiwa x Rp {$formattedRate})"]);
                }
            }

            // ✅ CEK STOK JUMLAH ZAKAT
            $jumlahZakat = JumlahZakat::first();
            if (!$jumlahZakat) {
                DB::rollback();
                return redirect()->back()->withInput()
                    ->with('error', 'Data stok zakat belum diinisialisasi. Hubungi Admin.');
            }

            // Validasi stok
            if ($validated['jenis_zakat'] === 'Beras') {
                if ($jumlahZakat->jumlah_beras < $validated['distribusi_beras']) {
                    DB::rollback();
                    return redirect()->back()->withInput()
                        ->withErrors(['distribusi_beras' => 'Stok beras tidak cukup. Tersedia: ' . $jumlahZakat->jumlah_beras . ' Kg']);
                }
            } else {
                if ($jumlahZakat->jumlah_uang < $validated['distribusi_uang']) {
                    DB::rollback();
                    return redirect()->back()->withInput()
                        ->withErrors(['distribusi_uang' => 'Stok uang tidak cukup. Tersedia: Rp ' . number_format($jumlahZakat->jumlah_uang, 0, ',', '.')]);
                }
            }

            // ✅ SIMPAN DATA KE DISTRIBUSI ZAKAT
            $distribusiZakat = DistribusiZakat::create([
                'mustahik_id' => $validated['mustahik_id'],
                'kategori_mustahik' => $mustahik->kategori_mustahik,
                'jumlah_hak' => $mustahik->jumlah_hak,
                'jenis_zakat' => $validated['jenis_zakat'],
                'distribusi_beras' => $validated['jenis_zakat'] === 'Beras' ? $validated['distribusi_beras'] : 0,
                'distribusi_uang' => $validated['jenis_zakat'] === 'Uang' ? $validated['distribusi_uang'] : 0,
            ]);

            // ✅ UPDATE STOK
            if ($validated['jenis_zakat'] === 'Beras') {
                $jumlahZakat->jumlah_beras -= $validated['distribusi_beras'];
            } else {
                $jumlahZakat->jumlah_uang -= $validated['distribusi_uang'];
            }
            $jumlahZakat->total_distribusi += 1;
            $jumlahZakat->save();

            // Commit transaksi jika sukses
            DB::commit();

            return redirect()->route('distribusi_zakat.index')
                ->with('success', 'Distribusi zakat berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Error store distribusi zakat: ' . $e->getMessage());
            return redirect()->back()->withInput()
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = DistribusiZakat::findOrFail($id);
        $mustahiks = Mustahik::all();

        return view('pages.backend.distribusi_zakat.edit', [
            'item' => $item,
            'mustahiks' => $mustahiks
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'mustahik_id' => 'required|exists:mustahik,id',
            'jenis_zakat' => 'required|in:Beras,Uang',
            'distribusi_beras' => 'nullable|numeric|min:0',
            'distribusi_uang' => 'nullable|integer|min:0',
        ]);

        $item = DistribusiZakat::findOrFail($id);
        $item->update($validated);

        return redirect()->route('distribusi_zakat.index')
            ->with('success', 'Data distribusi zakat berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = DistribusiZakat::findOrFail($id);
        $item->delete();

        return redirect()->route('distribusi_zakat.index')
            ->with('success', 'Data distribusi zakat berhasil dihapus!');
    }
}
