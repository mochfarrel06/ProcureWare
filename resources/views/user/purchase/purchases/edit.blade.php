@extends('user.purchase.layouts.master')

@section('title-page')
    Edit
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Daftar Pembelian'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('dashboard')], ['title' => 'Edit']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Edit Daftar Pembelian'" :icon="'fas fa-solid fa-edit'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('purchases.update', $purchase->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="purchase_request_id">Permintaan Pembelian</label>
                                <select class="form-control @error('purchase_request_id') is-invalid @enderror"
                                    name="purchase_request_id" id="purchase_request_id">
                                    <option value="">-- Pilih Permintaan Pembelian --</option>
                                    @foreach ($purchaseRequests as $purchaseRequest)
                                        <option value="{{ $purchaseRequest->id }}"
                                            {{ $purchaseRequest->id == $purchase->purchase_request_id ? 'selected' : '' }}>
                                            {{ $purchaseRequest->material->name }} - {{ $purchaseRequest->supplier->name }}
                                            - {{ $purchaseRequest->quantity }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="price_per_unit">Harga satuan material</label>
                                <input type="number" class="form-control @error('price_per_unit') is-invalid @enderror"
                                    name="price_per_unit" id="price_per_unit"
                                    value="{{ old('price_per_unit', $purchase->price_per_unit) }}">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" id="submit-btn" class="btn btn-success">Edit</button>
                        <a href="{{ route('purchases.index') }}" class="btn btn-warning ml-2">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection

@push('scripts')
    <script>
        // Handle form submission using AJAX
        $('#main-form').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            const form = $(this);
            const formData = new FormData(form[0]); // Use FormData to handle file uploads
            const submitButton = $('#submit-btn');
            submitButton.prop('disabled', true).text('Loading...');

            $.ajax({
                url: form.attr('action'),
                method: 'POST', // Use POST for form submission
                data: formData,
                contentType: false, // Prevent jQuery from setting content type
                processData: false, // Prevent jQuery from processing data
                success: function(response) {
                    if (response.success) {
                        // Flash message sukses
                        sessionStorage.setItem('success',
                            'Daftar Pembelian berhasil disubmit.');
                        window.location.href =
                            "{{ route('purchases.index') }}"; // Redirect to index page
                    } else if (response.info) {
                        // Flash message info
                        sessionStorage.setItem('info',
                            'Tidak melakukan perubahan data pada Daftar Pembelian.');
                        window.location.href =
                            "{{ route('purchases.index') }}"; // Redirect to index page
                    } else {
                        // Flash message error
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
                        // Remove existing invalid feedback to avoid duplicates
                        input.next('.invalid-feedback').remove();
                        input.after('<div class="invalid-feedback">' + error + '</div>');
                    }

                    const message = response.responseJSON.message ||
                        'Terdapat kesalahan pada jenis barang.';
                    $('#flash-messages').html('<div class="alert alert-danger">' + message +
                        '</div>');
                },
                complete: function() {
                    submitButton.prop('disabled', false).text('Edit');
                }
            });
        });

        // Remove validation error on input change
        $('input, select, textarea').on('input change', function() {
            $(this).removeClass('is-invalid');
            $(this).next('.invalid-feedback').remove();
        });
    </script>
@endpush
