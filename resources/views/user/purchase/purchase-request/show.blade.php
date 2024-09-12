@extends('user.purchase.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Permintaan Pembelian'" :breadcrumbs="[['title' => 'Purchase Request', 'url' => route('purchase-request.index')], ['title' => 'Show']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Permintaan Pembelian'" :icon="'fas fa-solid fa-eye'" />

            <x-content.card-body>
                <form>
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="user_id">Diorder oleh:</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    name="user_id" id="user_id" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="material_id">Material</label>
                                <input type="text" class="form-control @error('material_id') is-invalid @enderror"
                                    name="material_id" id="material_id" value="{{ $material->name }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <input type="text" class="form-control @error('supplier_id') is-invalid @enderror"
                                    name="supplier_id" id="supplier_id" value="{{ $supplier->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="quantity">Jumlah barang</label>
                                <input type="number" class="form-control @error('quantity') is-invalid @enderror"
                                    name="quantity" id="quantity" value="{{ $purchaseRequest->quantity }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    name="status" id="status" value="{{ $purchaseRequest->status }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="request_date">Tanggal Pembelian</label>
                                <input type="text" class="form-control @error('request_date') is-invalid @enderror"
                                    name="request_date" id="request_date"
                                    value="{{ \Carbon\Carbon::parse($purchaseRequest->request_date)->locale('id')->isoFormat('D MMMM YYYY') }}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('purchase-request.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
