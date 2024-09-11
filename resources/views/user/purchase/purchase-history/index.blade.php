@extends('user.purchase.layouts.master')

@section('title-page')
    Pembelian
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Pembelian'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('purchases.index')], ['title' => 'Jenis Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Pembelian'" :icon="'fas fa-solid fa-shop'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Materials</th>
                        <th>Supplier</th>
                        <th>Tanggal Pembelian</th>
                        <th>Jumlah</th>
                        <th>Status Persetujuan</th>
                        <th>Tanggal Persetujuan</th>
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $purchase->material->name ?? '' }}</td>
                            <td>{{ $purchase->supplier->name ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td>{{ $purchase->quantity ?? '' }}</td>
                            <td>
                                <a
                                    class="btn
                                @if ($purchase->approval_status == 'pending') btn-warning
                                @elseif ($purchase->approval_status == 'approved')
                                    btn-success
                                @elseif ($purchase->approval_status == 'rejected')
                                    btn-danger
                                @else
                                    btn-secondary @endif
                            ">
                                    {{ ucfirst($purchase->approval_status) ?? 'Unknown' }}
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($purchase->approved_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
