@extends('dashboard.layouts.main')
@section('page-heading', 'Dashboard')

@section('content')

    @if (isset($units))
        @foreach ($units as $unit)
            <div class="col-xl-3 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card ">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- heading -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h4 class="mb-0 fw-bold">{{ $unit->name }}</h4>
                            </div>
                            <div class="icon-shape icon-md bg-light-primary text-primary rounded-2">
                                <i class="fa-regular fa-buildings fs-4"></i>
                            </div>
                        </div>

                        <!-- project number -->
                        <div>
                            <h5 class="fw-bold">{{ $unit->Ruangan->count() }} Ruangan</h5>
                        </div>
                        <div>
                            <h5 class="fw-bold">{{ $unit->Ruangan->sum('total_barang') }} Barang</h5>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif

@endsection
