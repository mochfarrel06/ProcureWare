@extends('user.purchase.layouts.master')

@section('title-page')
    Report
@endsection

@section('content')
    <x-content.container-fluid>

        {{-- <x-content.heading-page :title="'Halaman Detail Pembelian'" :breadcrumbs="[['title' => 'Purchase Item']]" /> --}}

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Detail Pembelian'" :icon="'fas fa-solid fa-shopping-cart'" :addRoute="'purchase-report.create'" />

            <x-content.table-body>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Purchase</th>
                        <th>Report Type</th>
                        <th>Report Date</th>
                    </tr>
                </thead>

                <x-content.tbody>
                    @foreach ($reports as $report)
                        <tr>
                            <td>{{ $report->id }}</td>
                            <td>{{ $report->purchase->id }}</td>
                            <td>{{ $report->report_type }}</td>
                            <td>{{ $report->report_date }}</td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection
