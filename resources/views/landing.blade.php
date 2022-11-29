@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Daftar Postingan</h2>
                    </div>

                    <div class="card p-5">
                        <div class="row">
                            @foreach($post as $key)
                            @if($key->status == 'tidak tersedia')
                                
                            @else
                                
                            <div class="col-4">
                                <div class="card p-3">
                                        <h2 class="mb-5">{{ $key->judul }}</h2>
                                        <a href="{{ url('detail/'. $key->id) }}" class="btn btn-primary">Tampilkan</a>
                                </div>
                            </div>
                            @endif                                
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
