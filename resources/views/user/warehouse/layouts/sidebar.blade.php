<!-- Sidebar -->
<x-sidebar.layout>

    <!-- Sidebar title -->
    <x-sidebar.title :name="'ProcureWare'" :icon="'fas fa-solid fa-book'" :addRoute="'dashboard'" />
    <!-- End sidebar title -->

    @if (auth()->user()->role == 'manager_a')
        <!-- Nav item dashboard -->
        <x-sidebar.nav-item route="dashboard" icon="fa-tachometer-alt" label="Dashboard" />
        <!-- End nav item dashboard -->
    @endif

    <!-- Nav item barang -->
    @if (auth()->user()->role == 'manager_a' || auth()->user()->role == 'staff_warehouse')
        <x-sidebar.nav-item title="Modul Gudang" icon="fa-warehouse" label="Modul Gudang" collapseId="collapseItem"
            :routes="['delivery.*', 'delivery-item.*', 'warehouse-stock.*']" :subItems="[
                ['route' => 'delivery.index', 'label' => 'Delivery'],
                ['route' => 'delivery-item.index', 'label' => 'Delivery Item'],
                ['route' => 'warehouse-stock.index', 'label' => 'Warehouse stok'],
            ]" />
    @endif
    <!-- End nav item -->

</x-sidebar.layout>
<!-- End sidebar -->
