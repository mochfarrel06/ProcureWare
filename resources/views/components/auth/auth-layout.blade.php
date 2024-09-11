<!-- Container Section Login -->
<x-auth.container>

    <!-- Logo -->
    <x-auth.logo image="{{ asset('assets/img/logo.png') }}" />
    <!-- End Logo -->

    <!-- Title -->
    <x-auth.title title="{{ $title }}" />
    <!-- End Title -->

    <!-- Form -->
    <form class="user mt-5" method="POST" action="{{ route($route) }}">
        @csrf

        <!-- Form Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                value="{{ old('email') }}" placeholder="Masukkan email anda" autofocus>
            @error('email')
                <div class="text-danger" style="font-size: 0.8em">*{{ $message }}</div>
            @enderror
        </div>
        <!-- End Form email -->

        <!-- Form Password -->
        <div class="form-group">
            <label for="exampleInputPassword">Password</label>
            <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    id="exampleInputPassword" placeholder="Masukkan password" autofocus>
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            @error('password')
                <div class="text-danger" style="font-size: 0.8em">*{{ $message }}</div>
            @enderror
        </div>
        <!-- End Form Password -->

        <!-- Button Submit -->
        <button type="submit" class="btn btn-primary btn-user btn-block mt-5">Login</button>
        <!-- End Button Submit -->

    </form>
    <!-- End Form -->

    <!-- Footer -->
    <x-auth.footer description="© {{ date('Y') }} ProcuseWare. All rights reserved." />
    <!-- End Footer -->

</x-auth.container>
<!-- End Container Section Login -->
