@extends('user.warehouse.layouts.master')

@section('title-page')
    Laporan
@endsection

@section('content')
    <x-content.container-fluid>

        {{-- <x-content.heading-page :title="'Halaman Item Penerimaan Barang'" :breadcrumbs="[['title' => 'Delivery Item']]" /> --}}

        <x-content.table-container>

            <x-content.table-header :title="'Filter Barang Masuk'" :icon="'fas fa-solid fa-filter'" />

            <div class="card-body">
                <form action="{{ route('warehouse-report.index') }}" method="GET">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="start_date">Tanggal Awal</label>
                                <input type="date" name="start_date" id="start_date" class="form-control"
                                    value="{{ request('start_date') }}">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="end_date">Tanggal Akhir</label>
                                <input type="date" name="end_date" id="end_date" class="form-control"
                                    value="{{ request('end_date') }}">
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary mr-2 mb-2">Tampilkan Data</button>
                        <a href="{{ route('warehouse-report.exportExcel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
                    </div>
                </form>
            </div>
        </x-content.table-container>

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Delivery Item'" :icon="'fas fa-solid fa-warehouse'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Material</th>
                        <th>Kode Material</th>
                        <th>Tanggal Kedatangan</th>
                        <th>Nama Supplier</th>
                        <th>Jumlah</th>
                        <th>Lokasi Penyimpanan</th>
                        <th>Kondisi Material</th>
                        <th>Nomor Unik</th>
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($deliveryItems as $deliveryItem)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $deliveryItem->delivery->purchase->purchaseRequest->material->name ?? '' }}</td>
                            <td>{{ $deliveryItem->delivery->purchase->purchaseRequest->material->code ?? '' }}</td>
                            <td>{{ $deliveryItem->arrival_date }}</td>
                            <td>{{ $deliveryItem->delivery->purchase->purchaseRequest->supplier->name ?? '' }}</td>
                            <td>{{ $deliveryItem->quantity }}</td>
                            <td>{{ $deliveryItem->storage_location ?? '' }}</td>
                            <td>{{ ucfirst($deliveryItem->condition) }}</td>
                            <td>{{ $deliveryItem->unique_code ?? '' }}</td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
