@extends('user.purchase.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Daftar Pembelian'" :breadcrumbs="[['title' => 'Purchase', 'url' => route('purchases.index')], ['title' => 'Show']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Daftar Pembelian'" :icon="'fas fa-solid fa-eye'" />

            <x-content.card-body>
                <form>
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="purchase_request_id">Material</label>
                                <input type="text" class="form-control @error('purchase_request_id') is-invalid @enderror"
                                    name="purchase_request_id" id="purchase_request_id"
                                    value="{{ $purchaseRequest->material->code }} - {{ $purchaseRequest->material->name }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="purchase_request_id">Supplier</label>
                                <input type="text"
                                    class="form-control @error('purchase_request_id') is-invalid @enderror"
                                    name="purchase_request_id" id="purchase_request_id"
                                    value="{{ $purchaseRequest->supplier->code }} - {{ $purchaseRequest->supplier->name }}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="user_id">Diproses oleh:</label>
                                <input type="text" class="form-control @error('user_id') is-invalid @enderror"
                                    name="user_id" id="user_id" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="purchase_date">Tanggal Pembelian</label>
                                <input type="text" class="form-control @error('purchase_date') is-invalid @enderror"
                                    name="purchase_date" id="purchase_date"
                                    value="{{ \Carbon\Carbon::parse($purchase->purchase_date)->locale('id')->isoFormat('D MMMM YYYY') }}"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="expected_delivery_date">Tanggal perkiraan barang datang</label>
                                <input type="text"
                                    class="form-control @error('expected_delivery_date') is-invalid @enderror"
                                    name="expected_delivery_date" id="expected_delivery_date"
                                    value="{{ \Carbon\Carbon::parse($purchase->expected_delivery_date)->locale('id')->isoFormat('D MMMM YYYY') }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="total_price">Total Harga</label>
                                <input type="number" class="form-control @error('total_price') is-invalid @enderror"
                                    name="total_price" id="total_price" value="{{ $purchase->total_price }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('purchases.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
