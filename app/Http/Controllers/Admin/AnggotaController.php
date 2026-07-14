<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('q');

        $anggotas = Anggota::when($keyword, function ($query) use ($keyword) {
                $query->where('nama_anggota', 'like', "%{$keyword}%")
                      ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->orderBy('nama_anggota')
            ->paginate(10)
            ->withQueryString();

        return view('admin.anggota.index', compact('anggotas', 'keyword'));
    }

    public function create()
    {
        return view('admin.anggota.form', ['anggota' => new Anggota()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_anggota' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:anggotas,email',
            'password' => 'required|min:6',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['status_keanggotaan'] = 'Aktif';

        Anggota::create($data);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil didaftarkan.');
    }

    public function edit(Anggota $anggotum)
    {
        return view('admin.anggota.form', ['anggota' => $anggotum]);
    }

    public function update(Request $request, Anggota $anggotum)
    {
        $data = $request->validate([
            'nama_anggota' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:anggotas,email,' . $anggotum->id_anggota . ',id_anggota',
            'password' => 'nullable|min:6',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $anggotum->update($data);

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function toggleStatus(Anggota $anggotum)
    {
        $anggotum->update([
            'status_keanggotaan' => $anggotum->status_keanggotaan === 'Aktif' ? 'Nonaktif' : 'Aktif',
        ]);

        return redirect()->route('admin.anggota.index')->with('success', 'Status keanggotaan berhasil diubah.');
    }
}