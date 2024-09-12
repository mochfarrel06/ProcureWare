@extends('user.purchase.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Tambah Detail Pembelian'" :breadcrumbs="[['title' => 'Purchase Item', 'url' => route('purchase-item.index')], ['title' => 'Create']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Detail Pembelian'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('purchase-item.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="purchase_id">Daftar Pembelian</label>
                        <select name="purchase_id" id="purchase_id" class="form-control">
                            <option value="">-- Pilih --</option>
                            @foreach ($purchases as $purchase)
                                <option value="{{ $purchase->id }}">{{ $purchase->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="material_id">Material</label>
                        <select name="material_id" id="material_id" class="form-control">
                            <option value="">-- Pilih --</option>
                            @foreach ($materials as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="price_per_unit">Harga per Unit</label>
                        <input type="number" name="price_per_unit" id="price_per_unit" class="form-control">
                    </div>

                    <div class="mt-5">
                        <button type="submit" id="submit-btn" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('purchase-item.index') }}" class="btn btn-warning ml-2">Kembali</a>
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
                                'Daftar Pembelian berhasil disubmit.');
                            window.location.href =
                                "{{ route('purchase-item.index') }}"; // Redirect to index page
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
                            'Terdapat kesalahan pada proses Daftar Pembelian';
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
