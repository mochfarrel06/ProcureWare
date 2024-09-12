@extends('user.warehouse.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Tambah Item Penerimaan Barang'" :breadcrumbs="[['title' => 'Delivery Item', 'url' => route('delivery-item.index')], ['title' => 'Show']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Pembelian'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form>
                    @csrf

                    <div class="form-group">
                        <label for="material_id">Material</label>
                        <input type="text" class="form-control @error('material_id') is-invalid @enderror"
                            name="material_id" id="material_id"
                            value="{{ $delivery->purchase->purchaseRequest->material->name }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="supplier_id">Kode</label>
                        <input type="text" class="form-control @error('supplier_id') is-invalid @enderror"
                            name="supplier_id" id="supplier_id"
                            value="{{ $delivery->purchase->purchaseRequest->material->code }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="supplier_id">Tanggal kedatangan</label>
                        <input type="date" class="form-control @error('supplier_id') is-invalid @enderror"
                            name="supplier_id" id="supplier_id" value="{{ $delivery->delivery_date }}" disabled>
                    </div>

                    <img src="{{ asset('barcodes/' . $deliveryItem->unique_code . '.png') }}" alt="Barcode">

                    <div class="mt-4">
                        <a href="{{ route('delivery-item.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
