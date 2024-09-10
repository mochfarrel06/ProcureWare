@extends('user.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <x-content.container-fluid>

        {{-- <x-content.heading-page :title="'Tambah Data Barang'" :breadcrumbs="[
            ['title' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['title' => 'Data Barang', 'url' => route('admin.item.index')],
            ['title' => 'Tambah'],
        ]" /> --}}

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Pembelian'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form>
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama Material</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ $material->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="code">Kode Material</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            id="code" value="{{ $material->code }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori Material</label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" name="category"
                            id="category" value="{{ $material->category }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="stock">Jumlah Stok Material</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                            id="stock" value="{{ $material->stock }}" disabled>
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('material.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
