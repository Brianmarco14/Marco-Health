@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Rekomendasi Jamu</h2>
                    </div>

                    <div class="card p-5">
                        <div class="row">
                            <div class="col-4 card p-3">
                                <form action="{{ route('dasboard.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3 form-floating">
                                        <input type="number" class="form-control" name="tahun" required>
                                        <label for="formFloatingInput">Tahun Lahir</label>
                                    </div>
                                    <div class="mb-3 form-floating">
                                        <select name="keluhan" id="" class="form-select" required>
                                            <option value="" disabled selected>Pilih Keluhan</option>
                                                <option value="keseleo">
                                                    keseleo
                                                </option>
                                                <option value="kurang nafsu makan">
                                                    kurang nafsu makan
                                                </option>
                                                <option value="pegal-pegal">
                                                    pegal-pegal
                                                </option>
                                                <option value="darah tinggi">
                                                    darah tinggi
                                                </option>
                                                <option value="gula darah">
                                                    gula darah
                                                </option>
                                                <option value="keram perut">
                                                    keram perut
                                                </option>
                                                <option value="masuk angin">
                                                    masuk angin
                                                </option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary"> Check </button>
                                </form>
                            </div>
                            <div class="col-7 ms-1 card p-3">
                                <table>
                                    @isset($data)
                                        <tbody>
                                            <tr>
                                                <th><strong>Nama Jamu </strong></th>
                                                <td>: {{ $data['namaJamu'] }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Khasiat </strong></th>
                                                <td>: Menyembuhkan {{ $data['khasiat'] }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Keluhan </strong></th>
                                                <td>: {{ $data['keluhan'] }}</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Umur </strong></th>
                                                <td>: {{ $data['umur'] }} tahun</td>
                                            </tr>
                                            <tr>
                                                <th><strong>Saran Penggunaan </strong></th>
                                                <td>: {{ $data['saran'] .", ". $data['penggunaan'].' sehari' }}</td>
                                            </tr>
                                        </tbody>
                                    @endisset

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
