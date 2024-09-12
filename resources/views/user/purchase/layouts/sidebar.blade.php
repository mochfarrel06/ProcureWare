<!-- Sidebar -->
<x-sidebar.layout>
    <!-- Sidebar title -->
    <x-sidebar.title :name="'ProcureWare'" :icon="'fas fa-solid fa-book'" :addRoute="'dashboard'" />
    <!-- End sidebar title -->

    <!-- Nav item dashboard -->
    @if (auth()->user()->role == 'manager_a' || auth()->user()->role == 'manager_b')
        <x-sidebar.nav-item route="dashboard" icon="fa-tachometer-alt" label="Dashboard" />
    @endif
    <!-- End nav item dashboard -->

    <!-- Nav item barang -->
    @if (auth()->user()->role == 'manager_a' ||
            auth()->user()->role == 'manager_b' ||
            auth()->user()->role == 'staff_purchase')
        <x-sidebar.nav-item title="Modul Pembelian" icon="fa-shopping-cart" label="Modul Pembelian"
            collapseId="collapseItem" :routes="[
                'material.*',
                'supplier.*',
                'purchase-request.*',
                'purchases.*',
                'purchase-report.*',
                'purchaseHistory.*',
            ]" :subItems="[
                ['route' => 'material.index', 'label' => 'Master Material'],
                ['route' => 'supplier.index', 'label' => 'Master Supplier'],
                ['route' => 'purchase-request.index', 'label' => 'Permintaan Pembelian'],
                ['route' => 'purchases.index', 'label' => 'Daftar Pembelian'],
                ['route' => 'purchase-report.index', 'label' => 'Laporan Pembelian'],
                ['route' => 'purchaseHistory.index', 'label' => 'Riwayat Pembelian'],
            ]" />
    @endif

    @if (auth()->user()->role == 'manager_a' || auth()->user()->role == 'manager_b')
        <x-sidebar.nav-item title="Persetujuan" icon="fa-handshake" label="Persetujuan" collapseId="collapseItem1"
            :routes="['purchaseApproval.*']" :subItems="[
                [
                    'route' => 'purchaseApproval.index',
                    'label' => 'Persetujuan',
                ],
            ]" />
    @endif

    <!-- End nav item -->

</x-sidebar.layout>
