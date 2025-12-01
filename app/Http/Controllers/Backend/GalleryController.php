<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Gallery::orderBy('id', 'desc')->get();

        return view('pages.backend.galleries.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.backend.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'caption' => 'nullable|string|max:255',
        ]);

        // Upload file
        $filename = null;

        if ($request->hasFile('foto')) {

            $filename = time() . '-' . uniqid() . '.' . $request->file('foto')->extension();

            // simpan foto ke storage/app/public/images
            $request->file('foto')->storeAs('images', $filename, 'public');
        }

        // Simpan ke database
        Gallery::create([
            'foto' => $filename,
            'caption' => $request->caption,
        ]);

        return redirect()->route('galleries.index')
            ->with('success', 'Foto berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Gallery::findOrFail($id);

        return view('pages.backend.galleries.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = Gallery::findOrFail($id);

        $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'caption' => 'nullable|string|max:255',
        ]);

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if (!empty($item->foto) && Storage::disk('public')->exists('images/' . $item->foto)) {
                Storage::disk('public')->delete('images/' . $item->foto);
            }

            $newFile = time() . '-' . uniqid() . '.' . $request->file('foto')->extension();
            $request->file('foto')->storeAs('images', $newFile, 'public');

            $item->foto = $newFile;
        }

        // Update caption
        $item->caption = $request->caption;

        $item->save();

        return redirect()->route('galleries.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = Gallery::findOrFail($id);

        // Hapus foto di storage
        if (!empty($item->foto)) {

            $filePath = 'images/' . $item->foto;

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        // Hapus record database
        $item->delete();

        return redirect()->route('galleries.index')
            ->with('success', 'Foto berhasil dihapus.');
    }
}
