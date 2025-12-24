<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\JumlahZakat;
use App\Models\Muzakki;
use Illuminate\Http\Request;
use App\Models\PengumpulanZakat;

class PengumpulanZakatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Menggunakan eager loading untuk performa lebih baik
        $items = PengumpulanZakat::with('muzakki')->get();

        return view('pages.backend.pengumpulan_zakat.index', [
            'items' => $items
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $muzakkis = Muzakki::all();

        return view('pages.backend.pengumpulan_zakat.create', compact('muzakkis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ✅ VALIDASI LENGKAP SEMUA FIELD
        $validated = $request->validate([
            'muzakki_id' => 'required|exists:muzakki,id',
            'jumlah_tanggungandibayar' => 'required|integer|min:1',
            'jenis_bayar' => 'required|in:Beras,Uang',
            'bayar_beras' => 'nullable|numeric|min:0',
            'bayar_uang' => 'nullable|integer|min:0',
        ], [
            'muzakki_id.required' => 'Muzakki harus dipilih',
            'muzakki_id.exists' => 'Muzakki yang dipilih tidak valid',
            'jumlah_tanggungandibayar.required' => 'Jumlah tanggungan yang dibayar harus diisi',
            'jumlah_tanggungandibayar.min' => 'Jumlah tanggungan yang dibayar minimal 1',
            'jenis_bayar.required' => 'Jenis bayar harus dipilih',
            'jenis_bayar.in' => 'Jenis bayar harus Beras atau Uang',
        ]);

        // Memulai transaksi
        DB::beginTransaction();

        try {
            // ✅ AMBIL JUMLAH TANGGUNGAN DARI DATABASE (BUKAN DARI USER INPUT)
            // Ini untuk mencegah manipulasi form oleh user
            $muzakki = Muzakki::findOrFail($validated['muzakki_id']);
            
            // ✅ VALIDASI: JUMLAH DIBAYAR TIDAK BOLEH LEBIH DARI JUMLAH TANGGUNGAN
            if ($validated['jumlah_tanggungandibayar'] > $muzakki->jumlah_tanggungan) {
                DB::rollback();
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['jumlah_tanggungandibayar' => 'Jumlah tanggungan yang dibayar tidak boleh lebih dari jumlah tanggungan (' . $muzakki->jumlah_tanggungan . ')']);
            }

            // ✅ VALIDASI: BAYAR BERAS ATAU BAYAR UANG HARUS TERISI SESUAI JENIS
            if ($validated['jenis_bayar'] === 'Beras' && empty($validated['bayar_beras'])) {
                DB::rollback();
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['bayar_beras' => 'Bayar beras harus diisi jika jenis bayar adalah Beras']);
            }

            if ($validated['jenis_bayar'] === 'Uang' && empty($validated['bayar_uang'])) {
                DB::rollback();
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['bayar_uang' => 'Bayar uang harus diisi jika jenis bayar adalah Uang']);
            }

            // ✅ SIMPAN DATA KE PENGUMPULAN ZAKAT
            $pengumpulanZakat = PengumpulanZakat::create([
                'muzakki_id' => $validated['muzakki_id'],
                'jumlah_tanggungan' => $muzakki->jumlah_tanggungan, // ✅ Dari database, bukan user input
                'jumlah_tanggungandibayar' => $validated['jumlah_tanggungandibayar'],
                'jenis_bayar' => $validated['jenis_bayar'],
                'bayar_beras' => $validated['jenis_bayar'] === 'Beras' ? $validated['bayar_beras'] : 0,
                'bayar_uang' => $validated['jenis_bayar'] === 'Uang' ? $validated['bayar_uang'] : 0,
            ]);

            // ✅ UPDATE TABEL JUMLAH ZAKAT
            $jumlahZakat = JumlahZakat::first();
            if ($jumlahZakat) {
                if ($validated['jenis_bayar'] === 'Beras') {
                    $jumlahZakat->jumlah_beras += $validated['bayar_beras'];
                    $jumlahZakat->total_beras += $validated['bayar_beras'];
                } else {
                    $jumlahZakat->jumlah_uang += $validated['bayar_uang'];
                    $jumlahZakat->total_uang += $validated['bayar_uang'];
                }
                $jumlahZakat->total_distribusi += 1;
                $jumlahZakat->save();
            }

            // Commit transaksi jika sukses
            DB::commit();

            // Mengembalikan respon dengan pesan sukses
            return redirect()->route('pengumpulan_zakat.index')
                ->with('success', 'Data pengumpulan zakat dari ' . $muzakki->nama_muzakki . ' berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            DB::rollback();

            // Log error untuk debugging
            \Log::error('Error saat menyimpan pengumpulan zakat: ' . $e->getMessage());

            // Mengembalikan respon dengan pesan error
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan pengumpulan zakat. Silakan coba lagi. Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = PengumpulanZakat::findOrFail($id);
        $muzakkis = Muzakki::all();

        return view('pages.backend.pengumpulan_zakat.edit', [
            'item' => $item,
            'muzakkis' => $muzakkis
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = PengumpulanZakat::findOrFail($id);

        $item->update($data);

        return redirect()->route('pengumpulan_zakat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = PengumpulanZakat::findOrFail($id);
        $item->delete();

        return redirect()->route('pengumpulan_zakat.index');
    }
}
