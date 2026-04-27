@extends('layouts.app')

@section('title', 'Create Account')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height:70vh;">
    <div class="col-sm-10 col-md-7 col-lg-5 col-xl-4">

        {{-- Brand --}}
        <div class="text-center mb-4">
            <div style="width:56px;height:56px;background:linear-gradient(135deg,#6366f1,#818cf8);border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;">
                <i class="bi bi-diagram-3-fill text-white" style="font-size:1.4rem;"></i>
            </div>
            <h1 class="fw-bold mb-1" style="color:#f1f5f9;font-size:1.5rem;">Create your account</h1>
            <p style="color:#64748b;font-size:.875rem;">Start managing your CRM today</p>
        </div>

        <div class="card" style="border-color:rgba(99,102,241,.15);">
            <div class="card-body p-4">

                @if ($errors->any())
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-4">
                        <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                        <div>{{ $errors->first() }}</div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Jane Smith"
                                   autofocus autocomplete="name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

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
                                   autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="Min. 8 characters"
                                   autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text" style="background:#0f172a;border-color:#334155;color:#64748b;">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password"
                                   class="form-control"
                                   id="password-confirm" name="password_confirmation"
                                   placeholder="Repeat your password"
                                   autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-person-plus me-2"></i>Create Account
                    </button>
                </form>
            </div>
        </div>

        <p class="text-center mt-4" style="font-size:.875rem;color:#475569;">
            Already have an account?
            <a href="{{ route('login') }}" style="color:#818cf8;font-weight:500;">Sign in</a>
        </p>

    </div>
</div>

@endsection
