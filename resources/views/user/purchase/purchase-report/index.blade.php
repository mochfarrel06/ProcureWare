@extends('user.purchase.layouts.master')

@section('title-page')
    Laporan
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Laporan'" :breadcrumbs="[['title' => 'Report']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Filter Tanggal'" :icon="'fas fa-solid fa-filter'" />

            <div class="card-body">
                <form action="{{ route('purchase-report.index') }}" method="GET">
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
                        <a href="{{ route('purchase-report.exportExcel', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="btn btn-success mb-2"><i class="fa-solid fa-file-excel"></i> Export Excel</a>
                    </div>
                </form>
            </div>
        </x-content.table-container>

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Pembelian'" :icon="'fas fa-solid fa-shop'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Material</th>
                        <th>Supplier</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal Pembelian</th>
                        <th>Batas Material diterima</th>
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $purchase->purchaseRequest->material->name ?? '' }}</td>
                            <td>{{ $purchase->purchaseRequest->supplier->name ?? '' }}</td>
                            <td>Rp {{ number_format($purchase->total_price ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <a
                                    class="btn
                                @if ($purchase->status == 'in_process') btn-warning
                                @elseif ($purchase->status == 'delivered')
                                    btn-success
                                @elseif ($purchase->status == 'canceled')
                                    btn-danger
                                @else
                                    btn-secondary @endif
                            ">
                                    {{ ucfirst($purchase->status) ?? 'Unknown' }}
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td>{{ \Carbon\Carbon::parse($purchase->expected_delivery_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>


    </x-content.container-fluid>
@endsection
