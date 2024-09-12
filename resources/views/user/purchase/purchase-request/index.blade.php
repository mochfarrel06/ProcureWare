@extends('user.purchase.layouts.master')

@section('title-page')
    Permintaan Pembelian
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Permintaan Pembelian'" :breadcrumbs="[['title' => 'Purchase Request']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Permintaan Pembelian'" :icon="'fas fa-solid fa-hourglass-start'" :addRoute="'purchase-request.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Material</th>
                        <th>Supplier</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($purchaseRequests as $purchaseRequest)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $purchaseRequest->user->name ?? '' }}</td>
                            <td>{{ $purchaseRequest->material->name ?? '' }}</td>
                            <td>{{ $purchaseRequest->supplier->name ?? '' }}</td>
                            <td>{{ $purchaseRequest->quantity ?? '' }}</td>
                            <td>
                                <a
                                    class="btn
                                @if ($purchaseRequest->status == 'pending') btn-warning
                                @elseif ($purchaseRequest->status == 'approved')
                                    btn-success
                                @elseif ($purchaseRequest->status == 'rejected')
                                    btn-danger
                                @else
                                    btn-secondary @endif
                            ">
                                    {{ ucfirst($purchaseRequest->status) ?? 'Unknown' }}
                                </a>
                            </td>
                            @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                                <td>
                                    <a href="{{ route('purchase-request.show', $purchaseRequest->id) }}"
                                        class="btn btn-warning mr-2 mb-2"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('purchase-request.edit', $purchaseRequest->id) }}"
                                        class="btn btn-success mr-2 mb-2"><i class="fas fa-edit"></i></a>
                                    <a href="{{ route('purchase-request.destroy', $purchaseRequest->id) }}"
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
