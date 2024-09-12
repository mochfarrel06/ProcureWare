@extends('user.purchase.layouts.master')

@section('title-page')
    Persetujuan
@endsection

@section('content')
    <x-content.container-fluid>

        <x-content.heading-page :title="'Halaman Persetujuan Pembelian'" :breadcrumbs="[['title' => 'Purchase Approval']]" />

        <x-content.table-container>

            <x-content.table-header :title="'Tabel Persetujuan Pembelian'" :icon="'fas fa-solid fa-handshake'" />

            <x-content.table-body>

                <x-content.thead :items="[
                    'No',
                    'Material',
                    'Supplier',
                    'Jumlah Material',
                    'Tanggal Permintaan',
                    'Status Persetujuan',
                    'Aksi',
                ]" />

                <x-content.tbody>
                    @foreach ($purchaseRequests as $purchaseRequest)
                        <tr>
                            <td class="index">{{ $loop->index + 1 }}</td>
                            <td>{{ $purchaseRequest->material->name ?? '' }}</td>
                            <td>{{ $purchaseRequest->supplier->name ?? '' }}</td>
                            <td>{{ $purchaseRequest->quantity ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($purchaseRequest->request_date)->locale('id')->isoFormat('D MMMM YYYY') }}
                            </td>
                            <td>
                                {{ $purchaseRequest->status }}
                            </td>
                            <td>
                                <div class="d-flex">
                                    <form action="{{ route('purchaseApproval.approved', $purchaseRequest->id) }}"
                                        method="POST" class="approve-reject-form">
                                        @csrf
                                        <button type="submit" class="btn btn-success approve-btn mr-3"
                                            {{ $purchaseRequest->status === 'approved' ? 'disabled' : '' }}>Approve</button>
                                    </form>
                                    <form action="{{ route('purchaseApproval.rejected', $purchaseRequest->id) }}"
                                        method="POST" class="approve-reject-form">
                                        @csrf
                                        <button type="submit" class="btn btn-danger reject-btn"
                                            {{ $purchaseRequest->status === 'rejected' ? 'disabled' : '' }}>Reject</button>
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
