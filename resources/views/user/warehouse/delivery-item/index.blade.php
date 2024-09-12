@extends('user.warehouse.layouts.master')

@section('title-page')
    Penerimaan Barang
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Item Penerimaan Barang'" :breadcrumbs="[['title' => 'Delivery Item']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Delivery Item'" :icon="'fas fa-solid fa-warehouse'" :addRoute="'delivery-item.create'" />

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
                        @if (auth()->user()->role == 'staff_warehouse')
                            <th>Aksi</th>
                        @endif
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
                            @if (auth()->user()->role == 'staff_warehouse')
                                <td>
                                    <a href="{{ route('warehouse.show', $deliveryItem->id) }}"
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
