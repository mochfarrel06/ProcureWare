@extends('user.warehouse.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Penerimaan Barang Pembelian'" :breadcrumbs="[['title' => 'Delivery', 'url' => route('delivery.index')], ['title' => 'Show']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Penerimaan Barang Pembelian'" :icon="'fas fa-solid fa-eye'" />

            <x-content.card-body>
                <form>
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="purchase_id">Purchase</label>
                                <input type="text" class="form-control @error('purchase_id') is-invalid @enderror"
                                    name="purchase_id" id="purchase_id"
                                    value="{{ $purchase->purchaseRequest->material->name }} - {{ $purchase->purchaseRequest->supplier->name }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="user_id">Diterima oleh</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    name="user_id" id="user_id" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="delivery_date">Tanggal Penerimaan</label>
                                <input type="text" class="form-control @error('delivery_date') is-invalid @enderror"
                                    name="delivery_date" id="delivery_date"
                                    value="{{ \Carbon\Carbon::parse($delivery->delivery_date)->locale('id')->isoFormat('D MMMM YYYY') }}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('delivery.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
