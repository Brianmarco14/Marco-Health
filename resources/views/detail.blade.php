@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Detail Postingan</h2>
                    </div>

                    <div class="card p-5">
                        <div class="row">
                            <div class="col-12 mb-5">
                                <div class="card p-3">
                                        <h2>{{ $detail->judul }}</h2>
                                        <div class="row"></div>
                                        <p class="mb-5">penulis : {{ $detail->user->name }}, {{ $detail->tanggalDibuat }}</p>
                                        <p>{{ $detail->isi }}</p>
                                        
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            @foreach($produk as $key)
                                
                            <h3>Rekomendasi Produk</h3>
                            <div class="col-2">
                                <div class="card" style="width: 8rem;">
                                    <img src="{{ asset('storage/'.$key->foto) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text text-center"><strong>{{ $key->namaProduk }}</strong></p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
