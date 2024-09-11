<!-- Sidebar -->
<x-sidebar.layout>
    <!-- Sidebar title -->
    <x-sidebar.title :name="'ProcureWare'" :icon="'fas fa-solid fa-book'" :addRoute="'dashboard'" />
    <!-- End sidebar title -->

    <!-- Nav item dashboard -->
    <x-sidebar.nav-item route="dashboard" icon="fa-tachometer-alt" label="Dashboard" />
    <!-- End nav item dashboard -->

    <!-- Nav item barang -->
    @if (auth()->user()->role == 'manager_a' ||
            auth()->user()->role == 'manager_b' ||
            auth()->user()->role == 'staff_purchase')
        <x-sidebar.nav-item title="Master" icon="fa-shop" label="Daftar Pembelian" collapseId="collapseItem"
            :routes="['purchases.*', 'material.*', 'supplier.*', 'purchaseApproval.*', 'purchaseHistory.*']" :subItems="[
                ['route' => 'purchases.index', 'label' => 'Daftar Pembelian'],
                ['route' => 'material.index', 'label' => 'Master Material'],
                ['route' => 'supplier.index', 'label' => 'Master Supplier'],
                [
                    'route' => 'purchaseApproval.index',
                    'label' => 'Master Persetujuan',
                    'roles' => ['manager_a', 'manager_b'],
                ],
                ['route' => 'purchaseHistory.index', 'label' => 'Riwayat Pembelian'],
            ]" />
    @endif

    @if (auth()->user()->role == 'manager_a' || auth()->user()->role == 'staff_warehouse')
        <x-sidebar.nav-item title="Master" icon="fa-shop" label="Gudang" collapseId="collapseItem" :routes="['warehouse.*']"
            :subItems="[['route' => 'warehouse.index', 'label' => 'Gudang']]" />
    @endif

    <!-- End nav item -->

    <!-- Divider -->
    {{-- <hr class="sidebar-divider d-none d-md-block"> --}}

</x-sidebar.layout>
