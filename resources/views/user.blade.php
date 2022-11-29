@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Daftar User</h2>
                    </div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="{{ route('user.create') }}" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-bordered p-3">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key)
                                        <tr>
                                            <td>{{ $key->id }}</td>
                                            <td>{{ $key->name }}</td>
                                            <td>{{ $key->email }}</td>
                                            <td>{{ $key->role }}</td>
                                            <td>
                                                <form action="{{ route('user.destroy', $key->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="{{ route('user.edit', $key->id) }}" class="btn btn-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ed{{ $key->id }}">Edit</a>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <div class="modal fade" id="ed{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="namauser"
                                                                value="{{ $key->namauser }}" required>
                                                            <label for="formFloatingInput">Nama</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="email" class="form-control" name="email"
                                                                value="{{ $key->email }}" required>
                                                            <label for="formFloatingInput">Email</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="password" class="form-control" name="password"
                                                                 required>
                                                            <label for="formFloatingInput">Password</label>
                                                        </div>
                                                        
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" class="form-control" name="role"
                                                                value="{{ $key->role }}" required>
                                                            <label for="formFloatingInput">Role</label>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="namauser"
                             required>
                        <label for="formFloatingInput">Nama</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="email" class="form-control" name="email"
                             required>
                        <label for="formFloatingInput">Email</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" class="form-control" name="password"
                             required>
                        <label for="formFloatingInput">Password</label>
                    </div>
                    
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" name="role"
                             required>
                        <label for="formFloatingInput">Role</label>
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
