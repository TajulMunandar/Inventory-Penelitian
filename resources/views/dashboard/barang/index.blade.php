@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h2 class="main-title mt-2 fw-semibold fs-3">Tabel Data Barang</h2>

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

        @if (auth()->user()->role != 3)
            <button class="btn btn-primary fs-5 fw-normal mt-2" data-bs-toggle="modal" data-bs-target="#tambahBarang"><i
                    class="fa-solid fa-square-plus fs-5 me-2"></i>Tambah</button>
        @endif
        <div class="row mt-3">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-body">

                        {{-- Tabel Data Barang --}}
                        <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>KODE</th>
                                    <th>VARIANT</th>
                                    <th>SPESIFIKASI</th>
                                    <th>TAHUN</th>
                                    <th>SIFAT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($barangs as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->name }}</td>
                                        <td>{{ $barang->kode_barang }} </td>
                                        <td>{{ $barang->Variant->name }}</td>
                                        <td>{{ $barang->spesifikasi }} </td>
                                        <td>{{ $barang->tahun }}</td>
                                        <td>
                                            @if ($barang->isMove == 1)
                                                <span class="badge badge-info bg-info">Bergerak</span>
                                            @else
                                                <span class="badge badge-primary bg-primary">Tidak Bergerak</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editBarang{{ $loop->iteration }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapusBarang{{ $loop->iteration }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit Barang --}}
                                    <x-form_modal>
                                        @slot('id', "editBarang$loop->iteration")
                                        @slot('title', 'Edit Data Barang')
                                        @slot('route', route('barang.update', $barang->id))
                                        @slot('method') @method('put') @endslot
                                        @slot('btnPrimaryTitle', 'Perbarui')
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nama</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    id="name" value="{{ old('name', $barang->name) }}" autofocus
                                                    required>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>


                                            <div class="mb-3">
                                                <label for="id_variant" class="form-label">Variant Barang</label>
                                                <select class="form-select" id="id_variant" name="idVariant">
                                                    @foreach ($variants as $variant)
                                                        @if (old('id_variant', $barang->id_variant) == $variant->id)
                                                            <option value="{{ $variant->id }}" selected>
                                                                {{ $variant->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $variant->id }}">
                                                                {{ $variant->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="spesifikasi" class="form-label">Spesifikasi</label>
                                                <input type="text"
                                                    class="form-control @error('spesifikasi') is-invalid @enderror"
                                                    name="spesifikasi" id="spesifikasi"
                                                    value="{{ old('spesifikasi', $barang->spesifikasi) }}" autofocus
                                                    required>
                                                @error('spesifikasi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                                <input type="text"
                                                    class="form-control @error('kode_barang') is-invalid @enderror"
                                                    name="kode_barang" id="kode_barang"
                                                    value="{{ old('kode_barang', $barang->kode_barang) }}" autofocus
                                                    required>
                                                @error('kode_barang')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="tahun" class="form-label">Tahun</label>
                                                <input type="date"
                                                    class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                                                    id="tahun" value="{{ old('tahun', $barang->tahun) }}" autofocus>
                                                @error('tahun')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="isMove" class="form-label">Sifat</label>
                                                <select class="form-select" id="isMove" name="isMove">
                                                    @foreach ([1 => 'Bergerak', 2 => 'Tidak Bergerak'] as $bool => $isMove)
                                                        <option value="{{ $bool }}"
                                                            {{ old('isMove', $barang->isMove) == $bool ? 'selected' : '' }}>
                                                            {{ $isMove }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </x-form_modal>
                                    {{-- / Modal Edit Barang

                                    {{-- Modal Hapus Barang --}}
                                    <x-form_modal>

                                        @slot('id', "hapusBarang$loop->iteration")
                                        @slot('title', 'Hapus Data Barang')
                                        @slot('route', route('barang.destroy', $barang->id))
                                        @slot('method') @method('delete') @endslot
                                        @slot('btnPrimaryClass', 'btn-outline-danger')
                                        @slot('btnSecondaryClass', 'btn-secondary')
                                        @slot('btnPrimaryTitle', 'Hapus')

                                        <p class="fs-5">Apakah anda yakin akan menghapus data barang
                                            <b>{{ $barang->kode_barang . ' - ' . $barang->name }}</b>?
                                        </p>

                                    </x-form_modal>
                                    {{-- / Modal Hapus Barang  --}}
                                @endforeach
                            </tbody>
                        </table>
                        {{-- / Tabel Data Barang --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Barang -->
    <x-form_modal>
        @slot('id', 'tambahBarang')
        @slot('title', 'Tambah Data Barang')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('barang.store'))

        @csrf
        <div class="row">

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                    autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="id_variant" class="form-label">Variant Barang</label>
                <select class="form-select" id="id_variant" name="idVariant">
                    @foreach ($variants as $variant)
                        <option value="{{ $variant->id }}">
                            {{ "$variant->name" }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="spesifikasi" class="form-label">Spesifikasi</label>
                <input type="text"
                    class="form-control @error('spesifikasi') is-invalid @enderror"
                    name="spesifikasi" id="spesifikasi" autofocus
                    required>
                @error('spesifikasi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control @error('kode_barang') is-invalid @enderror" name="kode_barang"
                    id="kode_barang" autofocus required>
                @error('kode_barang')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="date"
                    class="form-control @error('tahun') is-invalid @enderror" name="tahun"
                    id="tahun" autofocus>
                @error('tahun')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isMove" class="form-label">Sifat</label>
                <select class="form-select" id="isMove" name="isMove">
                    @foreach ([1 => 'Bergerak', 2 => 'Tidak Bergerak'] as $bool => $isMove)
                        <option value="{{ $bool }}">
                            {{ $isMove }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah Barang -->
@endsection
