@extends('user.purchase.layouts.master')

@section('title-page')
    Daftar Pembelian
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Daftar Pembelian'" :breadcrumbs="[['title' => 'Purchase']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Daftar Pembelian'" :icon="'fas fa-solid fa-shopping-cart'" :addRoute="'purchases.create'" />

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
                        @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                            <th>Aksi</th>
                        @endif
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
                            @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                                <td>
                                    <a href="{{ route('purchases.show', $purchase->id) }}"
                                        class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('purchases.edit', $purchase->id) }}"
                                        class="btn btn-success mr-2 mb-2 {{ $purchase->status == 'delivered' ? 'disabled' : '' }}"><i
                                            class="fas fa-edit"></i></a>
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
