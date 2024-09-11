@extends('user.warehouse.layouts.master')

@section('title-page')
    Report
@endsection

@section('content')
    <x-content.container-fluid>

        {{-- <x-content.heading-page :title="'Halaman Gudang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('warehouse.index')], ['title' => 'Jenis Barang']]" /> --}}
        <!-- Form Filter Laporan -->
        <form action="{{ route('warehouse.report') }}" method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="from">Tanggal Dari:</label>
                    <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                </div>
                <div class="col-md-4">
                    <label for="to">Tanggal Hingga:</label>
                    <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                </div>
                <div class="col-md-4 mt-4">
                    <button type="submit" class="btn btn-primary mt-2">Filter</button>
                    {{-- <a href="{{ route('warehouse.report.export', ['from' => request('from'), 'to' => request('to')]) }}"
                        class="btn btn-success mt-2">Ekspor Excel</a> --}}
                </div>
            </div>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Material</th>
                    <th>Kode Material</th>
                    <th>Jumlah</th>
                    <th>Kondisi</th>
                    <th>Tanggal Kedatangan</th>
                    <th>Supplier</th>
                    <th>Lokasi Penyimpanan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->material_name }}</td>
                        <td>{{ $item->material_code }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->condition }}</td>
                        <td>{{ $item->arrival_date }}</td>
                        <td>{{ $item->supplier->name }}</td>
                        <td>{{ $item->storage_location }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Tidak ada data untuk periode ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </x-content.container-fluid>
@endsection
