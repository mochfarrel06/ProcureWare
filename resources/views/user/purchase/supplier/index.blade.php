@extends('user.purchase.layouts.master')

@section('title-page')
    supplier
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Supplier'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('supplier.index')], ['title' => 'Jenis Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Supplier'" :icon="'fas fa-solid fa-shop'" :addRoute="'supplier.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Supplier</th>
                        <th>Kode Supplier</th>
                        <th>Kontak</th>
                        <th>Alamat</th>
                        @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $supplier->name ?? '' }}</td>
                            <td>{{ $supplier->code ?? '' }}</td>
                            <td>{{ $supplier->contact ?? '' }}</td>
                            <td>{{ $supplier->address ?? '' }}</td>
                            @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                                <td>
                                    <a href="{{ route('supplier.show', $supplier->id) }}" class="btn btn-warning mr-2 mb-2"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-success mr-2 mb-2"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('supplier.destroy', $supplier->id) }}"
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
