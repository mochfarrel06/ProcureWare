@extends('user.purchase.layouts.master')

@section('title-page')
    Edit
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
                <form id="main-form" action="{{ route('material.update', $material->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Nama Material</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            id="name" value="{{ old('name', $material->name) }}">
                    </div>

                    <div class="form-group">
                        <label for="code">Kode Material</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            id="code" value="{{ old('code', $material->code) }}">
                    </div>

                    <div class="form-group">
                        <label for="category">Kategori Material</label>
                        <input type="text" class="form-control @error('category') is-invalid @enderror" name="category"
                            id="category" value="{{ old('category', $material->category) }}">
                    </div>

                    <div class="form-group">
                        <label for="stock">Jumlah Stok Material</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock"
                            id="stock" value="{{ old('stock', $material->stock) }}">
                    </div>

                    <div class="mt-3">
                        <button type="submit" id="submit-btn" class="btn btn-success">Edit</button>
                        <a href="{{ route('material.index') }}" class="btn btn-warning ml-2">Kembali</a>
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
                            'Jenis barang berhasil disubmit.');
                        window.location.href =
                            "{{ route('material.index') }}"; // Redirect to index page
                    } else if (response.info) {
                        // Flash message info
                        sessionStorage.setItem('info',
                            'Tidak melakukan perubahan data pada jenis barang.');
                        window.location.href =
                            "{{ route('material.index') }}"; // Redirect to index page
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
