@extends('layouts.auth')

@section('title', 'Register')

@push('styles')
@endpush

@section('content')
    <section class="bg-green-gradient d-flex align-items-center full-height">
        <div class="container">
            <a href="javascript:window.history.back();">
                <button type="button" class="btn-back">
                    <i class='bx bx-arrow-back'></i>
                </button>
            </a>
            <div class="row gy-4 align-items-center justify-content-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center">
                        <div class="col-12 col-xl-9">
                            <h2 class="h1 mb-4 text-white">Hello Welcome</h2>
                            <p class="lead mb-5 text-white">We write words, take photos, make videos, and interact with
                                artificial
                                intelligence.</p>
                            <div class="text-end text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor"
                                    class="bi bi-grip-horizontal" viewBox="0 0 16 16">
                                    <path
                                        d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <img class="img-fluid rounded mb-4 mx-auto d-block" loading="lazy"
                                src="{{ asset('img/logo-login.png') }}" width="245" height="80"
                                alt="BootstrapBrain Logo">
                            <form method="POST">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="name" required>
                                        <label for="name">Name</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="name@example.com" required>
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Password" required>
                                        <label for="password">Password</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-floating">
                                        <input type="password" class="form-control" name="password_confirmation"
                                            id="password_confirmation" placeholder="Confirm Password" required>
                                        <label for="password_confirmation">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="d-grid">
                                    <button class="btn btn-success btn-lg" type="submit">Register now</button>
                                </div>
                            </form>
                            <div class="text-center mt-4">
                                <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
