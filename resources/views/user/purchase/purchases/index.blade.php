@extends('user.purchase.layouts.master')

@section('title-page')
    Pembelian
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Daftar Pembelian'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('purchases.index')], ['title' => 'Jenis Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Daftar Pembelian'" :icon="'fas fa-solid fa-shopping-cart'" :addRoute="'purchases.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal Pembelian</th>
                        <th>Supplier</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $purchase->purchase_date ?? '' }}</td>
                            <td>{{ $purchase->purchaseRequest->supplier->name ?? '' }}</td>
                            <td>{{ $purchase->total_price ?? '' }}</td>
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
                            @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                                <td>
                                    <a href="{{ route('purchases.show', $purchase->id) }}"
                                        class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('purchases.edit', $purchase->id) }}"
                                        class="btn btn-success mr-2 mb-2"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('purchases.destroy', $purchase->id) }}"
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
