@extends('user.warehouse.layouts.master')

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

                    {{-- <div class="form-group">
                        <label for="material_id">Material</label>
                        <input type="text" class="form-control @error('material_id') is-invalid @enderror"
                            name="material_id" id="material_id" value="{{ $material->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <input type="text" class="form-control @error('supplier_id') is-invalid @enderror"
                            name="supplier_id" id="supplier_id" value="{{ $supplier->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="purchase_date">Tanggal Pembelian</label>
                        <input type="text" class="form-control @error('purchase_date') is-invalid @enderror"
                            name="purchase_date" id="purchase_date"
                            value="{{ \Carbon\Carbon::parse($purchase->purchase_date)->locale('id')->isoFormat('D MMMM YYYY') }}"
                            disabled>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Jumlah Pembelian</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                            id="quantity" value="{{ $purchase->quantity }}" disabled>
                    </div> --}}

                    <img src="{{ asset('barcodes/' . $deliveryItem->unique_code . '.png') }}" alt="Barcode">

                    {{-- <div class="mt-5">
                        <a href="{{ route('purchases.index') }}" class="btn btn-warning">Kembali</a>
                    </div> --}}
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
