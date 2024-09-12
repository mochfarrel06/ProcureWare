@extends('user.warehouse.layouts.master')

@section('title-page')
    Delivery
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Penerimaan Barang Pembelian'" :breadcrumbs="[['title' => 'Delivery']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Penerimaan Barang Pembelian'" :icon="'fas fa-solid fa-truck'" :addRoute="'delivery.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Purchase</th>
                        <th>Diterima oleh</th>
                        <th>Tanggal penerimaan</th>
                        @if (auth()->user()->role == 'staff_warehouse')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($deliveries as $delivery)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $delivery->purchase->purchaseRequest->material->name }} -
                                {{ $delivery->purchase->purchaseRequest->supplier->name }}</td>
                            <td>{{ $delivery->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($delivery->delivery_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            @if (auth()->user()->role == 'staff_warehouse')
                                <td>
                                    <a href="{{ route('delivery.show', $delivery->id) }}" class="btn btn-warning mr-2 mb-2"><i
                                            class="fas fa-eye"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
