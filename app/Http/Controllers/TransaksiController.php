<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Barang;
use App\Models\DetailTransaksi;
use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $latestInvoice = Transaksi::select('invoice')->latest()->first();
        // dd($latestInvoice);
        if ($latestInvoice == null) {
            $newNum = '0001';
        } else {
            $latestInvoice = $latestInvoice->invoice;
            $latestNum = explode('/', $latestInvoice);
            $increment = (int) $latestNum[2] + 1;
            if (strlen($increment) == 1) {
                $newNum = '000' . $increment;
            } elseif (strlen($increment) == 2) {
                $newNum = '00' . $increment;
            } elseif (strlen($increment) == 3) {
                $newNum = '0' . $increment;
            } else {
                $newNum = $increment;
            }
        }

        $pembelis = Pembeli::all();
        $invoice = 'INV/' . date('j-m-y') . '/' . $newNum;
        $barangs = Barang::where('stock', '>', 0)->get();
        // dd($barangs);
        return view('transaksi.create', [
            'title' => 'Pembelian',
            'barangs' => $barangs,
            'invoice' => $invoice,
            'pembelis' => $pembelis,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiRequest  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'invoice' => 'required|max:30',
            'pembeli_id' => 'required|integer',
            'tanggal' => 'required',
            'total_belanja' => 'required',
            'total_bayar' => 'required',
            'keterangan' => 'nullable',
            'barang_id' => 'required|array|min:1',
            'barang_id.*' => 'required|integer|distinct',
            'qty' => 'required|array|min:1',
            'qty.*' => 'required|integer',
            'kode' => 'required|array|min:1',
            'kode.*' => 'required',
            'modal' => 'required|array|min:1',
            'modal.*' => 'required|integer',
            'harga_jual' => 'required|array|min:1',
            'harga_jual.*' => 'required|integer',
        ]);

        $save = DB::transaction(function () use ($request) {
            $transaksi = Transaksi::create([
                'invoice' => $request->invoice,
                'pembeli_id' => $request->pembeli_id,
                'tanggal' => $request->tanggal,
                'total_belanja' => $request->total_belanja,
                'total_bayar' => $request->total_bayar,
                'keterangan' => $request->keterangan,
            ]);

            for ($i = 0; $i < count($request->barang_id); $i++) {
                DetailTransaksi::create([
                    'transaksi_id' => $transaksi->id,
                    'barang_id' => $request->barang_id[$i],
                    'kode' => $request->kode[$i],
                    'modal' => $request->modal[$i],
                    'harga_jual' => $request->harga_jual[$i],
                    'qty' => $request->qty[$i],
                    'harga_total' => $request->qty[$i] * $request->harga_jual[$i],
                ]);

                $barang = Barang::find($request->barang_id[$i]);
                $barang->stock = $barang->stock - $request->qty[$i];
                $barang->save();
            }
            return $transaksi->id;
        });
        return back()
            ->with([
                'success' => 'Transaksi berhasil disimpan!',
                'id' => $save
            ]);
    }

    public function receipt($id)
    {
        // dd(Transaksi::with('details', 'pembeli')->where('id', $id)->first());
        return view('transaksi.receipt', [
            'title' => 'Receipt',
            'data' => Transaksi::with('details.barang', 'pembeli')->where('id', $id)->first(),
        ]);
    }
}
