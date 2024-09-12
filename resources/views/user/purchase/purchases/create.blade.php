@extends('user.purchase.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Tambah Daftar Pembelian'" :breadcrumbs="[['title' => 'Purchase', 'url' => route('purchases.index')], ['title' => 'Create']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Daftar Pembelian'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('purchases.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="purchase_request_id">Permintaan Pembelian</label>
                        <select class="form-control @error('purchase_request_id') is-invalid @enderror"
                            name="purchase_request_id" id="purchase_request_id">
                            <option value="">-- Pilih Permintaan Pembelian --</option>
                            @foreach ($purchaseRequests as $purchaseRequest)
                                <option value="{{ $purchaseRequest->id }}">{{ $purchaseRequest->id }} -
                                    {{ $purchaseRequest->supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="expected_delivery_date">Tanggal Pengiriman yang diharapkan</label>
                        <input type="date" class="form-control @error('expected_delivery_date') is-invalid @enderror"
                            name="expected_delivery_date" id="expected_delivery_date"
                            value="{{ old('expected_delivery_date') }}">
                    </div>

                    <div class="form-group">
                        <label for="total_price">Total harga</label>
                        <input type="number" class="form-control @error('total_price') is-invalid @enderror"
                            name="total_price" id="total_price" value="{{ old('total_price') }}"
                            placeholder="Masukkan total harga">
                    </div>

                    <div class="mt-4">
                        <button type="submit" id="submit-btn" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('purchases.index') }}" class="btn btn-warning ml-2">Kembali</a>
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
                                "{{ route('purchases.index') }}"; // Redirect to index page
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
