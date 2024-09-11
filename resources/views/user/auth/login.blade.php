@extends('user.auth.layouts.master')

@section('content')
    <!-- Layout Login -->
    <x-auth.auth-layout :title="'Aplikasi ProcuseWare'" :route="'login'" />
    <!-- End Layout Login -->
@endsection
