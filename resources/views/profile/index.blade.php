@extends('layouts.app')

@section('title', 'Profile Settings')

@section('content')

<div class="page-header">
    <h1><i class="bi bi-person-circle me-2" style="color:#818cf8;"></i>Profile Settings</h1>
    <p>Manage your account information.</p>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3 px-4">
                <i class="bi bi-person me-2" style="color:#818cf8;"></i>Account Details
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-4 mb-4">
                    <div style="width:64px;height:64px;background:linear-gradient(135deg,#6366f1,#4f46e5);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:800;color:#fff;font-size:1.4rem;flex-shrink:0;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="fw-semibold" style="color:#f1f5f9;font-size:1.1rem;">{{ Auth::user()->name }}</div>
                        <div style="color:#64748b;font-size:.875rem;">{{ Auth::user()->email }}</div>
                        <div style="color:#475569;font-size:.75rem;margin-top:.25rem;">
                            Member since {{ Auth::user()->created_at->format('F Y') }}
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning d-flex align-items-center gap-2">
                    <i class="bi bi-tools flex-shrink-0"></i>
                    <div>Profile editing is coming in a future update.</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
