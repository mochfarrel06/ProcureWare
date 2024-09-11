@extends('user.layouts.master')

@section('title-page')
    Pembelian
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Pembelian'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('purchases.index')], ['title' => 'Jenis Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Pembelian'" :icon="'fas fa-solid fa-shop'" :addRoute="'purchases.create'" />

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
                        @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                            <th>Aksi</th>
                        @endif
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
