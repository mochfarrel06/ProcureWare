<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.purchase.layouts.head')
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <x-master.wrapper>

        @include('user.purchase.layouts.sidebar')

        <!-- Content Wrapper -->
        <x-master.content-wrapper>
            <!-- Main Content -->
            <x-master.content>
                <!-- Topbar -->
                <x-navbar :routeActive="'purchases.index'" :routeLink="'purchases.index'" routeStore="{{ route('logout') }}" />
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                @yield('content')
                <!-- /.container-fluid -->
            </x-master.content>
            <!-- End of Main Content -->

            <!-- Footer -->
            @include('user.purchase.layouts.footer')
            <!-- End of Footer -->
        </x-master.content-wrapper>
        <!-- End of Content Wrapper -->
    </x-master.wrapper>
    <!-- End of Page Wrapper -->

    @include('user.purchase.layouts.scripts')
</body>

</html>
