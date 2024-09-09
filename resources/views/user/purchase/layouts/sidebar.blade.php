<!-- Sidebar -->
<x-sidebar.layout>
    <!-- Sidebar title -->
    <x-sidebar.title :name="'ProcureWare'" :icon="'fas fa-solid fa-book'" :addRoute="'purchases.index'" />
    <!-- End sidebar title -->

    <!-- Nav item dashboard -->
    <x-sidebar.nav-item route="purchases.index" icon="fa-tachometer-alt" label="Dashboard" />
    <!-- End nav item dashboard -->

    <!-- Nav item barang -->
    <x-sidebar.nav-item title="Master" icon="fa-box" label="Pembelian" collapseId="collapseItem" :routes="['purchases.*']"
        :subItems="[['route' => 'purchases.index', 'label' => 'Pembelian']]" />
    <!-- End nav item -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

</x-sidebar.layout>
