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
        <x-sidebar.nav-item title="Master" icon="fa-shopping-cart" label="Daftar Pembelian" collapseId="collapseItem"
            :routes="['purchases.*', 'material.*', 'supplier.*', 'purchaseHistory.*', 'purchaseApproval.*']" :subItems="[
                ['route' => 'purchases.index', 'label' => 'Daftar Pembelian'],
                ['route' => 'material.index', 'label' => 'Master Material'],
                ['route' => 'supplier.index', 'label' => 'Master Supplier'],
                ['route' => 'purchaseHistory.index', 'label' => 'Riwayat Pembelian'],
                [
                    'route' => 'purchaseApproval.index',
                    'label' => 'Master Persetujuan',
                    'roles' => ['manager_a', 'manager_b'],
                ],
            ]" />
    @endif

    <!-- End nav item -->

</x-sidebar.layout>
