@extends('layouts.app')

@section('title', 'Log In')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height:70vh;">
    <div class="col-sm-10 col-md-7 col-lg-5 col-xl-4">

        {{-- Logo / Brand --}}
        <div class="text-center mb-4">
            <div style="width:56px;height:56px;background:linear-gradient(135deg,#6366f1,#818cf8);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <i class="bi bi-diagram-3-fill text-white" style="font-size:1.4rem;"></i>
            </div>
            <h1 class="fw-bold mb-1" style="color:#f1f5f9;font-size:1.5rem;">Welcome back</h1>
            <p style="color:#64748b;font-size:.875rem;">Sign in to your NexusCRM account</p>
        </div>

        <div class="card" style="border-color:rgba(99,102,241,.15);">
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email"
                                   value="{{ old('email') }}"
                                   placeholder="you@company.com"
                                   autofocus autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <label for="password" class="form-label mb-0">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="font-size:.78rem;color:#818cf8;">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="••••••••"
                                   autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="color:#64748b;font-size:.875rem;">
                                Keep me logged in
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                    </button>
                </form>
            </div>
        </div>

        @if (Route::has('register'))
            <p class="text-center mt-4" style="font-size:.875rem;color:#475569;">
                Don't have an account?
                <a href="{{ route('register') }}" style="color:#818cf8;font-weight:500;">Create one</a>
            </p>
        @endif

    </div>
</div>

@endsection
