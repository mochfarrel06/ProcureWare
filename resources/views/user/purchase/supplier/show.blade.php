@extends('user.purchase.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Master Supplier'" :breadcrumbs="[['title' => 'Supplier', 'url' => route('supplier.index')], ['title' => 'Show']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Master Supplier'" :icon="'fas fa-solid fa-eye'" />

            <x-content.card-body>
                <form>
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Nama Supplier</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" value="{{ old('name', $supplier->name) }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="code">Kode Supplier</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" id="code" value="{{ old('code', $supplier->code) }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="contact">Kontak Supplier</label>
                                <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                    name="contact" id="contact" value="{{ old('contact', $supplier->contact) }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address">Alamat Supplier</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    name="address" id="address" value="{{ old('address', $supplier->address) }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('supplier.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
