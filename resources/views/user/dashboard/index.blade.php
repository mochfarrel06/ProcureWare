<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/izitoast/css/iziToast.min.css') }}">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat datang, {{ Auth::user()->name }}</h1>
                                    </div>

                                    <!-- Kondisi untuk Manager A dan Manager B -->
                                    <div class="row">
                                        <!-- Untuk Manager A, tampilkan dua card -->
                                        @if (Auth::user()->role == 'manager_a')
                                            <!-- Card untuk Modul Pembelian -->
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <a href="{{ route('purchases.index') }}" class="text-decoration-none">
                                                    <div class="card border-left-primary shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col text-center">
                                                                    <div
                                                                        class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                                                        Modul Pembelian
                                                                    </div>
                                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <!-- Card untuk Modul Gudang -->
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <a href="{{ route('warehouse.index') }}" class="text-decoration-none">
                                                    <div class="card border-left-success shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col text-center">
                                                                    <div
                                                                        class="text-md font-weight-bold text-success text-uppercase mb-1">
                                                                        Modul Gudang
                                                                    </div>
                                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                        <i class="fas fa-warehouse"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif

                                        <!-- Untuk Manager B, hanya tampilkan card Pembelian -->
                                        @if (Auth::user()->role == 'manager_b')
                                            <div class="col-xl-6 col-md-6 mb-4">
                                                <a href="{{ route('purchases.index') }}" class="text-decoration-none">
                                                    <div class="card border-left-primary shadow h-100 py-2">
                                                        <div class="card-body">
                                                            <div class="row no-gutters align-items-center">
                                                                <div class="col text-center">
                                                                    <div
                                                                        class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                                                        Modul Pembelian
                                                                    </div>
                                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                                        <i class="fas fa-shopping-cart"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- End of Row for Cards -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/izitoast/js/iziToast.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                iziToast.success({
                    title: 'Berhasil',
                    message: '{{ session('success') }}',
                    position: 'topRight'
                });
            @endif

            @if (session('error'))
                iziToast.error({
                    title: 'Error',
                    message: '{{ session('error') }}',
                    position: 'topRight'
                });
            @endif

            @if (session('info'))
                iziToast.info({
                    title: 'Info',
                    message: '{{ session('info') }}',
                    position: 'topRight'
                });
            @endif
        });
    </script>

</body>

</html>
