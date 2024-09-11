@extends('user.warehouse.layouts.master')

@section('title-page')
    Stock
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Gudang'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('warehouse.index')], ['title' => 'Jenis Barang']]" />

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
                    @foreach ($stocks as $stock)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $stock->material->name ?? '' }}</td>
                            <td>{{ $stock->material->code ?? '' }}</td>
                            <td>{{ $stock->quantity ?? '' }}</td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
