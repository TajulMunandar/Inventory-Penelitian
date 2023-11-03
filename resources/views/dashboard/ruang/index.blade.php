@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h2 class="main-title mt-2 fw-semibold fs-3">Tabel Data Ruang</h2>

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

        <button class="btn btn-primary fs-5 fw-normal mt-2" data-bs-toggle="modal" data-bs-target="#tambah"><i
                class="fa-solid fa-square-plus fs-5 me-2"></i>Tambah</button>
        <div class="row mt-3">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-body">

                        {{-- Tabel Data Unit --}}
                        <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA</th>
                                    <th>UNIT</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ruangs as $ruang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ruang->name }}</td>
                                        <td>{{ $ruang->unit->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $loop->iteration }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus{{ $loop->iteration }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Modal Edit ruang --}}
                                    <x-form_modal>
                                        @slot('id', "edit$loop->iteration")
                                        @slot('title', 'Edit Data Ruang')
                                        @slot('route', route('ruang.update', $ruang->id))
                                        @slot('method') @method('put') @endslot
                                        @slot('btnPrimaryTitle', 'Perbarui')

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="name" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', $ruang->name) }}"
                                                autofocus required>
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="id_unit" class="form-label">Unit</label>
                                            <select class="form-select" id="id_unit" name="id_unit">
                                                @foreach ($units as $unit)
                                                    @if (old('id_unit', $ruang->id_unit) == $unit->id)
                                                        <option value="{{ $unit->id }}" selected>
                                                            {{ $unit->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $unit->id }}">
                                                            {{ $unit->name }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </x-form_modal>
                                    {{-- / Modal Edit ruang --}}

                                    {{-- Modal Hapus ruang --}}
                                    <x-form_modal>
                                        @slot('id', "hapus$loop->iteration")
                                        @slot('title', 'Hapus Data Ruang')
                                        @slot('route', route('ruang.destroy', $ruang->id))
                                        @slot('method') @method('delete') @endslot
                                        @slot('btnPrimaryClass', 'btn-outline-danger')
                                        @slot('btnSecondaryClass', 'btn-secondary')
                                        @slot('btnPrimaryTitle', 'Hapus')

                                        <p class="fs-5">Apakah anda yakin akan menghapus data Ruang
                                            <b>{{ $ruang->name }}</b>?
                                        </p>

                                    </x-form_modal>
                                    {{-- / Modal Hapus ruang  --}}
                                @endforeach
                            </tbody>
                        </table>
                        {{-- / Tabel Data ... --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah ruang -->
    <x-form_modal>
        @slot('id', 'tambah')
        @slot('title', 'Tambah Data Ruang')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('ruang.store'))

        @csrf
        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="name" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="id_unit" class="form-label">Unit</label>
                <select class="form-select" id="id_unit" name="id_unit">
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}">
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah User -->
@endsection
