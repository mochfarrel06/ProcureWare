@extends('user.purchase.layouts.master')

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
                        <label for="name">Nama Supplier</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ old('name', $supplier->name) }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="code">Kode Supplier</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            id="code" value="{{ old('code', $supplier->code) }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="contact">Kontak Supplier</label>
                        <input type="text" class="form-control @error('contact') is-invalid @enderror" name="contact"
                            id="contact" value="{{ old('contact', $supplier->contact) }}" disabled>
                    </div>

                    <div class="mt-5">
                        <a href="{{ route('supplier.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
