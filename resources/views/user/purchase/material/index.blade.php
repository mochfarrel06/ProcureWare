@extends('user.layouts.master')

@section('title-page')
    Material
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Material'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('material.index')], ['title' => 'Jenis Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Material'" :icon="'fas fa-solid fa-shop'" :addRoute="'material.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Material</th>
                        <th>Kode Material</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                            <th>Aksi</th>
                        @endif
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($materials as $material)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $material->name ?? '' }}</td>
                            <td>{{ $material->code ?? '' }}</td>
                            <td>{{ $material->category ?? '' }}</td>
                            <td>{{ $material->stock ?? '' }}</td>
                            @if (auth()->user()->role == 'manager_b' || auth()->user()->role == 'staff_purchase')
                                <td>
                                    <a href="{{ route('material.show', $material->id) }}" class="btn btn-warning mr-2 mb-2"><i
                                            class="fas fa-eye"></i></a>
                                    <a href="{{ route('material.edit', $material->id) }}" class="btn btn-success mr-2 mb-2"><i
                                            class="fas fa-edit"></i></a>
                                    <a href="{{ route('material.destroy', $material->id) }}"
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
