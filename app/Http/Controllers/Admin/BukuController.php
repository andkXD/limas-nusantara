<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');

        $bukus = Buku::when($keyword, function ($query) use ($keyword) {
                $query->where('judul_buku', 'like', "%{$keyword}%")
                      ->orWhere('pengarang', 'like', "%{$keyword}%");
            })
            ->orderBy('judul_buku')
            ->paginate(10)
            ->withQueryString();

        return view('admin.buku.index', compact('bukus', 'keyword'));
    }

    public function create()
    {
        return view('admin.buku.form', ['buku' => new Buku()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:150',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'kategori' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
        ]);

        Buku::create($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        return view('admin.buku.form', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:150',
            'penerbit' => 'required|string|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
            'kategori' => 'required|string|max:50',
            'stok' => 'required|integer|min:0',
        ]);

        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('admin.buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}