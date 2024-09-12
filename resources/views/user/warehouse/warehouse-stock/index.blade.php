@extends('user.warehouse.layouts.master')

@section('title-page')
    Warehouse stock
@endsection

@section('content')
    <x-content.container-fluid>

        {{-- <x-content.heading-page :title="'Halaman Stok'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('warehouse.index')], ['title' => 'Jenis Barang']]" /> --}}

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Gudang'" :icon="'fas fa-solid fa-shop'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Material</th>
                        <th>Kode Material</th>
                        <th>Stok</th>
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($warehouseStocks as $warehouseStock)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $warehouseStock->material->name ?? '' }}</td>
                            <td>{{ $warehouseStock->material->code ?? '' }}</td>
                            <td>{{ $warehouseStock->quantity ?? '' }}</td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
