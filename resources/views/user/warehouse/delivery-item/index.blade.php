@extends('user.warehouse.layouts.master')

@section('title-page')
    Item Delivery
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Item Delivery'" :breadcrumbs="[['title' => 'Item Delivery']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Item Delivery'" :icon="'fas fa-solid fa-warehouse'" :addRoute="'delivery-item.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Delivery ID</th>
                        <th>Material</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Condition</th>
                        <th>Unique Code</th>
                        <th>Storage Location</th>
                        @if (auth()->user()->role == 'staff_warehouse')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($deliveryItems as $deliveryItem)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $deliveryItem->delivery->id ?? '' }}</td>
                            <td>{{ $deliveryItem->material->name ?? '' }}</td>
                            <td>{{ $deliveryItem->supplier->name }}
                            </td>
                            <td>{{ $deliveryItem->quantity ?? '' }}</td>
                            <td>{{ ucfirst($deliveryItem->condition) }}</td>
                            <td>{{ $deliveryItem->unique_code ?? '' }}</td>
                            <td>{{ $deliveryItem->storage_location ?? '' }}</td>
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
