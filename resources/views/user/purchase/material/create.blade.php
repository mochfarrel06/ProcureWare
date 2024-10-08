@extends('user.purchase.layouts.master')

@section('title-page')
    Create
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Tambah Master Material'" :breadcrumbs="[['title' => 'Material', 'url' => route('material.index')], ['title' => 'Create']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tambah Master Material'" :icon="'fas fa-solid fa-plus'" />

            <x-content.card-body>
                <form id="main-form" action="{{ route('material.store') }}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Nama Material</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" value="{{ old('name') }}" placeholder="Masukkan nama material">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="code">Kode Material</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" id="code" value="{{ old('code') }}"
                                    placeholder="Masukkan kode material">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="unit">Satuan Material</label>
                                <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                    name="unit" id="unit" value="{{ old('unit') }}"
                                    placeholder="Masukkan satuan material">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description">Deskripsi Material</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" id="description" value="{{ old('description') }}"
                                    placeholder="Masukkan deskripsi material">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" id="submit-btn" class="btn btn-primary">Tambah</button>
                        <a href="{{ route('material.index') }}" class="btn btn-warning ml-2">Kembali</a>
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
                                'Material berhasil disubmit.');
                            window.location.href =
                                "{{ route('material.index') }}"; // Redirect to index page
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
                            'Terdapat kesalahan pada proses Material';
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
