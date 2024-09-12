@extends('user.purchase.layouts.master')

@section('title-page')
    Detail Pembelian
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Detail Pembelian'" :breadcrumbs="[['title' => 'Purchase Item']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Detail Pembelian'" :icon="'fas fa-solid fa-shopping-cart'" :addRoute="'purchase-item.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pembelian</th>
                        <th>Material</th>
                        <th>Jumlah</th>
                        <th>Harga per Unit</th>
                        <th>Total harga</th>
                        @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($purchaseItems as $purchaseItem)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $purchaseItem->purchase->id ?? '' }}</td>
                            <td>{{ $purchaseItem->material->name ?? '' }}</td>
                            <td>{{ $purchaseItem->quantity ?? '' }}</td>
                            <td>{{ $purchaseItem->price_per_unit }}</td>
                            <td>{{ $purchaseItem->total_price }}</td>
                            @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                                <td>
                                    <a href="{{ route('purchase-item.show', $purchaseItem->id) }}"
                                        class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('purchase-item.edit', $purchaseItem->id) }}"
                                        class="btn btn-success mr-2 mb-2"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('purchase-item.destroy', $purchaseItem->id) }}"
                                        class="btn btn-danger mr-2 mb-2 delete-item"><i class="fas fa-trash"></i></a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
