@extends('user.warehouse.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Tambah Daftar Barang Masuk'" :breadcrumbs="[['title' => 'Gudang', 'url' => route('warehouse.index')], ['title' => 'Tambah']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Daftar Barang Masuk'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('warehouse.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="purchase_id">Daftar Pembelian</label>
                        <select id="purchase_id" name="purchase_id"
                            class="form-control @error('purchase_id') is-invalid @enderror">
                            <option value="">-- Pilih Daftar Pembelian --</option>
                            @foreach ($purchases as $purchase)
                                <option value="{{ $purchase->id }}">{{ $purchase->material->name }} -
                                    {{ $purchase->supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="material_name">Nama Material</label>
                        <input type="text" id="material_name" name="material_name"
                            class="form-control @error('material_name') is-invalid @enderror"
                            placeholder="Masukkan nama material">
                    </div>

                    <div class="form-group">
                        <label for="material_code">Kode Material</label>
                        <input type="text" id="material_code" name="material_code"
                            class="form-control @error('material_code') is-invalid @enderror"
                            placeholder="Masukkan kode material">
                    </div>

                    <div class="form-group">
                        <label for="arrival_date">Tanggal Kedatangan</label>
                        <input type="date" id="arrival_date" name="arrival_date"
                            class="form-control @error('arrival_date') is-invalid @enderror">
                    </div>

                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select id="supplier_id" name="supplier_id"
                            class="form-control @error('supplier_id') is-invalid @enderror">
                            <option value="">-- Pilih Supplier --</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Jumlah Barang Pembelian</label>
                        <input type="number" id="quantity" name="quantity"
                            class="form-control @error('quantity') is-invalid @enderror"
                            placeholder="Masukkan jumlah barang pembelian">
                    </div>

                    <div class="form-group">
                        <label for="storage_location">Lokasi Penyimpanan</label>
                        <input type="text" id="storage_location" name="storage_location"
                            class="form-control @error('storage_location') is-invalid @enderror"
                            placeholder="Masukkan lokasi penyimpanan">
                    </div>

                    <div class="form-group">
                        <label for="condition">Kondisi Material</label>
                        <select id="condition" name="condition"
                            class="form-control @error('condition') is-invalid @enderror">
                            <option value="">-- Pilih Kondisi Material --</option>
                            <option value="good">Good</option>
                            <option value="bad">Bad</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="unique_number">Nomor Unik Material</label>
                        <input type="text" id="unique_number" name="unique_number"
                            class="form-control @error('unique_number') is-invalid @enderror"
                            placeholder="Nomor unik material">
                    </div>

                    <div class="mt-3">
                        <button type="submit" id="submit-btn" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('warehouse.index') }}" class="btn btn-warning ml-2">Kembali</a>
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
                                "{{ route('warehouse.index') }}"; // Redirect to index page
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
