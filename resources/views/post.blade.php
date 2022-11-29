@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Daftar Postingan</h2>
                    </div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="{{ route('post.create') }}" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-bordered p-3 text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Penulis</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($post as $key)
                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td><strong>{{ $key->judul }}</strong></td>
                                        <td>
                                            <details>
                                                <summary>Isi</summary>
                                                {{ $key->isi }}
                                            </details>
                                        </td>
                                        <td>{{ $key->tanggalDibuat }}</td>
                                        <td>{{ $key->user->name }}</td>
                                        <td>{{ $key->kategori->namaKategori }}</td>
                                        <td>
                                            <form action="{{ route('post.destroy', $key->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('post.edit', $key->id) }}" class="btn btn-warning"
                                                    data-bs-toggle="modal" data-bs-target="#ed{{ $key->id }}">Edit</a>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="ed{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Postingan</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('post.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="judul" value="{{ $key->judul }}" required>
                                                            <label for="formFloatingInput">Judul</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="isi" value="{{ $key->isi }}" required>
                                                            <label for="formFloatingInput">Isi</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="date" class="form-control" name="tanggalDibuat" value="{{ $key->tanggalDibuat }}" required>
                                                            <label for="formFloatingInput">Tanggal Postingan</label>
                                                        </div>
                                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Postingan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="judul" required>
                        <label for="formFloatingInput">Judul</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="isi" required>
                        <label for="formFloatingInput">Isi</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="date" class="form-control" name="tanggalDibuat" required>
                        <label for="formFloatingInput">Tanggal Postingan</label>
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="mb-3 form-floating">
                        <select name="kategori_id" id="" class="form-select">
                            <option value="" selected>pilih kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>
                                    {{ $item->namaKategori }}</option>
                            @endforeach
                        </select>
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
