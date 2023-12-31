@extends('dashboard.layouts.main')

@section('content')
    <div class="container">
        <h2 class="main-title mt-2 fw-semibold fs-3">Tabel Data Aset</h2>


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

        <a class="btn btn-outline-secondary fs-5 fw-normal mt-2" href="/dashboard/aset"><i
                class="fa-solid fa-chevron-left fs-5 me-2"></i>Kembali</a>
        <button class="btn btn-primary fs-5 fw-normal mt-2" data-bs-toggle="modal" data-bs-target="#tambah"><i
                class="fa-solid fa-square-plus fs-5 me-2"></i>Tambah</button>
        <div class="d-flex mt-3 fw-bold">
            <p class="me-2 mb-0">| Ruangan : {{ $Ruang->name }} |</p>
            <p class="mb-0">| Unit : {{ $Ruang->Unit->name }} |</p>
        </div>

        <div class="row mt-2">
            <div class="col">
                <div class="card mt-2">
                    <div class="card-body">

                        {{-- Tabel Data Unit --}}
                        <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>BARANG</th>
                                    <th>VARIANT</th>
                                    <th>KODE BARANG</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($asets as $aset)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $aset->Barang->name }}</td>
                                        <td>{{ $aset->Barang->Variant->name }}</td>
                                        <td>{{ $aset->Barang->kode_barang }}</td>
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
                                        @slot('title', 'Edit Data Aset')
                                        @slot('route', route('aset.update', $aset->id))
                                        @slot('method') @method('put') @endslot
                                        @slot('btnPrimaryTitle', 'Perbarui')

                                        <input type="hidden" value="{{ $Ruang->id }}" name="idRuangan">
                                        <div class="mb-3">
                                            <label for="idBarang" class="form-label">Barang</label>
                                            <select class="form-select" id="idBarang" name="idBarang">
                                                @foreach ($barangs as $barang)
                                                    @if (old('idBarang', $aset->idBarang) == $barang->id)
                                                        @if (!in_array($barang->id, $aset2->pluck('idBarang')->toArray()))
                                                            <option value="{{ $barang->id }}" selected>
                                                                {{ $barang->name }} - {{ $barang->kode_barang }}
                                                            </option>
                                                        @endif
                                                    @else
                                                        @if (!in_array($barang->id, $aset2->pluck('idBarang')->toArray()))
                                                            <option value="{{ $barang->id }}" selected>
                                                                {{ $barang->name }} - {{ $barang->kode_barang }}
                                                            </option>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </x-form_modal>
                                    {{-- / Modal Edit ruang --}}

                                    {{-- Modal Hapus ruang --}}
                                    <x-form_modal>
                                        @slot('id', "hapus$loop->iteration")
                                        @slot('title', 'Hapus Data Aset')
                                        @slot('route', route('aset.destroy', $aset->id))
                                        @slot('method') @method('delete') @endslot
                                        @slot('btnPrimaryClass', 'btn-outline-danger')
                                        @slot('btnSecondaryClass', 'btn-secondary')
                                        @slot('btnPrimaryTitle', 'Hapus')

                                        <p class="fs-5">Apakah anda yakin akan menghapus data Aset
                                            <b>{{ $aset->barang->name }} - {{ $aset->barang->kode_barang }}</b>?
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
        @slot('title', 'Tambah Data Aset')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('aset.store'))

        @csrf
        <div class="row">
            <input type="hidden" value="{{ $Ruang->id }}" name="idRuangan">
            <div class="mb-3">
                <label for="id_barang" class="form-label">barang</label>
                <select class="form-select" id="id_barang" name="idBarang">
                    @foreach ($barangs as $barang)
                        @if (!in_array($barang->id, $aset2->pluck('idBarang')->toArray()))
                            <option value="{{ $barang->id }}">
                                {{ $barang->name }} - {{ $barang->kode_barang }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah User -->
@endsection
