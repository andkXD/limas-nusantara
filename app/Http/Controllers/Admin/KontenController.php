<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KontenController extends Controller
{
    public function index()
    {
        $kontens = Konten::with('admin')
            ->orderByDesc('tanggal_publikasi')
            ->paginate(10);

        return view('admin.konten.index', compact('kontens'));
    }

    public function create()
    {
        return view('admin.konten.form', ['konten' => new Konten()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_konten' => 'required|string|max:255',
            'jenis_konten' => 'required|in:E-kliping,Newsletter,Kegiatan',
            'isi_konten' => 'nullable|string',
            'tanggal_publikasi' => 'required|date',
        ]);

        $data['id_admin'] = Auth::guard('admin')->id();

        Konten::create($data);

        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil dipublikasikan.');
    }

    public function show(Konten $konten)
    {
        return view('admin.konten.show', compact('konten'));
    }

    public function edit(Konten $konten)
    {
        return view('admin.konten.form', compact('konten'));
    }

    public function update(Request $request, Konten $konten)
    {
        $data = $request->validate([
            'judul_konten' => 'required|string|max:255',
            'jenis_konten' => 'required|in:E-kliping,Newsletter,Kegiatan',
            'isi_konten' => 'nullable|string',
            'tanggal_publikasi' => 'required|date',
        ]);

        $konten->update($data);

        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil diperbarui.');
    }

    public function destroy(Konten $konten)
    {
        $konten->delete();
        return redirect()->route('admin.konten.index')->with('success', 'Konten berhasil dihapus.');
    }
}