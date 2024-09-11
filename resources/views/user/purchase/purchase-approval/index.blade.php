@extends('user.purchase.layouts.master')

@section('title-page')
    Pembelian
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Pembelian'" :breadcrumbs="[['title' => 'Dashboard', 'url' => route('purchaseApproval.index')], ['title' => 'Jenis Barang']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Pembelian'" :icon="'fas fa-solid fa-shop'" />

            <x-content.table-body>

                <x-content.thead :items="['ID', 'Material', 'Supplier', 'Tanggal Pembelian', 'Jumlah', 'Status Persetujuan', 'Aksi']" />

                <x-content.tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $purchase->material->name ?? '' }}</td>
                            <td>{{ $purchase->supplier->name ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td>{{ $purchase->quantity ?? '' }}</td>
                            <td>
                                {{ $purchase->approval_status }}
                                {{-- <a
                                    class="btn
                                @if ($purchase->approval_status == 'pending') btn-warning
                                @elseif ($purchase->approval_status == 'approved')
                                    btn-success
                                @elseif ($purchase->approval_status == 'rejected')
                                    btn-danger
                                @else
                                    btn-secondary @endif
                            ">
                                    {{ ucfirst($purchase->approval_status) ?? 'Unknown' }}
                                </a> --}}
                            </td>
                            <td>
                                {{-- @if ($purchase->approval_status == 'pending')
                                    <a href="{{ route('purchaseApproval.approved', $purchase->id) }}">Setujui</a> |
                                    <a href="{{ route('purchaseApproval.rejected', $purchase->id) }}">Tolak</a>
                                @else
                                    Tidak ada aksi
                                @endif --}}

                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('purchaseApproval.approved', $purchase->id) }}" method="POST"
                                        class="approve-reject-form">
                                        @csrf
                                        <button type="submit" class="btn btn-success approve-btn mr-3"
                                            {{ $purchase->approval_status === 'approved' ? 'disabled' : '' }}>Approve</button>
                                    </form>
                                    <form action="{{ route('purchaseApproval.rejected', $purchase->id) }}" method="POST"
                                        class="approve-reject-form">
                                        @csrf
                                        <button type="submit" class="btn btn-danger reject-btn"
                                            {{ $purchase->approval_status === 'rejected' ? 'disabled' : '' }}>Reject</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </x-content.tbody>

            </x-content.table-body>

        </x-content.table-container>

    </x-content.container-fluid>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.approve-reject-form').forEach(form => {
            form.addEventListener('submit', function(event) {
                // Prevent default form submission
                event.preventDefault();

                // Find approve and reject buttons in the form
                const approveButton = form.querySelector('.approve-btn');
                const rejectButton = form.querySelector('.reject-btn');

                // If approve button was clicked
                if (approveButton && approveButton === event.submitter) {
                    approveButton.disabled = true;
                    if (rejectButton) rejectButton.disabled = false;
                }

                // If reject button was clicked
                if (rejectButton && rejectButton === event.submitter) {
                    rejectButton.disabled = true;
                    if (approveButton) approveButton.disabled = false;
                }

                // Submit the form after disabling
                form.submit();
            });
        });
    </script>
@endpush
