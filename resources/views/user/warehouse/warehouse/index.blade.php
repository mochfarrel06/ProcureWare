@extends('user.warehouse.layouts.master')

@section('title-page')
    Gudang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Daftar Barang Masuk'" :breadcrumbs="[['title' => 'Gudang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Gudang'" :icon="'fas fa-solid fa-warehouse'" :addRoute="'warehouse.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Material</th>
                        <th>Kode Material</th>
                        <th>Tanggal Kedatangan</th>
                        <th>Supplier</th>
                        <th>Jumlah Material</th>
                        <th>Lokasi Penyimpanan</th>
                        <th>Kondisi</th>
                        <th>Nomor Unik</th>
                        @if (auth()->user()->role == 'staff_warehouse')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($warehouseItems as $warehouseItem)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $warehouseItem->material_name ?? '' }}</td>
                            <td>{{ $warehouseItem->material_code ?? '' }}</td>
                            <td>{{ $warehouseItem->arrival_date }}
                            </td>
                            <td>{{ $warehouseItem->supplier->code ?? '' }} - {{ $warehouseItem->supplier->name ?? '' }}</td>
                            <td>{{ $warehouseItem->quantity ?? '' }}</td>
                            <td>{{ $warehouseItem->storage_location ?? '' }}</td>
                            <td>
                                <a
                                    class="btn
                                @if ($warehouseItem->condition == 'bad') btn-warning
                                @elseif ($warehouseItem->condition == 'good')
                                    btn-success
                                @else
                                    btn-secondary @endif
                            ">
                                    {{ ucfirst($warehouseItem->condition) ?? 'Unknown' }}
                                </a>
                            </td>
                            <td>{{ $warehouseItem->unique_number ?? '' }}</td>
                            @if (auth()->user()->role == 'staff_warehouse')
                                <td>
                                    <a href="{{ route('warehouse.show', $warehouseItem->id) }}"
                                        class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
