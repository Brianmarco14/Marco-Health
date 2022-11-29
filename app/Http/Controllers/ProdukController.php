<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan isi table
        $produk = Produk::all();
        $kategori = Kategori::all();
        return view('produk', compact('produk','kategori'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //menambah produk
        $file = $request->file('foto')->store('foto');
        Produk::create([
            'namaProduk'=>$request->namaProduk,
            'foto'=>$file,
            'harga'=>$request->harga,
            'status'=>$request->status,
            'descProduk'=>$request->descProduk,
            'kategori_id'=>$request->kategori_id,
        ]);
        return redirect('produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        //update data produk
        $data = $request->all();
        try {
            $data['foto']=$request->file('foto')->store('foto');
            $produk->update($data);
        } catch (\Throwable $th) {
            $data['foto']=$produk->foto;
            $produk->update($data);

        }
        return redirect('produk');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //delete data produk
        $produk->delete();
        return redirect('produk');

    }
}
