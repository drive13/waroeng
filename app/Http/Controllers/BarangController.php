<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\TipeDagangan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $barangs = Barang::with('kategori', 'tipe')->latest()->get();
        $kategoris = Kategori::all();
        $tipeDagangans = TipeDagangan::all();
        // dd($kategoris);
        return view('barang.index', [
            'title' => 'Daftar Barang',
            'barangs' => $barangs,
            'kategoris' => $kategoris,
            'tipeDagangans' => $tipeDagangans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'kategori_id' => 'required|integer',
            'tipe_dagangan_id' => 'required|integer',
            'kode' => 'required|unique:barangs',
            'nama' => 'required',
            'modal' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
            'foto' => 'required|image|max:2042',
        ]);

        if ($request->file('foto')) {
            $foto = $request->kode . '-' . date('d.m.y') . '.' . $request->file('foto')->extension();
            $request->foto->move(public_path('images/foto_barang/'), $foto);
            $validatedData['foto'] = $foto;
        }

        Barang::create($validatedData);
        return back()->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::find($id);

        return response()->json($barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        return view('barang.edit', [
            'title' => 'Edit Barang',
            'barang' => Barang::find($id),
            'kategoris' => Kategori::all(),
            'tipeDagangans' => TipeDagangan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kategori_id' => 'required|integer',
            'tipe_dagangan_id' => 'required|integer',
            'kode' => 'required',
            'nama' => 'required',
            'modal' => 'required',
            'harga_jual' => 'required',
            'stock' => 'required',
            'foto' => 'image|max:2042',
        ]);

        if ($request->file('foto')) {
            $foto = $request->kode . '-' . date('d.m.y.H.i.s') . '.' . $request->file('foto')->extension();
            $request->foto->move(public_path('images/foto_barang/'), $foto);
            $validatedData['foto'] = $foto;
            File::delete(public_path('images/foto_barang/' . $request->foto_lama));
        }

        $barang = Barang::find($id);
        $barang->update($validatedData);
        return redirect('barangs')->with('success', 'Barang telah diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
