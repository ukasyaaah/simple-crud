<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255|min:3',
            'pengarang' => 'string|required|max:100|min:3',
            'tahun_terbit' => 'required'
        ]);

        Buku::create($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil di tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::all();
        $detailBuku = Buku::findOrFail($id);
        return view('buku.index', compact('buku', 'detailBuku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'judul' => 'required|string|max:255|min:3',
            'pengarang' => 'string|required|max:100|min:3',
            'tahun_terbit' => 'required'
        ]);

        Buku::where('id', $id)->update($validated);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
        $detailBuku = Buku::findOrFail($id);
        $detailBuku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil di hapus');
    }
}
