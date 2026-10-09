<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index()
    {
        $publikasi = Publikasi::all();

        return view('publikasi.index', compact('publikasi'));
    }

    public function create()
    {
        return view('publikasi.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul'         => 'required|string|max:255',
            'tanggal_rilis' => 'required|date',
            'sampul'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'deskripsi'     => 'nullable|string',
        ], [
            'sampul.max' => 'Ukuran file sampul maksimal 5MB. File lebih dari 5MB tidak diterima.',
        ]);

        if ($request->hasFile('sampul')) {
            $file = $request->file('sampul');
            $nama = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama);
            $data['sampul'] = $nama;
        }

        Publikasi::create($data);

        return redirect('/publikasi')->with('success', 'Publikasi berhasil ditambahkan.');
    }

    public function edit(Publikasi $publikasi)
    {
        return view('publikasi.edit', compact('publikasi'));
    }

    public function update(Request $request, Publikasi $publikasi)
    {
        $data = $request->validate([
            'judul'         => 'required|string|max:255',
            'tanggal_rilis' => 'required|date',
            'sampul'        => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'deskripsi'     => 'nullable|string',
        ], [
            'sampul.max' => 'Ukuran file sampul maksimal 5MB. File lebih dari 5MB tidak diterima.',
        ]);

        if ($request->hasFile('sampul')) {
            // hapus sampul lama bila ada
            if ($publikasi->sampul && file_exists(public_path('images/' . $publikasi->sampul))) {
                unlink(public_path('images/' . $publikasi->sampul));
            }

            $file = $request->file('sampul');
            $nama = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $nama);
            $data['sampul'] = $nama;
        } else {
            unset($data['sampul']); // pertahankan sampul lama
        }

        $publikasi->update($data);

        return redirect('/publikasi')->with('success', 'Publikasi berhasil diperbarui.');
    }

    public function destroy(Publikasi $publikasi)
    {
        if ($publikasi->sampul && file_exists(public_path('images/' . $publikasi->sampul))) {
            unlink(public_path('images/' . $publikasi->sampul));
        }

        $publikasi->delete();

        return redirect('/publikasi')->with('success', 'Publikasi berhasil dihapus.');
    }
}