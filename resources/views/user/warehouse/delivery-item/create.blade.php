@extends('user.warehouse.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Tambah Item Penerimaan Barang'" :breadcrumbs="[['title' => 'Delivery Item', 'url' => route('delivery-item.index')], ['title' => 'Create']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Item Penerimaan Barang'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('delivery-item.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="delivery_id">Delivery</label>
                        <select name="delivery_id" id="delivery_id" class="form-control">
                            <option value="">-- Pilih Delivery --</option>
                            @foreach ($deliveries as $delivery)
                                <option value="{{ $delivery->id }}">
                                    {{ $delivery->purchase->purchaseRequest->material->name }} -
                                    {{ $delivery->purchase->purchaseRequest->supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" id="supplier_id"
                            class="form-control @error('supplier_id') is-invalid @enderror">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Jumlah Material</label>
                        <input type="number" name="quantity" id="quantity"
                            class="form-control @error('quantity') is-invalid @enderror"
                            placeholder="Masukkan jumlah material">
                    </div>

                    <div class="form-group">
                        <label for="storage_location">Tempat penyimpanan</label>
                        <input type="text" name="storage_location" id="storage_location"
                            class="form-control @error('storage_location') is-invalid @enderror"
                            placeholder="Masukkan Tempat penyimpanan">
                    </div>

                    <div class="form-group">
                        <label for="condition">Kondisi Material</label>
                        <select name="condition" id="condition"
                            class="form-control @error('condition') is-invalid @enderror">
                            <option value="">-- Pilih Kondisi --</option>
                            <option value="good">Good</option>
                            <option value="bad">Bad</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="unique_code">Nomor unik untuk barcode</label>
                        <input type="text" name="unique_code" id="unique_code"
                            class="form-control @error('unique_code') is-invalid @enderror"
                            placeholder="Masukkan nomor unik">
                    </div>

                    <div class="mt-3">
                        <button type="submit" id="submit-btn" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('delivery-item.index') }}" class="btn btn-warning ml-2">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const $submitBtn = $('#submit-btn');
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const form = $(this)[0];
                const formData = new FormData(form); // Create FormData object with form data

                $submitBtn.prop('disabled', true).text('Loading...');

                $.ajax({
                    url: form.action,
                    method: 'POST',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting the content type
                    success: function(response) {
                        if (response.success) {
                            sessionStorage.setItem('success',
                                'Jenis barang berhasil disubmit.');
                            window.location.href =
                                "{{ route('delivery-item.index') }}"; // Redirect to index page
                        } else {
                            $('#flash-messages').html('<div class="alert alert-danger">' +
                                response.error + '</div>');
                        }
                    },
                    error: function(response) {
                        const errors = response.responseJSON.errors;
                        for (let field in errors) {
                            let input = $('[name=' + field + ']');
                            let error = errors[field][0];
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').remove();
                            input.after('<div class="invalid-feedback">' + error + '</div>');
                        }

                        const message = response.responseJSON.message ||
                            'Terdapat kesalahan pada proses jenis barang';
                        $('#flash-messages').html('<div class="alert alert-danger">' + message +
                            '</div>');
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false).text('Tambah');
                    }
                });
            });

            $('input, select, textarea').on('input change', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').text('');
            });
        });
    </script>
@endpush
