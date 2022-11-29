@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Daftar Produk</h2>
                    </div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="{{ route('produk.create') }}" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-bordered p-3 text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Foto</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    @if (Auth::user()->role == 'admin')
                                        <th>Status</th>
                                    @endif
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $key)
                                    @if ($key->status == 'tidak aktif')
                                    @else
                                        <tr>
                                            <td>{{ $key->id }}</td>
                                            <td><img src="{{ asset('storage/' . $key->foto) }}" alt="Foto Produk"
                                                    style="width: 100px"></td>
                                            <td><strong>{{ $key->namaProduk }}</strong></td>
                                            <td>Rp. {{ number_format($key->harga,0,",",".") }}</td>
                                            <td><details>
                                                <summary>Deskripsi</summary>{{ $key->descProduk }}</details></td>
                                            @if (Auth::user()->role == 'admin')
                                                <td> <p class="bg-success text-light rounded">{{ $key->status }}</p></td>
                                            @endif
                                            <td>{{ $key->kategori->namaKategori }}</td>
                                            <td>
                                                <form action="{{ route('produk.destroy', $key->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('produk.edit', $key->id) }}" class="btn btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ed{{ $key->id }}">Edit</a>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                    <div class="modal fade" id="ed{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('produk.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="namaProduk"
                                                                value="{{ $key->namaProduk }}" required>
                                                            <label for="formFloatingInput">Nama Produk</label>
                                                        </div>
                                                        <div class="mb-3 form-floating text-center">
                                                            <img src="{{ asset('storage/' . $key->foto) }}"
                                                                alt="Foto Produk" style="width: 100px">
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="file" class="form-control" name="foto"
                                                                value="{{ $key->foto }}">
                                                            <label for="formFloatingInput">Foto</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="number" class="form-control" name="harga"
                                                                value="{{ $key->harga }}" required>
                                                            <label for="formFloatingInput">Harga</label>
                                                        </div>
                                                        @if (Auth::user()->role == 'admin')
                                                            <div class="mb-3 form-floating">
                                                                <input type="text" class="form-control" name="status"
                                                                    value="{{ $key->status }}" required>
                                                                <label for="formFloatingInput">Status</label>
                                                            </div>
                                                        @endif
                                                        <div class="mb-3 form-floating">
                                                            <select name="kategori_id" id="" class="form-select">
                                                                <option value="" selected>pilih kategori</option>
                                                                @foreach ($kategori as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == $key->kategori_id ? 'selected' : '' }}>
                                                                        {{ $item->namaKategori }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="descProduk"
                                                                value="{{ $key->descProduk }}" required>
                                                            <label for="formFloatingInput">Deskripsi</label>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="namaProduk" required>
                        <label for="formFloatingInput">Nama Produk</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="file" class="form-control" name="foto" required>
                        <label for="formFloatingInput">Foto</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="number" class="form-control" name="harga" required>
                        <label for="formFloatingInput">Harga</label>
                    </div>
                    @if (Auth::user()->role == 'admin')
                        <div class="mb-3 form-floating">
                            <select name="status" id="" class="form-select" required>
                                <option value="" disabled selected>pilih Status</option>
                                    <option value="tersedia">
                                        Tersedia
                                    </option>
                                    <option value="tidak tersedia">
                                        Tidak tersedia
                                    </option>
                            </select>
                        </div>
                    @endif
                    <div class="mb-3 form-floating">
                        <select name="kategori_id" id="" class="form-select">
                            <option value="" disabled selected>pilih kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>
                                    {{ $item->namaKategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="descProduk" required>
                        <label for="formFloatingInput">Deskripsi</label>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
