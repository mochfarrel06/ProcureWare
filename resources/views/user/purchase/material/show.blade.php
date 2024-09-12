@extends('user.purchase.layouts.master')

@section('title-page')
    Show
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Lihat Master Material'" :breadcrumbs="[['title' => 'Material', 'url' => route('material.index')], ['title' => 'Show']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Lihat Master material'" :icon="'fas fa-solid fa-eye'" />

            <x-content.card-body>
                <form>
                    @csrf

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Nama Material</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    id="name" value="{{ $material->name }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="code">Kode Material</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" id="code" value="{{ $material->code }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="unit">Satuan Material</label>
                                <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                    name="unit" id="unit" value="{{ old('unit', $material->unit) }}" disabled>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description">Deskripsi Material</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    name="description" id="description" value="{{ $material->description }}" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('material.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </x-content.card-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
