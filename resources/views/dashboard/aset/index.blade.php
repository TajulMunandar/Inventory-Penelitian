@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="main-title mt-2 fw-semibold fs-2">Data Aset</h2>
            </div>
            <div class="col">
                <form action="{{ route('aset.index') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Cari Daftar Aset"
                            aria-label="Example text with two button addons">
                        <button class="btn btn-info text-white" type="submit">Cari</button>
                        <a class="btn btn-dark" type="button" href="{{ route('aset.index') }}">Reset</a>
                    </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-6 col-md">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('failed'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('failed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-12 mb-4 d-flex">
            <div class="col-4">

            </div>
        </div>

        @if (isset($search))
            <p>Hasil Pencarian untuk: <strong>{{ $search }}</strong></p>
        @endif

        <div class="row mt-3">
            @forelse ($ruangs as $ruangan)
                <div class="col-sm-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title fw-bold mb-2">Ruangan {{ strtoupper($ruangan->name) }} </h3>
                            <p class="card-text mb-2">Unit : {{ $ruangan->unit->name }}
                            <p class="card-text mb-2">Total Barang : {{ $ruangan->total_barang }}
                            <div class="d-flex gap-2">
                                <div class="w-100">
                                    <a href="{{ route('ruang.show', $ruangan->id) }}" type="button"
                                        class="btn btn-primary w-100">
                                        Masuk
                                    </a>
                                </div>
                                <a href="{{ route('aset.pdf', [$ruangan->id]) }}" type="button"
                                    class="btn btn-secondary text-white">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            @empty
                <P class="fs-5 text-center">Pesebaran Aset Belum Ada</P>
            @endforelse
            {{-- paginasi --}}
            @if (isset($search))

            @else
            <div class="row my-4">
                <div class="col-12">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($ruangs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $ruangs->previousPageUrl() }}" rel="prev">Previous</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @for ($i = 1; $i <= $ruangs->lastPage(); $i++)
                            <li class="page-item {{ $i == $ruangs->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $ruangs->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($ruangs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $ruangs->nextPageUrl() }}" rel="next">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
