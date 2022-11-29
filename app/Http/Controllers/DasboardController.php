<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DasboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dasboard');
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
        //menerima request dari website dan mengolah perhitungan
        $keluhan = $request->keluhan;
        $tahunLahir = $request->tahun;
        $hasil = new penggunaan($keluhan,$tahunLahir);
        $data = [
            'namaJamu'=>$hasil->namaJamu(),
            'khasiat'=>$keluhan,
            'keluhan'=>$keluhan,
            'umur'=>$hasil->hitungUmur(),
            'saran'=>$hasil->saran(),
            'penggunaan'=>$hasil->penggunaan(),
        ];

        return view('dasboard', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}




//membuat class rekomendasi
class Jamu
{
    public function __construct($keluhan, $tahun) {
        $this->keluhan = $keluhan;
        $this->tahun = $tahun;
    }
    public function namaJamu()
    {
        if ($this->keluhan == 'keseleo' || $this->keluhan == 'kurang nafsu makan') {
            return "Beras Kencur";
        } elseif ($this->keluhan == 'pegal-pegal') {
            return "Kunyit Asam";
        } elseif ($this->keluhan == 'darah tinggi' || $this->keluhan == 'gula darah') {
            return "Brotowali";
        } elseif ($this->keluhan == 'keram perut' || $this->keluhan == 'masuk angin') {
            return "Temulawak";

        }
    }
    public function hitungUmur()
    {
        return 2022- $this->tahun;
    }
    
}

class penggunaan extends Jamu
{

    public function penggunaan()
    {
        if ($this->hitungUmur() <= 10) {
            return "Dikonsumsi 1x";
        } else {
            return "Dikonsumsi 2x";

        }
    }
    public function saran()
    {
        if ($this->namaJamu() == "Beras Kencur" && $this->keluhan == "keseleo") {
            return "Dioleskan";
        } else {
            return "Dioleskan";

        }
        
    }
    
}

