@extends('user.warehouse.layouts.master')

@section('title-page')
    Delivery
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Daftar Barang Masuk'" :breadcrumbs="[['title' => 'Gudang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Gudang'" :icon="'fas fa-solid fa-warehouse'" :addRoute="'delivery.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Purchase</th>
                        <th>Received By</th>
                        <th>Delivery Date</th>
                        @if (auth()->user()->role == 'staff_warehouse')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($deliveries as $delivery)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $delivery->purchase->id }}</td>
                            <td>a</td>
                            {{-- <td>{{ $delivery->delivery_date->format('d/m/Y') }}</td> --}}
                            <td>aa</td>
                            @if (auth()->user()->role == 'staff_warehouse')
                                <td>
                                    <a href="{{ route('warehouse.show', $delivery->id) }}"
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
