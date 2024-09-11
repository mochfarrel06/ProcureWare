@extends('user.purchase.layouts.master')

@section('title-page')
    Material
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Master Material'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('dashboard')], ['title' => 'Material']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Master Material'" :icon="'fas fa-solid fa-box'" :addRoute="'material.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Material</th>
                        <th>Kode Material</th>
                        <th>Deskripsi</th>
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
                            <td>{{ $material->description ?? '' }}</td>
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
